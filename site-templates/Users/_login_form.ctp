<?= $this->Html->css('custom-login.css') ?>

<div class="bg_lateral d-flex login py-5">
    <div class="container-fluid my-auto">
        <div class="row">
            <?php if ($config->user_can_register_account) { ?>
                <div class="col-md-6 cadastrar">
                    <div class="box text-center">
                        <h1>
                            AINDA NÃO TENHO CADASTRO
                        </h1>
                        <p class="text-white font-weight-light my-4">
                            Clique no botão Quero me cadastrar para preencher o formulário de cadastro.
                        </p>
                        <a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'add']) ?>" class="btn">Quero me cadastrar</a>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-6 login">
                <?= $this->Flash->render(); ?>
                <div class="box text-center">
                    <h2>JÁ TENHO CADASTRO</h2>
                    <p class="my-4">Acesse sua conta</p>
                    <div class="wrap-email">
                        <div class="form-group">
                            <?= $this->Form->control('username', [
                                'type' => 'text',
                                'data-type' => $config->user_field_username,
                                'label' => $config->username_options[$config->user_field_username],
                                'class' => 'form-control text-center',
                                'required' => 'required',
                                'placeholder' => 'Digite aqui o seu ' . $config->username_options[$config->user_field_username]
                            ]) ?>
                        </div>
                    </div>
                    <div class="wrap-password mt-2">
                        <div class="form-group">
                            <?= $this->Form->control('password', [
                                'label' => 'Senha',
                                'autocapitalize' => 'off',
                                'autocorrect' => 'off',
                                'class' => 'form-control text-center',
                                'required' => 'required',
                                'placeholder' => 'Digite sua senha de acesso'
                            ]) ?>
                        </div>
                    </div>
                    <div class="entrar text-center">
                        <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>
                    <div class="wrap-link-forgotpassword my-2">
                        <div class="form-group text-center">
                            <a href="<?= $this->Url->build(['controller' => 'ForgotPassword', 'action' => 'index']) ?>">Esqueci
                                minha senha</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let campos_login = document.querySelectorAll("#form-login > div.bg_lateral > div > div > *");
    let login = document.querySelector("#form-login .login");

    if (campos_login.length <= 1) {
        login.classList.remove("col-md-6");
        login.classList.add("col-md-12");
    }
</script>
<script>
    <?php $this->Html->scriptStart(array('block' => 'scriptBottom', 'inline' => false)); ?>
    $(function() {
        checkRecaptchaV3($("#form-login"));
    });
    <?php $this->Html->scriptEnd(); ?>
</script>