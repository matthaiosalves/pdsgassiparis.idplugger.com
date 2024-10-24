<?php
echo $this->Flash->render();
?>
<script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: 'user-register-success',
        user: {
            id: '<?php echo (isset($user) ? $user->id : ''); ?>',
            email: '<?php echo (isset($user) ? $user->email : ''); ?>',
            name: '<?php echo (isset($user) ? $user->name : ''); ?>'
        }
    });
</script>
<style>
    .scene-form .container {
        flex-direction: column;
    }
</style>
<div class="scene-form">
    <div class="container d-flex align-items-center justify-content-center" style="margin-bottom: 60px;">
        <h2 class="special-title mb-4">Cadastro Realizado com Sucesso!</h2>
        <div class="card mt-4">
            <div class="card-body">
                <div class="">
                    <div class="d-flex align-items-center justify-content-center pt-4 pb-4">
                        <div class="d-flex flex-column">
                            <?php if (isset($user) && $user->role == 4 && !empty($user->internalcode)) { ?>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 text-center pt-4 pb-4 text-center">
                                        <p class="h6">Seu código de vendedor para compartilhar com seus clientes é:</p>
                                        <p class="h1">
                                            <?php echo $user->internalcode; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 text-center pt-4 pb-4">
                                        <a class="btn btn-primary"
                                            href="<?= $this->Url->build(['controller' => 'LuckyNumbers', 'action' => 'index']) ?>">Tela
                                            de acompanhamento</a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <?php if ($config->user_win_luck_number_on_register): ?>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 text-center pt-4 pb-4">
                                            <a class="btn btn-primary"
                                                href="<?= $this->Url->build(['controller' => 'LuckyNumbers', 'action' => 'index']) ?>">Ver
                                                meu número da sorte</a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php if ($config->user_can_register_coupons): ?>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 text-center pt-4 pb-4">
                                                <a class="btn btn-primary"
                                                    href="<?= $this->Url->build(['controller' => 'coupons', 'action' => 'add']) ?>">Cadastrar
                                                    Cupom</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 text-center pt-4 pb-4">
                                                <a class="btn btn-primary"
                                                    href="<?= $this->Url->build(['controller' => 'LuckyNumbers', 'action' => 'index']) ?>">Acessar
                                                    Painel</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>