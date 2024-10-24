<?php

/**
 * @var \App\View\AppView $this
 * @var int $daysToEnd - Dias que faltam para encerrar a campanha (zero se já chegou no final)
 * @var string $nextRaffleDate - vazio(null) se não temos sorteios configurados ou data no formato DD/MM/AAAA H:M para proximo sorteio
 * @var array|object $tickets - Colection de tíckets disponíveis ou vazio se não tivermos tickets
 * @var array $coupons_groups - Historico dos cupons registrados
 * @var array $luckyNumbers - Lista de números da sorte do participante
 * @var array $user - Dados do participante
 * @var array $premiosInstantaneos - Lista de prêmios instantâneos ganhos pelo participante (não funciona se PI estiver inativo)
 * @var int $qtdTentativasDisponiveis - Quantidade de tentativas disponiveis do participante para prêmio instantâneo (não funciona se PI estiver inativo)
 * @var array $awardedData - Existe apenas caso tenha ganho algum prêmio normal da campanha.
 * @var bool $showCadastrarBtn - se pode mostrar botão de cadastro de cupom
 * @var float $cost2Win - Valor para ganhar (só em caso cumulativo)
 * @var object $config - Configurações da campanha
 * @var int $promotionProgress - Porcentagem do andamento da campanha
 */
?>
<script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        user: {
            id: '<?php echo(isset($user) ? $user->id : ''); ?>',
            email: '<?php echo(isset($user) ? $user->email : ''); ?>',
            name: '<?php echo(isset($user) ? $user->name : ''); ?>'
        }
    });
    <?php if (isset($confirm) && isset($lastCoupom)) : ?>
    <?php foreach ($lastCoupom as $item) : ?>
    window.dataLayer.push({
        event: 'coupom-add-success',
        coupom: {
            id: '<?php echo(isset($item) ? $item->id : ''); ?>',
            document: '<?php echo(isset($item) ? $item->tax_coupon : ''); ?>',
            document_total_cost: '<?php echo(isset($item) ? $item->document_total_cost : ''); ?>',
            payment_type: '<?php echo(isset($item) ? $item->payment_key : ''); ?>',
            payment_type_cost: '<?php echo(isset($item) ? $item->cost : ''); ?>'
        }
    });
    <?php endforeach; ?>
    <?php endif; ?>
</script>
<style>
    .text-black {
        color: #000 !important;
    }

    .modal-dialog {
        max-width: 1140px;
    }

    .boxNumber {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-start;
        gap: 20px;
    }

    .boxNumber .box {
        background-color: var(--primary);
        color: var(--white);
        border-radius: 6px;
        min-width: 89px;
        min-height: 32px;
        padding-top: 6px;
        padding-bottom: 6px;
        padding-left: 16px;
        padding-right: 16px;
        text-decoration: none;
    }

    .boxNumber .box:hover {
        text-decoration: none;
    }

    .bg-success {
        background-color: #2AB226 !important;
    }

    .progress-bar {
        padding-right: 15px;
    }

    .boxInfo {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
    }

    .boxButtons {
        display: flex;
        justify-content: space-between;
        max-width: 500px;
        width: 100%;
        margin-top: 15px;
    }

    .stts {
        width: 13px;
        height: 33px;
        display: inline-flex;
    }

    .stts-green {
        background-color: #42ED9E;
    }

    .stts-red {
        background-color: #ED4257;
    }

    .stts-orange {
        background-color: #EDAB42;
    }

    .td-stts {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .table .thead-dark th {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .special-title {
        font-size: 19px;
    }
</style>
<section class="internal-page">
    <div class="container">
        <h2 class="special-title mb-4" style="font-size:32px !important;">Painel de controle</h2>

        <div class="row mb-4">
            <div class="col-12">
                <div class="p-2"></div>
                <?php if (isset($config->custom_messages) && property_exists(
                        $config->custom_messages,
                        'lucky_numbers_config/add:info_user'
                    ) && !empty($config->custom_messages->{'lucky_numbers_config/add:info_user'})) : ?>
                    <div class="alert alert-warning alert-information-user" role="alert">
                        <?php echo $config->custom_messages->{'lucky_numbers_config/add:info_user'}; ?>
                    </div>
                <?php endif; ?>
                <div class="p-1"></div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xs-12 col-md-4">
                <?php $flash_alerts = $this->Flash->render(); ?>
                <?= (!empty($flash_alerts)) ? $flash_alerts : ''; ?>
                <div id="msg-erro"></div>
            </div>
        </div>

        <?php if (isset($awardedData) && $awardedData->count() > 0) : ?>
            <?php foreach ($awardedData as $awarded): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <h5>Você foi sorteado na apuração do
                            dia <?= date('d/m/Y', strtotime($awarded->raffle_date)); ?></h5>
                    </div>
                    <div class="col-12">
                        Seu cupom <?= $awarded->taxcoupon; ?> foi sorteado.
                        <?php
                        switch ($awarded->awarded_state_id) {
                            case 1:
                                if (isset($awarded->user_documents) && count(json_decode($awarded->user_documents)) == 4) {
                                    echo "Seus documentos estão em análise, por favor aguarde.";
                                } else {
                                    echo '<a href="/private/users/sorteado-envia-documentos/?awid=' . $awarded->id . '" class="alert alert-warning">Clique
                                            aqui</a> e faça o upload dos documentos necessários para a validação de sua participação.';
                                }
                                break;
                            case 2:
                                echo 'Os documentos não foram aprovados, infelizmente você não ganhou este prêmio.<br>' .
                                    'Você receberá no endereço eletrônico cadastrado, o motivo da desclassificação.';
                                break;
                            case 3:
                                echo 'Parabéns! Os documentos foram aprovados, nosso time entrará em contato em breve para informar os próximos passos.';
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($config->premio_instantaneo_settings->active ?? false) : ?>
            <?php if (isset($qtdTentativasDisponiveis) && $qtdTentativasDisponiveis > 0) : ?>
                <div class="row mt-5 mb-4">
                    <div class="col-12">
                        Você ainda possui <?= $qtdTentativasDisponiveis ?? null; ?> chance(s) de participar
                        do
                        prêmio instantâneo.<br>
                        <a href="<?= \Cake\Routing\Router::url(['_name' => 'pi-participar']); ?>"
                           class="btn btn-primary mt-4">Clique aqui para participar</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="row mt-5 mb-4">
            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                <h2 class="special-title mb-4">Participação</h2>

                <div class="card boxCadCupom" style="min-height: 172px;">
                    <div class="card-body">
                        A cada R$ <?= number_format($config->coupon_value_to_win / 100, 2, ',', '.'); ?> em compras você
                        recebe 1 número da sorte.
                        <?php if ($config->coupon_cumulative && count($luckyNumbers) > 0) : ?>
                            <br>Cadastre um novo cupom no valor de R$ <?= number_format($cost2Win / 100, 2, ',', '.'); ?> e aumente as suas chances.
                        <?php endif; ?>

                        <?php if ($user->role == 0 && isset($showCadastrarBtn) && $showCadastrarBtn) : ?>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <a href="<?= $this->Url->build(['controller' => 'Coupons', 'action' => 'add']) ?>"
                                   class="btn btn-primary">
                                    Cadastrar cupom
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 mb-4">
                <h2 class="special-title mb-4">Progresso da campanha</h2>

                <div class="card boxCard " style="min-height: 172px;">
                    <div class="card-body">
                        Restam <?= $daysToEnd ?? 0; ?> dias para o encerramento. Aproveite para aumentar ainda mais as
                        suas chances.
                        <div class="progress mt-3"
                            style="height: 20px;border-radius: 14px;box-shadow: 0px 6px 15px #00000027;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?=$promotionProgress;?>%;"
                                aria-valuenow="<?=$promotionProgress;?>" aria-valuemin="0" aria-valuemax="100"><?=$promotionProgress;?>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 mb-4">
                <h2 class="special-title mb-4">Próximo sorteio</h2>
                <div class="card boxCard " style="min-height: 172px;">
                    <div class="card-body">
                        <?php if (!empty($nextRaffleDate)): ?>
                            Próximo sorteio será realizado em <?= $nextRaffleDate; ?>.
                        <?php else: ?>
                            Nenhum sorteio configurado
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                <h2 class="special-title mb-4">Meus números da sorte</h2>
                <div class="card" style="min-height: 228px;">
                    <div class="card-body">
                        <?php if (isset($luckyNumbers) && count($luckyNumbers) > 0) : ?>
                            <div class="boxNumber">
                                <?php foreach ($luckyNumbers as $luckyNumber) : ?>
                                    <a class="box">
                                        <?php if ($config->lucky_numbers_settings->display_serie) : ?>
                                            <?= $luckyNumber->serie ?>
                                        <?php endif; ?>
                                        <?= $luckyNumber->lucky_number ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <span class="text-center text-black">Não há números da sorte</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                <h2 class="special-title mb-4">Meus cupons</h2>

                <div class="card">
                    <div class="card-body">
                        <?php if (count($coupons_groups) > 0) :
                            $coupons = $coupons_groups[0];
                            ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Cupom /
                                            Nota Fiscal
                                        </th>
                                        <?php if (!$config->product_define_lucky_numbers_qty) : ?>
                                            <th scope="col">Valor</th>
                                        <?php endif; ?>
                                        <th scope="col">Compra realizada em</th>
                                        <th scope="col">Cupom cadastrado em</th>
                                        <th scope="col">Números da Sorte</th>
                                        <th scope="col">Observação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $lastThreeCoupons = array_slice($coupons, -3, 3, true);
                                    foreach ($lastThreeCoupons as $key => $coupom) : ?>
                                        <tr>
                                            <th scope="row"><?= $coupom->coupon->tax_coupon; ?></th>
                                            <?php if (!$config->product_define_lucky_numbers_qty) : ?>
                                                <td>R$ <?= number_format($coupom->value, 2, ',', '.') ?></td>
                                            <?php endif; ?>
                                            <td><?= $coupom->coupon->purchase_date <> null ? $coupom->coupon->purchase_date->format('d/m/Y') : ''; ?></td>
                                            <td><?= $coupom->coupon->insert_at <> null ? $coupom->coupon->insert_at->format('d/m/Y H:i') : ''; ?></td>
                                            <td>
                                                <?php if (isset($coupom->lucky_numbers) && count($coupom->lucky_numbers) > 0) { ?>
                                                    <?php $total_line_lucky_numbers = count($coupom->lucky_numbers); ?>
                                                    <?php foreach ($coupom->lucky_numbers as $luckyNumber) { ?>
                                                        <span class="badge badge-primary">
                                                                <?= (strpos($coupom->note, 'Invalidado') === false) ? '' : '<del>'; ?>
                                                            <?php if ($config->lucky_numbers_settings->display_serie) { ?>
                                                                <strong><?= $luckyNumber->serie ?></strong>
                                                            <?php } ?>
                                                            <?= $luckyNumber->lucky_number ?>
                                                            <?= (strpos($coupom->note, 'Invalidado') === false) ? '' : '</del>'; ?>
                                                            </span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($coupom->erroMsg)): ?>
                                                    <p style="color: red;text-transform: uppercase">
                                                        Erro: <?= $coupom->erroMsg; ?>
                                                    </p>
                                                <?php else: ?>
                                                    <?php echo $coupom->note; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <span class="text-center text-black">Não há cupons</span>
                        <?php endif; ?>

                        <div class="col-12 d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#verMaisMeusCupons">
                                Ver mais
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                <div class="d-flex justify-content-between align-items-start">
                    <h2 class="special-title mb-4">Atendimentos</h2>
                    <?php if ($config->tickets_settings->active) : ?>
                        <a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'tickets']) ?>"
                           class="btn btn-primary">Novo atendimento</a>
                    <?php endif; ?>
                </div>

                <div class="card" style="min-height: 393px;">
                    <div class="card-body">
                        <?php if (!empty($tickets)) : ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Assunto</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($tickets as $ticket) : ?>
                                        <tr>
                                            <th scope="row"><?= $ticket->id; ?></th>
                                            <td><?= $ticket->assunto; ?></td>
                                            <td class="td-stts">
                                                <span class="stts stts-<?= $this->TicketStatus->colors($ticket->status); ?>"></span>
                                                <?= $this->TicketStatus->frontMake($ticket->status); ?>
                                            </td>
                                            <td>
                                                <?= $this->Html->link('<strong>Detalhes</strong>', [
                                                    'controller' => 'Users',
                                                    'action' => 'ticket',
                                                    $ticket->id
                                                ], ['escape' => false])
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#verMaisAtendimentos">
                                    Ver mais
                                </button>
                            </div>
                        <?php else : ?>
                            <span class="text-center text-black">Não há tickets abertos</span>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                <h2 class="special-title mb-4">Informações Pessoais</h2>

                <div class="card">
                    <div class="card-body">
                        <div class="boxInfo">
                            <?php
                            $user_info = array(
                                'Nome completo' => array(
                                    'value' => $user->name,
                                    'allowed' => $config->user_fields_allowed->name,
                                    'required' => $config->user_fields_allowed->name_required
                                ),
                                'E-mail' => array(
                                    'value' => $user->email,
                                    'allowed' => $config->user_fields_allowed->email,
                                    'required' => $config->user_fields_allowed->email_required
                                ),
                                'Data de Nascimento' => array(
                                    'value' => $user->birth,
                                    'allowed' => $config->user_fields_allowed->birth,
                                    'required' => $config->user_fields_allowed->birth_required
                                ),
                                'CPF' => array(
                                    'value' => $user->cpf,
                                    'allowed' => $config->user_fields_allowed->cpf,
                                    'required' => $config->user_fields_allowed->cpf_required
                                ),
                                'CEP' => array(
                                    'value' => $user->cep,
                                    'allowed' => $config->user_fields_allowed->cep,
                                    'required' => $config->user_fields_allowed->cep_required
                                ),
                                'Endereço' => array(
                                    'value' => $user->address,
                                    'allowed' => $config->user_fields_allowed->address,
                                    'required' => $config->user_fields_allowed->address_required
                                ),
                                'Número' => array(
                                    'value' => $user->number,
                                    'allowed' => $config->user_fields_allowed->number,
                                    'required' => $config->user_fields_allowed->number_required
                                ),
                                'Complemento' => array(
                                    'value' => $user->complement,
                                    'allowed' => $config->user_fields_allowed->complement,
                                    'required' => $config->user_fields_allowed->complement_required
                                ),
                                'Bairro' => array(
                                    'value' => $user->neighborhood,
                                    'allowed' => $config->user_fields_allowed->neighborhood,
                                    'required' => $config->user_fields_allowed->neighborhood_required
                                ),
                                'Cidade' => array(
                                    'value' => $user->city,
                                    'allowed' => $config->user_fields_allowed->city,
                                    'required' => $config->user_fields_allowed->city_required
                                ),
                                'Estado' => array(
                                    'value' => $user->state,
                                    'allowed' => $config->user_fields_allowed->state,
                                    'required' => $config->user_fields_allowed->state_required
                                ),
                                'Telefone' => array(
                                    'value' => $user->phone,
                                    'allowed' => $config->user_fields_allowed->phone,
                                    'required' => $config->user_fields_allowed->phone_required
                                ),
                                'Celular' => array(
                                    'value' => $user->cel,
                                    'allowed' => $config->user_fields_allowed->cel,
                                    'required' => $config->user_fields_allowed->cel_required
                                ),
                                'Sexo' => array(
                                    'value' => $user->sex,
                                    'allowed' => $config->user_fields_allowed->sex,
                                    'required' => $config->user_fields_allowed->sex_required
                                ),
                                // 'Receber e-mails' => array(
                                //     'value' => $user->email_recive,
                                //     'allowed' => $config->user_fields_allowed->email_recive,
                                //     'required' => $config->user_fields_allowed->email_recive_required
                                // ),
                                // 'Local de recebimento de e-mails' => array(
                                //     'value' => $user->email_recive_local,
                                //     'allowed' => $config->user_fields_allowed->email_recive_local,
                                //     'required' => $config->user_fields_allowed->email_recive_local_required
                                // ),
                                // 'CNPJ das lojas' => array(
                                //     'value' => $user->stores_cnpj,
                                //     'allowed' => $config->user_fields_allowed->stores_cnpj,
                                //     'required' => $config->user_fields_allowed->stores_cnpj_required
                                // ),
                                // 'Nome das lojas' => array(
                                //     'value' => $user->stores_name,
                                //     'allowed' => $config->user_fields_allowed->stores_name,
                                //     'required' => $config->user_fields_allowed->stores_name_required
                                // ),
                                // 'Telefone das lojas' => array(
                                //     'value' => $user->stores_phone,
                                //     'allowed' => $config->user_fields_allowed->stores_phone,
                                //     'required' => $config->user_fields_allowed->stores_phone_required
                                // )
                            );
                            ?>
                            <?php foreach ($user_info as $field => $info) : ?>
                                <?php if ($info['allowed']) : ?>
                                    <span><?= $field ?>: <?= $info['value'] ?></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="boxButtons">
                            <a class="text-dark"
                               href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'edit']) ?>"
                               style="text-decoration:underline;"><strong>Alterar meus dados</strong></a>
                            <a class="text-dark"
                               href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'edit']) ?>"
                               style="text-decoration:underline;"><strong>Alterar minha senha</strong></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>


    <!-- Modal Meus Cupons -->
    <div class="modal fade" id="verMaisMeusCupons" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Histórico de cupons</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Cupom /
                                    Nota Fiscal
                                </th>
                                <?php if (!$config->product_define_lucky_numbers_qty) : ?>
                                    <th scope="col">Valor</th>
                                <?php endif; ?>
                                <th scope="col">Compra realizada em</th>
                                <th scope="col">Cupom cadastrado em</th>
                                <th scope="col">Números da Sorte</th>
                                <th scope="col">Observação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($coupons as $coupom) : ?>
                                <tr>
                                    <th scope="row"><?= $coupom->coupon->tax_coupon; ?></th>
                                    <?php if (!$config->product_define_lucky_numbers_qty) : ?>
                                        <td>R$ <?= number_format($coupom->value, 2, ',', '.') ?></td>
                                    <?php endif; ?>
                                    <td><?= $coupom->coupon->purchase_date <> null ? $coupom->coupon->purchase_date->format('d/m/Y') : ''; ?></td>
                                    <td><?= $coupom->coupon->insert_at <> null ? $coupom->coupon->insert_at->format('d/m/Y H:i') : ''; ?></td>
                                    <td>
                                        <?php if (isset($coupom->lucky_numbers) && count($coupom->lucky_numbers) > 0) { ?>
                                            <?php $total_line_lucky_numbers = count($coupom->lucky_numbers); ?>
                                            <?php foreach ($coupom->lucky_numbers as $luckyNumber) { ?>
                                                <span class="badge badge-primary">
                                                        <?= (strpos(
                                                                $coupom->note,
                                                                'Invalidado'
                                                            ) === false) ? '' : '<del>'; ?>
                                                    <?php if ($config->lucky_numbers_settings->display_serie) { ?>
                                                        <strong><?= $luckyNumber->serie ?></strong>
                                                    <?php } ?>
                                                    <?= $luckyNumber->lucky_number ?>
                                                    <?= (strpos(
                                                            $coupom->note,
                                                            'Invalidado'
                                                        ) === false) ? '' : '</del>'; ?>
                                                    </span>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($coupom->erroMsg)): ?>
                                            <p style="color: red;text-transform: uppercase">
                                                Erro: <?= $coupom->erroMsg; ?>
                                            </p>
                                        <?php else: ?>
                                            <?php echo $coupom->note; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Atendimentos -->
    <div class="modal fade" id="verMaisAtendimentos" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atendimentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($tickets)) : ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Assunto</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tickets as $ticket) : ?>
                                    <tr>
                                        <th scope="row"><?= $ticket->id; ?></th>
                                        <td><?= $ticket->assunto; ?></td>
                                        <td class="td-stts">
                                            <span class="stts stts-<?= $this->TicketStatus->colors($ticket->status); ?>"></span>
                                            <?= $this->TicketStatus->frontMake($ticket->status); ?>
                                        </td>
                                        <td>
                                            <?= $this->Html->link('<strong>Detalhes</strong>', [
                                                'controller' => 'Users',
                                                'action' => 'ticket',
                                                $ticket->id
                                            ], ['escape' => false])
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</section>