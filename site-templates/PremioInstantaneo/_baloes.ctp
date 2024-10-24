<?= $this->Flash->render(); ?>
<div class="bg_lateral premio-raspadinha d-flex">
    <div class="container-fluid my-auto">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 text-center m-auto">
                <div class="form-group">
                    <h3>Olá, <?= $user['name'] ?? ''; ?>!</h3>
                    <small>Clique na imagem abaixo para participar</small>
                    <div class="balao">
                        <img src="/webroot/front/public/novo.live1.ps.com.br/images/balao.jpg" id="img-balao">
                    </div>
                    <?php if (!empty($premioInstantaneo->codigo)) : ?>
                        <div id="instrucoes" class="d-none">
                            <div class="">
                                <?= $config->premio_instantaneo_settings->winner_instructions ?? 'Aguarde pois muito em breve iremos entrar em contato.'; ?>
                                <br>
                                <br>
                                <?php
                                $wf = $config->premio_instantaneo_settings->winner_fields ?? [];
                                foreach ($wf as $field) {
                                    switch ($field) {
                                        case 'codigo':
                                            echo "Código: <b>{$premioInstantaneo->codigo}</b><br>";
                                            break;
                                        case 'user.cpf':
                                            echo "CPF: <b>{$user['cpf']}</b><br>";
                                            break;
                                        case 'award.name':
                                            echo "Prêmio: <b>{$premioInstantaneo->regra_aplicada->award_name}</b><br>";
                                            break;
                                        case 'coupon.cnpj':
                                            if (isset($premioInstantaneo->coupon) && strlen($premioInstantaneo->coupon->cnpj) >= 14) {
                                                echo "LOJA: <b>{$premioInstantaneo->coupon->cnpj}</b><br>";
                                            }
                                            break;
                                        case 'created_at':
                                            echo "Realizado em: <b>{$premioInstantaneo->created_at->format('d/m/Y H:i')}</b><br>";
                                            break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 text-center">
                <div class="form-group">
                    <?php if (isset($porOnde) && $porOnde == 'cadastro') : ?>
                        <a href="<?= $this->Url->build($redirect ?? ['controller' => 'LuckyNumbers', 'action' => 'index']) ?>"
                           class="btn btn-primary d-none">Continuar</a>
                    <?php else : ?>
                        <a href="<?= $this->Url->build($redirect ?? ['controller' => 'Coupons', 'action' => 'index']) ?>"
                           class="btn btn-primary d-none">Continuar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php $this->Html->scriptStart(array('block' => 'scriptBottom', 'inline' => false)); ?>
    $(function () {
        $('.balao > img').on('click', function () {
            $(this).parent().parent().find('small').hide();
            $(this).attr('src', '/webroot/front/public/novo.live1.ps.com.br/images/balao-animado.gif');
            setTimeout(function () {
                $('#instrucoes').removeClass('d-none');
                $('.btn-primary').removeClass('d-none');
                <?php if (!empty($premioInstantaneo->codigo)) : ?>
                $('.balao > img').attr('src', '/assets/img/raspadinha/ganhou.jpg');
                <?php else:?>
                $('.balao > img').attr('src', '/assets/img/raspadinha/nao-ganhou.jpg');
                <?php endif;?>
            }, 5000)
        });
    });
    <?php $this->Html->scriptEnd(); ?>
</script>