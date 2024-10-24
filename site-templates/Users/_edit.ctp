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

$validMetas = ['facebook', 'instagram'];
?>
<div class="scene-form">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4">
            <h3 class="mx-4 px-2">Cadastro</h3>
            <div class="card-body">
                <div class="">
                    <div class="row">
                        <div class="col-12">
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
                    <div class="row pb-4">
                        <div class="col text-right">
                            <?php if (isset($config->tickets_settings->active) && $config->tickets_settings->active) { ?>
                                <a class="btn btn-sm btn-secondary"
                                   href="<?= $this->Url->build(['controller' => 'users', 'action' => 'tickets']) ?>">
                                    Precisa de ajuda? Abra um <?php echo $config->tickets_settings->name; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-xs-12 col-md-4 wrap-name">
                            <div class="form-group">
                                <?= $this->Form->control('username', [
                                    'label' => 'Nome de usuário',
                                    'autocorrect' => 'off',
                                    'autocomplete' => 'off',
                                    'class' => 'form-control',
                                    'readonly' => true
                                ]); ?>
                                <small class="text-mutted" style="color: #cccccc; font-size: 10px;">Utilizado para se
                                    autenticar. Este campo não pode ser modificado. Para alterar, entre em contato com a
                                    central de atendimento da promoção.</small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 wrap-password">
                            <div class="form-group">
                                <?= $this->Form->control('password', [
                                    'autocapitalize' => 'off',
                                    'autocorrect' => 'off',
                                    'autocomplete' => 'off',
                                    'label' => 'Senha',
                                    'class' => 'form-control',
                                    'value' => ''
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 wrap-confirm_password">
                            <div class="form-group">
                                <?= $this->Form->control('confirm_password', array(
                                    'autocapitalize' => 'off',
                                    'autocorrect' => 'off',
                                    'autocomplete' => 'off',
                                    'type' => 'password',
                                    'label' => 'Confirmação de Senha',
                                    'class' => 'form-control',
                                    'value' => ''
                                )); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-xs-12 col-md-6 wrap-name">
                            <?php if ($user_canot_edit_account ?? false) { ?>
                                <div class="alert alert-warning alert-information-user" role="alert">
                                    <span>A alteração de cadastro não está autorizada neste momento.</span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <?php if ($config->user_fields_allowed->name) {
                            $label = (isset($user->cpf) && strlen($user->cpf) <= 14) ? 'Nome Completo' : 'Razão Social'; ?>
                            <div class="col-xs-12 col-md-6 wrap-name">
                                <div class="form-group">
                                    <?= $this->Form->control('name', [
                                        'label' => $label . ($config->user_fields_allowed->isRequired('name') ? '*' : ''),
                                        'autocorrect' => 'off',
                                        'class' => 'form-control',
                                        'readonly' => true //WHM-3993: campo nome não pode ser editado pelo usuário
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->cpf) {
                            $label = (strlen($user->cpf) <= 14) ? 'CPF' : 'CNPJ'; ?>
                            <div class="col-xs-12 col-md-3 wrap-cpf">
                                <div class="form-group">
                                    <?= $this->Form->control('cpf', [
                                        'type' => 'tel',
                                        'label' => $label . ($config->user_fields_allowed->isRequired('cpf') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account || $user->username == $user->cpf
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->birth && strlen($user->cpf) <= 14) { ?>
                            <div class="col-xs-12 col-md-3 wrap-birth">
                                <div class="form-group">
                                    <?php if ($birth = $user->birth) {
                                        $birth = $user->birth->format('d/m/Y');
                                    } ?>
                                    <?= $this->Form->control('birth', array(
                                        'type' => 'tel',
                                        'label' => 'Data Nascimento' . ($config->user_fields_allowed->isRequired('birth') ? '*' : ''),
                                        'class' => 'form-control',
                                        'value' => $birth,
                                        'readonly' => $user_canot_edit_account
                                    )); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if ($config->user_fields_allowed->email) { ?>
                            <div class="col-xs-12 col-md-6 wrap-email">
                                <div class="form-group">
                                    <?= $this->Form->control('email', [
                                        'type' => 'email',
                                        'autocorrect' => 'off',
                                        'label' => 'Email' . ($config->user_fields_allowed->isRequired('email') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account || $user->username == $user->email
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->cel) { ?>
                            <div class="col-xs-12 col-md-3 wrap-phone">
                                <div class="form-group">
                                    <?= $this->Form->control('cel', [
                                        'type' => 'tel',
                                        'label' => 'Celular' . ($config->user_fields_allowed->isRequired('cel') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account || $user->username == $user->cel
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->phone) { ?>
                            <div class="col-xs-12 col-md-3 wrap-phone">
                                <div class="form-group">
                                    <?= $this->Form->control('phone', [
                                        'type' => 'tel',
                                        'label' => 'Telefone Fixo' . ($config->user_fields_allowed->isRequired('phone') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->sex && strlen($user->cpf) <= 14) { ?>
                            <div class="col-xs-12 col-md-<?= $colDNascCelTelSex; ?> wrap-phone">
                                <div class="form-group">
                                    <?= $this->Form->control(
                                        'sex',
                                        array(
                                            'label' => 'Sexo' . ($config->user_fields_allowed->isRequired('sex') ? '*' : ''),
                                            'class' => 'form-control',
                                            'type' => 'select',
                                            'readonly' => $user_canot_edit_account,
                                            'options' => [
                                                '' => '',
                                                'fem' => 'Feminino',
                                                'masc' => 'Masculino',
                                                'none' => 'Prefiro não responder',
                                            ]
                                        ));
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if (!empty($user->user_metas)): ?>
                            <?php foreach ($user->user_metas as $row):
                                if (!in_array($row->meta_key, $validMetas)) {
                                    continue;
                                }
                                ?>
                                <div class="col-xs-12 col-md-6 wrap-name pad-space-5">
                                    <div class="form-group">
                                        <label class="labelfocus"><?= ucfirst($row->meta_key); ?>*</label>
                                        <?= $this->Form->control('meta[' . $row->meta_key . ']', [
                                            'label' => false,
                                            'class' => 'form-control',
                                            'required' => true,
                                            'readonly' => $user_canot_edit_account,
                                            'value' => $row->meta_value
                                        ]); ?>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php if ($config->user_fields_allowed->address) { ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <h5>Endereço</h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <?php if ($config->user_fields_allowed->cep) { ?>
                            <div class="col-xs-12 col-md-2 wrap-cep">
                                <div class="form-group">
                                    <?= $this->Form->control('cep', [
                                        'type' => 'tel',
                                        'label' => 'CEP' . ($config->user_fields_allowed->isRequired('cep') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->address) { ?>
                            <div class="col-xs-12 col-md-4 wrap-address">
                                <div class="form-group">
                                    <?= $this->Form->control('address', [
                                        'label' => 'Logradouro' . ($config->user_fields_allowed->isRequired('address') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->number) { ?>
                            <div class="col-xs-12 col-md-2 wrap-number">
                                <div class="form-group">
                                    <?= $this->Form->control('number', [
                                        'type' => 'tel',
                                        'label' => 'Número' . ($config->user_fields_allowed->isRequired('number') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->complement) { ?>
                            <div class="col-xs-12 col-md-4 wrap-complement">
                                <div class="form-group">
                                    <?= $this->Form->control('complement', [
                                        'label' => 'Complemento' . ($config->user_fields_allowed->isRequired('complement') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if ($config->user_fields_allowed->neighborhood) { ?>
                            <div class="col-xs-12 col-md-4 wrap-neighborhood">
                                <div class="form-group">
                                    <?= $this->Form->control('neighborhood', [
                                        'label' => 'Bairro' . ($config->user_fields_allowed->isRequired('neighborhood') ? '*' : ''),
                                        'class' => 'form-control',
                                        'readonly' => $user_canot_edit_account
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->state) { ?>
                            <div class="col-xs-12 col-md-4 wrap-state">
                                <div class="form-group">
                                    <?= $this->Form->control('state', [
                                        'label' => 'Estado' . ($config->user_fields_allowed->isRequired('state') ? '*' : ''),
                                        'class' => 'form-control',
                                        'options' => [],
                                        'readonly' => $user_canot_edit_account
                                    ]); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($config->user_fields_allowed->city) { ?>
                            <div class="col-xs-12 col-md-4 wrap-city">
                                <div class="form-group">
                                    <?= $this->Form->control('city', [
                                        'label' => 'Cidade' . ($config->user_fields_allowed->isRequired('city') ? '*' : ''),
                                        'class' => 'form-control',
                                        'options' => ['' => '- Favor Selecionar um Estado -'],
                                        'readonly' => $user_canot_edit_account
                                    ]); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if ($config->user_fields_allowed->email_recive_local): ?>
                            <div class="col-xs-12 col-md-4 wrap-state">
                                <div class="form-group">
                                    <?= $this->Form->control('email_recive_local', [
                                        'label' => 'Aceito receber notificações desta promoção via e-mail e SMS.' . ($config->user_fields_allowed->isRequired('email_recive_local') ? '*' : ''),
                                        'type' => 'checkbox',
                                        'style' => 'margin: 10px 10px 0 0px;',
                                        'readonly' => $user_canot_edit_account
                                    ]) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($config->user_fields_allowed->email_recive): ?>
                            <div class="col-xs-12 col-md-4 wrap-state">
                                <div class="form-group">
                                    <?= $this->Form->control('email_recive', [
                                        'label' => 'Aceito receber comunicações de marketing (novidades e promoções) por e-mail, SMS ou telefone, de forma a personalizar a minha experiência como cliente.' . ($config->user_fields_allowed->isRequired('email_recive') ? '*' : ''),
                                        'type' => 'checkbox',
                                        'style' => 'margin: 10px 10px 0 0px;',
                                        'readonly' => $user_canot_edit_account
                                    ]) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <div class="form-group">
                                <input type="submit" value="Salvar" class="btn btn-success" id="btn-cadastrar"/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>