<div class="scene-form page-sended-update-password">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4">
            <div class="card-header">
                <strong>Solicitação de nova Senha</strong>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="row pt-4 pb-4">
                        <div class="col-xs-12 col-md-12">
                            <p>
                                Acesse seu e-mail <strong><a href="#"><?= obfuscarEmail($email) ?></a></strong> e siga as orientações
                                para recuperar sua senha.
                                Caso sua conta de e-mail tenha anti-spam, coloque nosso endereço
                                <?php
                                $mailopts = $config->smtp_settings;
                                @print_r($mailopts->from);
                                ?> na sua lista de contatos para que você possa receber
                                nossas comunicações, incluindo o e-mail de confirmação de cadastro, que é enviado em até
                                24 horas.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>