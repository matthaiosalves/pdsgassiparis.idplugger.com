<?= $this->Flash->render(); ?>

    <div class="bg_lateral d-flex py-5">
        <div class="container-fluid my-auto">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 text-center m-auto">
                    <div class="form-group">
                        <h3>Olá, <?= $user['name'] ?? ''; ?>!</h3>
                        <?php if (empty($premioInstantaneo->codigo)): ?>
                            <p>Não foi desta vez.</p>
                            <h5>Boa sorte!</h5>
                        <?php else: ?>
                            <p><strong>Você foi o(a) sorteado(a) do dia!</strong></p>
                            <br>
                            <br>
                            <h5>Parabéns!</h5>
                            <div class="alert alert-warning">
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
                        <?php endif; ?>
                    </div>
                    <a href="<?= $this->Url->build($redirect ?? ['_name' => 'painel']) ?>"
                       class="btn btn-primary">Continuar</a>
                </div>
            </div>
        </div>
    </div>

<?= $this->Form->end() ?>