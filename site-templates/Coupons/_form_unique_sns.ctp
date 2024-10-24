<?php
$config = $config ?? null;
?>
<style>
    .datepicker table tr td.disabled,
    .datepicker table tr td.disabled:hover {
        color: silver;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div id="msg-erro">
            <?= $this->Flash->render(); ?>
        </div>
    </div>
</div>
<input type="hidden" name="tax_coupon" value="<?=uniqid('USN_');?>"/>
<input type="hidden" name="purchase_date" value="<?= date('d/m/Y'); ?>"/>
<input type="hidden" name="cost" value="1"/>
<input type="hidden" name="numeros_serie[][qty]" value="1" id="pin_field_qtd">
<input type="hidden" name="numeros_serie[][cost]" value="1" id="pin_field_cost">
<!-- Modal Confirmacao -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h4>O(s) valor(es) abaixo esta(ão) correto(s)?</h4>
                        </div>
                    </div>
                    <div class="row">
                        <?php if ($config->request_store_document ?? false) { ?>
                            <div class="col-xs-12 col-md-6 wrap-conf_cnpj">
                                <div class="form-group">
                                    <label>CNPJ</label>
                                    <input type="text" id="txt-conf_cnpj" class="form-control" readonly="readonly">
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-xs-12 col-md-6 wrap-conf_pincode">
                            <div class="form-group">
                                <label>PINCODE digitado</label>
                                <input type="text" id="txt-conf_pincode" class="form-control" readonly="readonly">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Corrigir</button>
                <button type="button" class="btn btn-success"
                        onclick="$(this).attr('disabled', true);$('#form-pin').submit();">Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="scene-form">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4">
            <h3 class="mx-4 px-3">Cadastro de Pincodes</h3>
            <div class="card-body pt-4">
                <div class="">
                    <?php if (isset($config->custom_messages) && property_exists($config->custom_messages, 'coupons/add:info_user') && !empty($config->custom_messages->{'coupons/add:info_user'})) { ?>
                        <div class="alert alert-warning alert-information-user" role="alert">
                            <?php echo $config->custom_messages->{'coupons/add:info_user'}; ?>
                        </div>
                    <?php } ?>
                    <?php if ($config->tickets_settings->active) { ?>
                        <div class="row">
                            <div class="col text-right">
                                <a class="btn btn-sm btn-secondary"
                                   href="<?= $this->Url->build(['controller' => 'users', 'action' => 'ticketNew']) ?>">Precisa
                                    de ajuda? Abra um <?php echo $config->tickets_settings->name; ?></a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <?php if ($config->request_store_document && !$config->store_document_selection): ?>
                            <div class="col-xs-12 col-md-<?= ($showValueField ? '6' : '4'); ?> wrap-cnpj">
                                <div class="form-group">
                                    <label>CNPJ*</label>
                                    <?= $this->Form->control('cnpj', ['label' => false, 'class' => 'form-control']) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($config->request_store_document && $config->store_document_selection): ?>
                            <?= $this->Form->control('cnpj', ['type' => 'hidden', 'value' => '']) ?>
                            <div class="col-xs-12 col-md-<?= ($showValueField ? '6' : '4'); ?> wrap-cnpj">
                                <div class="form-group">
                                    <label>Nome do Estabelecimento*</label>
                                    <?= $this->Form->control('stores', [
                                        'label' => false,
                                        'type' => 'select',
                                        'class' => 'form-control select2',
                                        'options' => $stores ?? [],
                                        'id' => 'select-stores',
                                        'onchange' => 'setCnpj(this)'
                                    ]); ?>
                                </div>
                            </div>
                            <script>
                                function setCnpj(el) {
                                    $("#cnpj").val($(el).val());
                                }
                            </script>
                        <?php endif; ?>
                    </div>

                    <?php if ($config->use_serial_numbers) { ?>
                        <div class="row mt-4">
                            <div class="col-md-6 wrap-produtos">
                                <div class="form-group">
                                    <label>Digite seu pincode no campo abaixo</label>
                                    <input type="text" id="txt-numero_serie" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <?php //CASO PRECISAR REGISTRAR UM CAMPO EXTRA, descomente e mude o name do campo abaixo ?>
                        <!--
                        <div class="row mt-4">
                            <div class="col-md-6 wrap-produtos">
                                <div class="form-group">
                                    <label>Campo extra</label>
                                    <input type="text" name="meta[extra]" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        -->
                    <?php } ?>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div id="msg-erro"></div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <a class="btn btn-secondary"
                                   href="<?= $this->Url->build(['controller' => 'luckyNumbers', 'action' => 'index']) ?>">Meus
                                    Cupons</a>
                                <button class="btn btn-primary <?php if (!($this->request->getData('numeros_serie') && count($this->request->getData('numeros_serie')) > 0)) { ?>disabled<?php } ?>"
                                        href="#" id="btn-cadastrar">Cadastrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<style>
    .wrap-answers {
    }

    .wrap-answers .input-radio {
    }

    .wrap-answers .input-radio label {
        margin-right: 20px;
    }

    .wrap-answers .input-radio input {
        margin-right: 10px;
    }

    a.chosen-single {
        height: 38px !important;
        padding-top: 7px !important;
    }

    a.chosen-single > div {
        padding-top: 7px !important;
    }
</style>