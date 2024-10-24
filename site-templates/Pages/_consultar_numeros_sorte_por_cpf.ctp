<div class="scene-form">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="container pt-3">

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

                    <div class="row">
                        <div class="col-xs-12 col-md-12 wrap-cpf pad-space-5">
                            <div class="form-group text-center">
                                <?= $this->Form->control('cpf', [
                                    'type' => 'tel',
                                    'value' => $this->Html->sanitizedData('cpf'),
                                    'data-type' => 'cpf',
                                    'label' => 'Digite seu CPF',
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'autocapitalize' => 'off',
                                    'spellcheck' => 'false',
                                    'autocorrect' => 'off'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 text-right wrap-agree_terms">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="btn-consultar">Consultar</button>
                        </div>
                    </div>
                    <hr>
                    <?php if (isset($result) && $result->success): ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 wrap-cpf pad-space-5">
                                <!-- TODOS OS DADOS -->
                                <h4>Resultado completo</h4>
                                <table class="table table-compact">
                                    <thead>
                                    <tr>
                                        <th>CNPJ</th>
                                        <th>Cupom</th>
                                        <th>Data de compra</th>
                                        <th>Total do Cupom</th>
                                        <th>Números da Sorte</th>
                                        <th>Números de Série</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($result->result as $row): ?>
                                        <tr>
                                            <td><?= $row->Coupon->cnpj; ?></td>
                                            <td><?= $row->Coupon->tax_coupon; ?></td>
                                            <td><?= date("d/m/Y H:i", strtotime($row->Coupon->purchase_date)); ?></td>
                                            <td><?= $row->Coupon->cost; ?></td>
                                            <td>
                                                <?php
                                                foreach ($row->lucky_numbers as $ln) {
                                                    echo $ln->full_lucky_number . '<br>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                foreach ($row->serial_numbers as $sn) {
                                                    echo $sn->serial_number . '<br>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <!-- Apenas Cupons -->
                                <h4>Apenas Cupons</h4>
                                <table class="table table-compact">
                                    <thead>
                                    <tr>
                                        <th>Cupom</th>
                                        <th>Data de compra</th>
                                        <th>Total do Cupom</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($result->result as $row): ?>
                                        <tr>
                                            <td><?= $row->Coupon->tax_coupon; ?></td>
                                            <td><?= date("d/m/Y H:i", strtotime($row->Coupon->purchase_date)); ?></td>
                                            <td><?= $row->Coupon->cost; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <!-- APENAS NÚMEROS DA SORTE -->
                                <h4>Apenas números da sorte</h4>
                                <table class="table table-compact">
                                    <thead>
                                    <tr>
                                        <th>Série</th>
                                        <th>Número da Sorte</th>
                                        <th>Número da Sorte Completo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($result->result as $row): ?>
                                        <?php foreach ($row->lucky_numbers as $ln): ?>
                                            <tr>
                                                <td><?=$ln->serie;?></td>
                                                <td><?=$ln->lucky_number;?></td>
                                                <td><?=$ln->full_lucky_number;?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($result !== false && !$result->success): ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 wrap-cpf pad-space-5">
                                <div class="alert alert-danger"><?=$result->reason;?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
