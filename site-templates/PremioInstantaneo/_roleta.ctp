<?= $this->Flash->render(); ?>
<link rel="stylesheet" href="/webroot/front/public/<?= $config->template_version; ?>/css/PremioInstantaneo/roleta.css" />
<style>
    .premio-raspadinha {
        padding-top: 80px;
        padding-bottom: 80px;
    }
</style>
<div class="premio-raspadinha">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center m-auto">
                <div class="form-group">
                    <h3>Olá, <?= $user['name'] ?? ''; ?>!</h3>
                    <div class="mt-4 mb-3">
                        <div class="wheel-container">
                            <canvas id="wheel" width="500" height="500"></canvas>
                            <div class="arrow"></div>
                            <div class="center-circle"></div> <!-- Novo círculo central -->
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-5">
                            <button class="btn btn-primary" id="spinButton">GIRE A ROLETA</button>
                        </div>
                    </div>
                    <?php if (empty($premioInstantaneo->codigo)) : ?>
                        <input type="hidden" id="winningIndex" value="0" />
                        <div class="row">
                            <div class="col-12">
                                <div id="instrucoes" class="text-center d-none">
                                    <b>Não foi desta vez</b>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <input type="hidden" id="winningIndex" value="1" />
                        <!-- Foi sorteado -->
                        <div id="instrucoes" class="d-none">
                            <?php if (isset($premioInstantaneo->coupon)) : ?>
                                <div class="alert alert-warning">
                                    Código: <b><?= $premioInstantaneo->codigo; ?></b><br>
                                    CPF: <b><?= $user['cpf']; ?></b><br>
                                    <?php if (strlen($premioInstantaneo->coupon->cnpj) >= 14) : ?>
                                        LOJA: <b><?= $premioInstantaneo->coupon->cnpj; ?></b><br>
                                    <?php endif; ?>
                                    Realizado em: <b><?= $premioInstantaneo->created_at->format('d/m/Y H:i'); ?></b>
                                </div>
                            <?php else : ?>
                                Aguarde pois muito em breve iremos entrar em contato.
                                <br>
                                <br>
                                <div class="alert alert-warning">
                                    Código: <b><?= $premioInstantaneo->codigo; ?></b><br>
                                    CPF: <b><?= $user['cpf']; ?></b>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div id="btnContinuar" class="col-xs-12 col-md-12 text-center d-none">
                        <div class="form-group">
                            <?php if (isset($porOnde) && $porOnde == 'cadastro') : ?>
                                <a href="<?= $this->Url->build($redirect ?? ['controller' => 'LuckyNumbers', 'action' => 'index']) ?>" class="btn btn-primary">Continuar</a>
                            <?php else : ?>
                                <a href="<?= $this->Url->build($redirect ?? ['controller' => 'Coupons', 'action' => 'index']) ?>" class="btn btn-primary">Continuar</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/webroot/front/public/<?= $config->template_version; ?>/js/PremioInstantaneo/roleta.js"></script>