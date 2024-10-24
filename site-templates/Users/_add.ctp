<?php
$config = $config ?? null;
//Controle de disposição dos campos
$colDNascCelTelSex = 0;
$colDNascCelTelSex += $config->user_fields_allowed->birth ? 1 : 0;
$colDNascCelTelSex += $config->user_fields_allowed->cel ? 1 : 0;
$colDNascCelTelSex += $config->user_fields_allowed->phone ? 1 : 0;
$colDNascCelTelSex += $config->user_fields_allowed->sex ? 1 : 0;
$colDNascCelTelSex = $colDNascCelTelSex > 0 ? 12 / $colDNascCelTelSex : 0;

$colLoja = 0;
$colLoja += ($config->user_fields_allowed->stores_cnpj) ? 1 : 0;
$colLoja += ($config->user_fields_allowed->stores_name) ? 1 : 0;
$colLoja += ($config->user_fields_allowed->stores_phone) ? 1 : 0;
$colLoja = $colLoja > 0 ? 12 / $colLoja : 0;

$colEnd1 = 0;
$colEnd1 += $config->user_fields_allowed->cep ? 1 : 0;
?>
<style>
    .pad-space-5 {
        padding-right: 5px !important;
        padding-left: 5px !important;
    }

    .labelfocus {
        position: absolute;
        left: 15px;
        top: 2px;
        font-size: 12px;
        font-weight: 200;
        color: #c0c0c0;
        transition: all 0.5s ease;
        pointer-events: none;
    }

    .labelfocus2 {
        position: absolute;
        left: 10px;
        top: 0px;
        font-size: 12px;
        font-weight: 200;
        color: black;
        transition: all 0.5s ease;
        pointer-events: none;
        display: block !important;
    }

    input[type=tel]:focus~.labelfocus,
    input[type=text]:focus~.labelfocus,
    input[type=email]:focus~.labelfocus,
    input[type=password]:focus~.labelfocus,
    select:focus~.labelfocus {
        display: block;
        color: black;
        left: 10px;
        top: 0px;
        font-size: 12px;
    }

    textarea,
    input {
        padding-top: 20px !important;
    }

    .scene-form .container {
        flex-direction: column;
    }
</style>
<div class="scene-form">
    <div class="container d-flex align-items-center justify-content-center" style="margin-bottom: 60px;">
        <h2 class="special-title mb-4">Cadastro</h2>
        <div class="card mt-4">
            <div class="card-header">
                <div class="col-md-8 text-right">
                    <?php if (isset($config->tickets_settings->active) && $config->tickets_settings->active) { ?>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">
                <div class="p-3">
                    <?php if (isset($config->custom_messages) && property_exists($config->custom_messages, 'users/add:info_user') && !empty($config->custom_messages->{'users/add:info_user'})) { ?>
                        <div class="alert alert-warning alert-information-user" role="alert">
                            <?php echo $config->custom_messages->{'users/add:info_user'}; ?>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div id="msg-erro">
                                <?= $this->Flash->render(); ?>
                            </div>
                            <?php if (!empty($erroMsg)): ?>
                                <div class="alert alert-danger">
                                    <?= $erroMsg; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- CPF e NOME -->
                    <div class="row">
                        <div class="col-xs-12 col-md-3 wrap-cpf pad-space-5">
                            <div class="form-group">
                                <?= $this->Form->control('cpf', [
                                    'type' => 'tel',
                                    'data-type' => 'cpf',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'autocapitalize' => 'off',
                                    'spellcheck' => 'false',
                                    'autocorrect' => 'off'
                                ]) ?>
                                <label class="labelfocus">CPF*</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-9 wrap-name pad-space-5">
                            <div class="form-group">
                                <?= $this->Form->control('name', [
                                    'label' => false,
                                    'autocorrect' => 'off',
                                    'class' => 'form-control',
                                    'required' => true,
                                    'autocomplete' => 'off',
                                    'maxlength' => '50',
                                    'pattern' => '[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s]{2,}',
                                    'title' => 'O campo só permite letras e limite de 50 caracteres'
                                ]) ?>
                                <label class="labelfocus nome_completo">Nome Completo*</label>
                            </div>
                        </div>
                    </div>

                    <!-- E-MAIL e CONFIRMAR E-MAIL -->
                    <div class="row">
                        <div class="col-xs-12 col-md-6 wrap-email pad-space-5">
                            <div class="form-group">
                                <?= $this->Form->control('email', [
                                    'type' => 'email',
                                    'autocorrect' => 'off',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'required' => true,
                                    'autocomplete' => 'off',
                                    'maxlength' => '254'
                                ]) ?>
                                <label class="labelfocus">E-mail*</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 wrap-email pad-space-5">
                            <div class="form-group">
                                <?= $this->Form->control('confirmar_email', [
                                    'type' => 'email',
                                    'autocorrect' => 'off',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'required' => true,
                                    'autocomplete' => 'off',
                                    'maxlength' => '254'
                                ]) ?>
                                <label class="labelfocus">Confirmar E-mail*</label>
                            </div>
                        </div>
                    </div>

                    <?php if ($colDNascCelTelSex): ?>
                        <!-- DATA NASCIMENTO, CELULAR E TEL FIXO -->
                        <div class="row">
                            <?php if ($config->user_fields_allowed->birth) { ?>
                                <div class="col-xs-12 col-md-<?= $colDNascCelTelSex; ?> wrap-birth pad-space-5">
                                    <div class="form-group">
                                        <?= $this->Form->control('birth', [
                                            'type' => 'tel',
                                            'label' => false,
                                            'class' => 'form-control',
                                            'required' => $config->user_fields_allowed->isRequired('birth')
                                        ]); ?>
                                        <label class="labelfocus">Data
                                            Nascimento<?= ($config->user_fields_allowed->isRequired('birth') ? '*' : ''); ?></label>
                                    </div>
                                </div>
                                <input type="hidden" id="minimal_age" value="<?= $config->minimal_age ?? 18; ?>" />
                            <?php } ?>
                            <?php if ($config->user_fields_allowed->cel) { ?>
                                <div class="col-xs-12 col-md-<?= $colDNascCelTelSex; ?> wrap-phone pad-space-5">
                                    <div class="form-group">
                                        <?= $this->Form->control('cel', [
                                            'type' => 'tel',
                                            'label' => false,
                                            'class' => 'form-control',
                                            'required' => $config->user_fields_allowed->isRequired('cel')
                                        ]) ?>
                                        <label class="labelfocus">Celular<?= ($config->user_fields_allowed->isRequired('cel') ? '*' : ''); ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($config->user_fields_allowed->phone) { ?>
                                <div class="col-xs-12 col-md-<?= $colDNascCelTelSex; ?> wrap-phone pad-space-5">
                                    <div class="form-group">
                                        <?= $this->Form->control('phone', [
                                            'type' => 'tel',
                                            'label' => false,
                                            'class' => 'form-control',
                                            'required' => $config->user_fields_allowed->isRequired('phone')
                                        ]) ?>
                                        <label class="labelfocus">Telefone
                                            Fixo<?= ($config->user_fields_allowed->isRequired('phone') ? '*' : ''); ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($config->user_fields_allowed->sex) { ?>
                                <!-- SEXO - OPCIONAL -->
                                <div class="col-xs-12 col-md-<?= $colDNascCelTelSex; ?> wrap-sex pad-space-5">
                                    <?= $this->Form->control(
                                        'sex',
                                        [
                                            'label' => false,
                                            'class' => 'form-control',
                                            'type' => 'select',
                                            'options' => [
                                                '' => '',
                                                'fem' => 'Feminino',
                                                'masc' => 'Masculino',
                                                'none' => 'Prefiro não responder',
                                            ],
                                            'style' => 'padding-top: 9px; padding-bottom: 1px;',
                                            'required' => $config->user_fields_allowed->isRequired('sex')
                                        ]
                                    );
                                    ?>
                                    <label class="labelfocus">Sexo<?= ($config->user_fields_allowed->isRequired('sex') ? '*' : ''); ?></label>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($colLoja): ?>
                        <!-- CNPJ, LOJA E TELEFONE DE LOJA -->
                        <div class="row">
                            <?php if ($config->user_fields_allowed->stores_cnpj) { ?>
                                <div class="col-xs-12 col-md-<?= $colLoja; ?> wrap-stores_cnpj pad-space-5">
                                    <div class="form-group">
                                        <?= $this->Form->control('stores_cnpj', [
                                            'label' => false,
                                            'autocorrect' => 'off',
                                            'class' => 'form-control',
                                            'data-type' => 'cnpj',
                                            'required' => $config->user_fields_allowed->isRequired('stores_cnpj'),
                                        ]) ?>
                                        <label class="labelfocus"><?= 'CNPJ da loja' . ($config->user_fields_allowed->isRequired('stores_cnpj') ? '*' : ''); ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($config->user_fields_allowed->stores_name) { ?>
                                <div class="col-xs-12 col-md-<?= $colLoja; ?> wrap-stores_name">
                                    <div class="form-group">
                                        <?= $this->Form->control('stores_name', [
                                            'label' => 'Razão Social' . ($config->user_fields_allowed->isRequired('stores_name') ? '*' : ''),
                                            'class' => 'form-control',
                                            'required' => $config->user_fields_allowed->isRequired('stores_name')
                                        ]) ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($config->user_fields_allowed->stores_phone) { ?>
                                <div class="col-xs-12 col-md-<?= $colLoja; ?> wrap-stores_phone">
                                    <div class="form-group">
                                        <?= $this->Form->control('stores_phone', [
                                            'label' => 'Telefone da loja' . ($config->user_fields_allowed->isRequired('stores_phone') ? '*' : ''),
                                            'class' => 'form-control',
                                            'required' => $config->user_fields_allowed->isRequired('stores_phone')
                                        ]) ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($config->user_fields_allowed->cep): ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-2 wrap-cep pad-space-5">
                                <div class="form-group">
                                    <?= $this->Form->control('cep', [
                                        'type' => 'tel',
                                        'label' => false,
                                        'class' => 'form-control',
                                        'required' => $config->user_fields_allowed->isRequired('cep')
                                    ]) ?>
                                    <label class="labelfocus"><?= 'CEP' . ($config->user_fields_allowed->isRequired('cep') ? '*' : ''); ?></label>
                                </div>
                            </div>
                            <?php if ($config->user_fields_allowed->address): ?>
                                <div class="col-xs-12 col-md-8 wrap-address pad-space-5">
                                    <div class="form-group">
                                        <?= $this->Form->control('address', [
                                            'label' => false,
                                            'class' => 'form-control',
                                            'required' => $config->user_fields_allowed->isRequired('address')
                                        ]) ?>
                                        <label class="labelfocus"><?= 'Logradouro' . ($config->user_fields_allowed->isRequired('address') ? '*' : ''); ?></label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($config->user_fields_allowed->number): ?>
                                <div class="col-xs-12 col-md-2 wrap-number pad-space-5">
                                    <div class="form-group">
                                        <?= $this->Form->control('number', [
                                            'type' => 'tel',
                                            'label' => false,
                                            'class' => 'form-control',
                                            'maxlength' => '6',
                                            'required' => $config->user_fields_allowed->isRequired('number')
                                        ]) ?>
                                        <label class="labelfocus"><?= 'Número' . ($config->user_fields_allowed->isRequired('number') ? '*' : ''); ?></label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($config->user_fields_allowed->complement || $config->user_fields_allowed->neighborhood): ?>
                            <div class="row">
                                <?php if ($config->user_fields_allowed->complement): ?>
                                    <div class="col-xs-12 col-md-4 wrap-complement pad-space-5">
                                        <div class="form-group">
                                            <?= $this->Form->control('complement', [
                                                'label' => false,
                                                'class' => 'form-control',
                                                'maxlength' => '20',
                                                'required' => $config->user_fields_allowed->isRequired('complement')
                                            ]) ?>
                                            <label class="labelfocus"><?= 'Complemento' . ($config->user_fields_allowed->isRequired('complement') ? '*' : ''); ?></label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($config->user_fields_allowed->complement): ?>
                                    <div class="col-xs-12 col-md-8 wrap-neighborhood pad-space-5">
                                        <div class="form-group">
                                            <?= $this->Form->control('neighborhood', [
                                                'label' => false,
                                                'class' => 'form-control',
                                                'maxlength' => '50',
                                                'required' => $config->user_fields_allowed->isRequired('neighborhood')
                                            ]) ?>
                                            <label class="labelfocus"><?= 'Bairro' . ($config->user_fields_allowed->isRequired('neighborhood') ? '*' : ''); ?></label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($config->user_fields_allowed->state || $config->user_fields_allowed->city): ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-4 wrap-state pad-space-5">
                                <div class="form-group">
                                    <?= $this->Form->control('state', [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'options' => [],
                                        'required' => $config->user_fields_allowed->isRequired('state')
                                    ]) ?>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-8 wrap-city pad-space-5">
                                <div class="form-group">
                                    <?= $this->Form->control('city', [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'options' => ['' => '<= Favor Selecionar um Estado'],
                                        'required' => $config->user_fields_allowed->isRequired('city')
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- SENHA e CONFIRMAR SENHA -->
                    <div class="row">
                        <!-- Campo Senha -->
                        <div class="col-xs-12 col-md-6 wrap-password pad-space-5" id="pass1">
                            <div class="form-group text-left" style="position: relative;">
                                <?= $this->Form->control('password', [
                                    'autocapitalize' => 'off',
                                    'autocorrect' => 'off',
                                    'autocomplete' => 'off',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'type' => 'password',
                                    'error' => false
                                ]) ?>
                                <label class="labelfocus">Senha*</label>
                                <span class="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <p style="color: #000; font-size: 11px;">*Senha deve conter no mínimo 8 caracteres, contendo uma letra maiúscula, uma minúscula e um número</p>
                        </div>

                        <!-- Campo Confirmar Senha -->
                        <div class="col-xs-12 col-md-6 wrap-confirm_password pad-space-5" id="pass2">
                            <div class="form-group" style="position: relative;">
                                <?= $this->Form->control('confirm_password', [
                                    'autocapitalize' => 'off',
                                    'autocorrect' => 'off',
                                    'autocomplete' => 'off',
                                    'type' => 'password',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'error' => false
                                ]) ?>
                                <label class="labelfocus">Confirmação de Senha*</label>
                                <span class="toggle-password-2" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div id="msg-erro">
                                <?= $this->Flash->render(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-8 text-left wrap-agree_terms">
                            <style>
                                .wrap-agree_terms .error-message {
                                    position: absolute;
                                    bottom: -15px;
                                    left: 16px;
                                }
                            </style>
                            <div class="form-group wrap-agree_terms" style="position: relative;margin-bottom: 25px;">
                                <?= $this->Form->control('agree_terms', [
                                    'label' => false,
                                    'type' => 'checkbox',
                                    'error' => false,
                                    'required' => true
                                ]) ?>
                                Li e aceito o <a href="/regulamento" target="_blank" class="">regulamento
                                    da promoção</a>.
                            </div>
                            <div class="form-group wrap-agree_terms" style="position: relative;margin-bottom: 25px;">
                                <?= $this->Form->control('policy_privacy', [
                                    'label' => false,
                                    'type' => 'checkbox',
                                    'error' => false,
                                    'required' => true
                                ]) ?>
                                Li e aceito os <a href="#" class="" data-toggle="modal"
                                    data-target="#modal-termos-de-uso">Termos de Uso</a> e a
                                <a href="#" class="" data-toggle="modal"
                                    data-target="#modal-politica-de-privacidade">Política de Privacidade</a> do site.
                            </div>
                            <?php if ($config->user_fields_allowed->email_recive_local):
                                $emailReciveLocalRequired = $config->user_fields_allowed->isRequired('email_recive_local');
                            ?>
                                <div class="form-group wrap-email_recive">
                                    <input type="checkbox" name="email_recive_local"
                                        value="1" <?= $emailReciveLocalRequired ? 'required="required"' : ''; ?>>
                                    Aceito receber notificações desta promoção via e-mail e
                                    SMS. <?= $emailReciveLocalRequired ? '*' : ''; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($config->user_fields_allowed->email_recive):
                                $emailReciveRequired = $config->user_fields_allowed->isRequired('email_recive');
                            ?>
                                <div class="form-group wrap-email_recive">
                                    <input type="checkbox" name="email_recive" value="1"
                                        checked="checked" <?= $emailReciveRequired ? 'required="required"' : ''; ?>>
                                    Aceito receber comunicações de marketing (novidades e promoções) por e-mail, SMS ou
                                    telefone, de forma a personalizar a minha experiência como
                                    cliente. <?= $emailReciveRequired ? '*' : ''; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-12 col-md-4 text-right wrap-agree_terms align-self-end">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btn-cadastrar">Cadastrar</button>
                            </div>
                            <div class="form-group">
                                <a class="btn" href="<?= $this->Url->build(['controller' => 'users', 'action' => 'login']) ?>">Já tenho cadastro</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordIcon = document.querySelector('.toggle-password i');
            const passwordField = document.querySelector('#pass1 input[name="password"]');

            if (togglePasswordIcon && passwordField) {
                document.querySelector('.toggle-password').addEventListener('click', function() {
                    if (passwordField.type === 'password') {
                        passwordField.type = 'text';
                        togglePasswordIcon.classList.remove('fa-eye');
                        togglePasswordIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordField.type = 'password';
                        togglePasswordIcon.classList.remove('fa-eye-slash');
                        togglePasswordIcon.classList.add('fa-eye');
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordIcon2 = document.querySelector('.toggle-password-2 i');
            const passwordField2 = document.querySelector('#pass2 input[name="confirm_password"]');

            if (togglePasswordIcon2 && passwordField2) {
                document.querySelector('.toggle-password-2').addEventListener('click', function() {
                    if (passwordField2.type === 'password') {
                        passwordField2.type = 'text';
                        togglePasswordIcon2.classList.remove('fa-eye');
                        togglePasswordIcon2.classList.add('fa-eye-slash');
                    } else {
                        passwordField2.type = 'password';
                        togglePasswordIcon2.classList.remove('fa-eye-slash');
                        togglePasswordIcon2.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>
</div>