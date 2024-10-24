<?= $this->Flash->render(); ?>
    <script>
        <?php if ($porOnde == 'apos_cupom' && !empty($coupon)): ?>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'cupom-register-success',
            coupom: {
                id: '<?= $coupon->id; ?>',
                document: '<?= $coupon->tax_coupon; ?>',
                document_total_cost: '<?= $coupon->document_total_cost; ?>',
                payment_type: '<?= $coupon->payment_key; ?>',
                payment_type_cost: '<?=$coupon->cost; ?>'
            }
        });
        <?php endif; ?>
    </script>
    <div class="bg_lateral d-flex py-5">
        <div class="container-fluid my-auto">
            <div class="col-lg-3 col-md-6 col-12 text-center m-auto">
                <div class="form-group">
                    <h3>Olá, <?=$user['name'] ?? '';?></h3>
                    <?php
                    switch ($porOnde ?? null){
                        case 'cadastro':
                        case 'apos_cadastro':
                        case 'quiz':
                        case 'apos_quiz':
                            echo '<p>Obrigado por se cadastrar!</p>';
                            break;
                        default:
                            echo '<p>Seu cupom foi cadastrado!</p>';
                    }
                    ?>
                    <br>
                    <p>Agora chegou a hora de tentar a sorte!
                        Você pode ganhar um prêmio instantâneo.</p>
                </div>
                <button type="submit" class="btn btn-primary">Participar</button>
            </div>
        </div>
    </div>
<?= $this->Form->end() ?>