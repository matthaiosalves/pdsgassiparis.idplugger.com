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
                            <h4>Os valores abaixo estão corretos?</h4>
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
                        <div class="col-xs-12 col-md-6 wrap-conf_tax_coupon">
                            <div class="form-group">
                                <label>Número do Cupom Fiscal</label>
                                <input type="text" id="txt-conf_tax_coupon" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 wrap-conf_purchase_date">
                            <div class="form-group">
                                <label>Data da Compra</label>
                                <input type="text" id="txt-conf_purchase_date" class="form-control" readonly="readonly"
                                       autocomplete="off">
                            </div>
                        </div>
                        <?php if ($showValueField ?? false) { ?>
                            <div class="col-xs-12 col-md-6 wrap-conf_cost">
                                <div class="form-group">
                                    <label>Valor total do cupom</label>
                                    <input type="text" id="txt-conf_cost" class="form-control" readonly="readonly">
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if (($showValueField ?? false) && ($show_payment_options ?? false)) { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2 font-weight-bold">Forma de Pagamento</p>
                            </div>
                        </div>
                        <div class="row" id="conf_payment">
                        </div>
                    <?php } ?>

                    <?php if ($config->use_serial_numbers) { ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="font-weight-bold">Produtos</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div id="conf_serial_numbers"></div>
                            </div>
                        </div>
                    <?php } ?>
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
            <h3 class="mx-4 px-3">Cadastro de Cupom</h3>
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
                        <div class="col-md-12 order-0 order-md-1">
                            <p class="text-right mt-3 mb-4">
                                <a data-toggle="collapse" href="#collapseNF"
                                   style="display: inline-block; width: auto; text-decoration: none; padding: 10px;border: 1px solid #DDD;border-radius: 6px;background: #f1f1f1;">
                                    Quer saber onde
                                    encontrar <?php if ($config->request_store_document) { ?>o CNPJ e <?php } ?>o Número
                                    do Cupom Fiscal? <span class="badge badge-primary"
                                                           style="font-size: 16px;margin-left: 10px;">Clique aqui</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="collapse" id="collapseNF"
                             style="padding: 15px 10px;border: 1px solid #DDD;margin: 0 20px 20px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Existem alguns diferentes formatos de Nota Fiscal, por isso vamos exibir
                                            abaixo elas para você verificar qual é similar a que você possui, e nelas
                                            você pode visualizar onde encontrar as informações do CNPJ da loja e também
                                            do seu Número de Cupom Fiscal.</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Nota Fiscal Eletrônica (NF-e)</strong>
                                        </p>
                                        <p class="text-center">
                                            <img class="img-fluid" src="/assets/img/NF-e.jpg" alt="NF-e"/>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Cupom Fiscal</strong>
                                        </p>
                                        <p class="text-center">
                                            <img class="img-fluid" src="/assets/img/NF.png" alt="NF"/>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Documento Auxiliar de Nota Fiscal Eletrônica (NFC-e)</strong>
                                        </p>
                                        <p class="text-center">
                                            <img class="img-fluid" src="/assets/img/NFC-e.jpg" alt="NFC-e"/>
                                        </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Cupom Fiscal Eletrônico (SAT)</strong>
                                        </p>
                                        <p class="text-center">
                                            <img class="img-fluid" src="/assets/img/SAT.jpg" alt="SAT"/>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-primary" data-toggle="collapse"
                                                href="#collapseNF">Ocultar exemplos
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <div class="col-xs-12 col-md-<?= ($showValueField ? '6' : '4'); ?> wrap-tax_coupon">
                            <div class="form-group">

                                <?= $this->Form->control(
                                    'tax_coupon',
                                    [
                                        'label' => 'Número do Cupom ou Nota Fiscal*',
                                        'class' => 'form-control',
                                        'minlength' => (isset($user_limits->limit_coupom_characters_qty_minimum) && ($user_limits->limit_coupom_characters_qty_minimum > 0)) ? $user_limits->limit_coupom_characters_qty_minimum : 1,
                                        'maxlength' => (isset($user_limits->limit_coupom_characters_qty_max) && ($user_limits->limit_coupom_characters_qty_max > 0)) ? $user_limits->limit_coupom_characters_qty_max : 255,
                                        'required' => true
                                    ]
                                );

                                ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-<?= ($showValueField ? '6' : '4'); ?> wrap-purchase_date">
                            <div class="form-group">
                                <?= $this->Form->control('purchase_date', ['label' => 'Data da Compra*', 'class' => 'form-control', 'type' => 'text', 'autocomplete' => 'off']) ?>
                            </div>
                        </div>
                        <?php if ($showValueField && !$show_payment_options) { ?>
                            <div class="col-xs-12 col-md-6 wrap-cost">
                                <div class="form-group">
                                    <?= $this->Form->control('cost', ['label' => 'Valor total do cupom*:', 'class' => 'form-control money', 'type' => 'tel']) ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="wrap-quizzes">
                        <?php if (isset($quizzes) && count($quizzes) > 0) { ?>
                            <?php foreach ($quizzes as $quiz) { ?>
                                <div class="wrap-quiz quiz-id-<?php echo $quiz->id; ?>">
                                    <?php if (isset($quiz->quiz_questions) && count($quiz->quiz_questions) > 0) { ?>
                                        <?php
                                        if ($quiz->shuffle_questions) {
                                            shuffle($quiz->quiz_questions);
                                        }
                                        ?>
                                        <?php foreach ($quiz->quiz_questions as $question) { ?>
                                            <div class="row wrap-quiz-questionb question-id-<?php echo $question->id; ?>">
                                                <div class="col">
                                                    <div class="form-group mb-0">
                                                        <label><?php echo $question->question_text; ?></label>
                                                    </div>
                                                    <div class="row wrap-answers">
                                                        <?php if (isset($question->quiz_questions_answers) && count($question->quiz_questions_answers) > 0) { ?>
                                                            <?php
                                                            if ($quiz->shuffle_answers) {
                                                                shuffle($question->quiz_questions_answers);
                                                            }
                                                            ?>
                                                            <?php
                                                            $quiz_classWrap = 'input-text';
                                                            $quiz_nameInput = 'quizzes.' . $quiz->id . '.' . $question->id;
                                                            $quiz_type = 'text';
                                                            $quiz_classInput = 'form-control';
                                                            $quiz_wrapInputClass = 'form-group';
                                                            $quiz_value = '';
                                                            $quiz_label = '';
                                                            $quiz_control_method = 'control';

                                                            switch ($question->answer_type) {
                                                                case 'string':
                                                                    break;
                                                                case 'options':
                                                                    $quiz_classWrap = 'input-radio';
                                                                    $quiz_type = 'radio';
                                                                    $quiz_classInput = '';
                                                                    $quiz_control_method = 'radio';
                                                                    $quiz_wrapInputClass = '';
                                                                    break;
                                                                case 'multi_options':
                                                                    $quiz_classWrap = 'input-check';
                                                                    $quiz_type = 'checkbox';
                                                                    $quiz_classInput = 'form-check-input';
                                                                    $quiz_wrapInputClass = 'form-check';
                                                                    break;
                                                            }
                                                            ?>
                                                            <?php if ($question->answer_type === 'string' || $question->answer_type === 'multi_options') { ?>
                                                                <?php foreach ($question->quiz_questions_answers as $answer) { ?>
                                                                    <?php
                                                                    switch ($question->answer_type) {
                                                                        case 'string':
                                                                            $quiz_nameInput = 'quizzes.' . $quiz->id . '.' . $question->id . '.' . $answer->id;
                                                                            if (count($question->quiz_questions_answers) > 1) {
                                                                                $quiz_label = $answer->answer_text;
                                                                            } else {
                                                                                $quiz_label = false;
                                                                            }
                                                                            break;
                                                                        case 'multi_options':
                                                                            $quiz_nameInput = 'quizzes.' . $quiz->id . '.' . $question->id . '.' . $answer->id;
                                                                            $quiz_classWrap = 'input-check';
                                                                            $quiz_type = 'checkbox';
                                                                            $quiz_classInput = 'form-check-input';
                                                                            $quiz_label = $answer->answer_text;
                                                                            $quiz_value = $answer->id;
                                                                            $quiz_wrapInputClass = 'form-check';
                                                                            break;
                                                                    }
                                                                    ?>
                                                                    <div class="col-md-12 <?php echo $quiz_classWrap; ?>">
                                                                        <div class="<?php echo $quiz_wrapInputClass; ?>">
                                                                            <?php
                                                                            $q_params = array(
                                                                                'value' => $quiz_value,
                                                                                'class' => $quiz_classInput,
                                                                                'type' => $quiz_type,
                                                                                'escape' => false,
                                                                            );
                                                                            if ($question->answer_type !== 'options') {
                                                                                $q_params['label'] = $quiz_label;
                                                                            }
                                                                            ?>
                                                                            <?= $this->Form->control(
                                                                                $quiz_nameInput,
                                                                                $q_params
                                                                            ) ?>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } else if ($question->answer_type === 'options') { ?>
                                                                <?php
                                                                $q_options = [];
                                                                foreach ($question->quiz_questions_answers as $answer) {
                                                                    $q_options[$answer->id] = $answer->answer_text;
                                                                }
                                                                ?>
                                                                <div class="col-md-12 <?php echo $quiz_classWrap; ?>">
                                                                    <div class="<?php echo $quiz_wrapInputClass; ?>">
                                                                        <?php
                                                                        $q_params = array(
                                                                            'label' => false,
                                                                            'class' => $quiz_classInput,
                                                                            'type' => $quiz_type,
                                                                            'escape' => false,
                                                                            'options' => $q_options
                                                                        );
                                                                        ?>
                                                                        <?= $this->Form->control(
                                                                            $quiz_nameInput,
                                                                            $q_params
                                                                        ) ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <?php if ($showValueField && $show_payment_options) { ?>
                        <div class="row wrap-payment-methods-box <?= (isset($payment_methods) && count($payment_methods) === 1) ? 'd-none' : '' ?>">
                            <div class="col">
                                <div class="form-group">
                                    <label>Qual foi a forma de pagamento utilizada?*</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($showValueField) {
                                            foreach ($payment_methods as $key => $payment_method) { ?>
                                                <div class="form-group">
                                                    <div class="row row-input-cost">
                                                        <div class="col-sm-6 input-check">
                                                            <?= $this->Form->control(
                                                                'payment_method[' . $payment_method["value"] . ']',
                                                                array(
                                                                    'label' => $payment_method["text"],
                                                                    'value' => 1,
                                                                    'type' => 'checkbox',
                                                                    'escape' => false,
                                                                )
                                                            ) ?>
                                                        </div>
                                                        <div class="col-sm-6 input-val">
                                                            <?= $this->Form->control(
                                                                'payment_method_cost[' . $payment_method["value"] . ']',
                                                                array(
                                                                    'label' => '',
                                                                    'type' => 'text',
                                                                    'pattern' => '\d*',
                                                                    'escape' => false,
                                                                    'class' => 'form-control money form-money',
                                                                    'id' => 'cost_' . $payment_method["value"],
                                                                    'disabled' => 'disabled',
                                                                    'value' => 0,
                                                                    'data-descricao' => $payment_method["text"]
                                                                )
                                                            ) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 input-check">
                                                    <strong>Valor total:</strong>
                                                </div>
                                                <div class="col-sm-6 input-val">
                                                    <?= $this->Form->control('cost', ['label' => '', 'class' => 'form-control money form-money', 'type' => 'text', 'readonly']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            var paymentOptions = <?php echo json_encode($config->payment_methods->options); ?>;
                        </script>
                    <?php } ?>

                    <?php if (isset($config->receipt_ticket_settings) && $config->receipt_ticket_settings->active) { ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-6 mt-3 pb-3 wrap-receipt_ticket">
                                <div class="form-group">
                                    <label>Envie a imagem ou arquivo do cupom fiscal*</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="receipt_ticket"
                                               name="receipt_ticket"
                                               accept="<?= $config->receipt_ticket_settings->extensions; ?>"/>
                                        <label class="custom-file-label" for="receipt_ticket">Escolher um
                                            arquivo...</label>
                                    </div>
                                    <i>Recomendação: Tamanho máximo de <?=env('UPLOAD_LIMIT_KB')/1024;?>mb</i>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($config->use_serial_numbers) { ?>
                        <div class="row mt-4">
                            <div class="col-md-12 pb-4">
                                <p class="h5">Informe abaixo os produtos adquiridos que fazem parte da promoção.</p>
                            </div>
                            <?php if ($config->user_select_serial_numbers) { ?>
                                <div class="col-md-4 wrap-produtos">
                                    <div class="form-group">
                                        <?= $this->Form->control('Produtos', [
                                            'type' => 'select',
                                            'class' => 'form-control select2',
                                            'options' => $serialNumbers ?? [],
                                            'id' => 'txt-numero_serie'
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="col-md-2 wrap-produtos imgProduto"></div>
                            <?php } else { ?>
                                <div class="col-md-6 wrap-produtos">
                                    <div class="form-group">
                                        <?php if ($config->use_name_in_serial_numbers) { ?>
                                            <label>Digite o nome do produto adquirido.</label>
                                        <?php } else { ?>
                                            <label>Digite o número de série do produto adquirido</label>
                                        <?php } ?>
                                        <input type="text" id="txt-numero_serie" class="form-control"/>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2 col-xs-6 wrap-quant">
                                <div class="form-group">
                                    <label class="w-100">Quantidade</label>
                                    <div class="input-group">
                                        <span class="input-group-btn d-flex">
                                            <button type="button" class="btn btn-sm btn-primary btn-number mx-1 my-auto"
                                                    disabled="disabled" data-type="minus" data-field="quant[1]">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </span>
                                        <input type="text" name="quant[1]" class="form-control input-number text-center"
                                               value="1" min="1" max="200">
                                        <span class="input-group-btn d-flex">
                                            <button type="button" class="btn btn-sm btn-primary btn-number mx-1 my-auto"
                                                    data-type="plus" data-field="quant[1]">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php if ($config->use_total_from_sum_products) { ?>
                                <div class="col-md-2 col-xs-6 wrap-valor-unitario">
                                    <div class="form-group">
                                        <label>Valor unitário</label>
                                        <input type="text" id="txt-valor_unitario"
                                               class="form-control money form-money"/>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2 col-xs-6">
                                <div class="form-group">
                                    <label class="w-100">&nbsp;</label>
                                    <button type="button" class="w-100 btn btn-primary" id="add-numero_serie">
                                        Adicionar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12">

                                <table width="100%" class="table table-striped mt-3">
                                    <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="wrapperNumerosSerie">
                                    <?php if (isset($sendedSerialNumbers) && count($sendedSerialNumbers) > 0) { ?>
                                        <?php foreach ($sendedSerialNumbers as $key => $numeroSerie) { ?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="numeros_serie[<?= $key ?>][qty]"
                                                           value="<?= $numeroSerie['qty'] ?>" class="ns_qty">
                                                    <?php if (isset($numeroSerie['cost'])) { ?>
                                                        <input type="hidden" name="numeros_serie[<?= $key ?>][cost]"
                                                               value="<?= $numeroSerie['cost'] ?>">
                                                    <?php } ?>
                                                    <?= $numeroSerie['qty'] ?>X - <?= $numeroSerie['name']; ?>
                                                </td>
                                                <td>
                                                    <button class='btn btn-danger btn-sm' type='button'
                                                            onclick='removeNumeroSerie(this)'>Remover da lista
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    <?php } ?>

                    <?php if (
                        $config->ln_multiplier_setting->active &&
                        !empty($config->ln_multiplier_setting->field_label)
                    ) { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <input type="checkbox" name="ln_multiplier" value="1" />
                                        </div>
                                        <div class="col-sm-11 input-check">
                                            <?=$config->ln_multiplier_setting->field_label;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php //CASO PRECISAR REGISTRAR UM CAMPO EXTRA, descomente e mude o name do campo abaixo ?>
                    <!--
                    <div class="row">
                        <div class="col-md-6 wrap-produtos">
                            <div class="form-group">
                                <label>Campo extra</label>
                                <input type="text" name="meta[extra]" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    -->
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
<script>
    <?php $this->Html->scriptStart(array('block' => 'scriptBottom', 'inline' => false)); ?>
    /* Caso for usar a API , usar o script abaixo:
    $(function() {
        $("#form-pin").attr('action', '/private/coupons/add_api');
    });
     */
    <?php $this->Html->scriptEnd(); ?>
</script>