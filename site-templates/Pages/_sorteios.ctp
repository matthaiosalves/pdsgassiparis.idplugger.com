<?php
function maskCpf($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    return 'xxx.xxx.' . substr($cpf, 6, 3) . '-' . substr($cpf, -2);
}

?>
<!-- banner interno -->
<style>
    .table .thead-dark th {
        background-color: var(--secondary);
        border-color: var(--secondary);
        vertical-align: middle;
        text-align: center;
        font-weight: bold;
        color: #fff !important;
    }

    .table thead th {
        font-size: 22px;
    }

    .box-sorteio .table thead th i {
        color: #fff;
    }

    .table-sorteio .special-title {
        text-align: start;
    }

    .table-sorteio .special-title:after {
        margin-top: 10px;
        margin-left: 0;
        margin-right: 0;
    }

    .table-sorteio .box-sorteio {
        background-color: #ffffff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 767px) {
        .table-sorteio table tr:first-child th {
            font-size: 18px;
        }
    }
</style>
<section class="banner-interno">
    <div class="container mb-4">
        <div class="row justify-content-center">
            <h2 class="special-title mb-4">Sorteios/Ganhadores</h2>
        </div>
    </div>

    <?php if (isset($premiosNormais) && $premiosNormais->count()) : ?>
        <div class="container table-sorteio">
            <h2 class="special-title mb-4">Sorteios</h2>
            <div class="box-sorteio">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Data do sorteio</th>
                                <th scope="col"><i class="fa fa-gift" aria-hidden="true"></i> Prêmio(s)</th>
                                <th scope="col"><i class="fa fa-trophy" aria-hidden="true"></i> Ganhador</th>
                                <th scope="col"><i class="fa fa-ticket" aria-hidden="true"></i> Nº da sorte</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $position = 1;
                            foreach ($premiosNormais as $row) : ?>
                                <tr>
                                    <td><?= (isset($row->raffle_date) ? $row->raffle_date->format('d/m/Y') : ''); ?></td>
                                    <td><?= $row->premio; ?></td>
                                    <?php if (!empty($row->user_name)) : ?>
                                        <td>
                                            <?= $position++; ?>° -
                                            <i class="fas fa-trophy"></i>
                                            <strong>Nome:</strong> <?= $row->user_name ?>
                                            <br />
                                            <i><strong>CPF:</strong> <?= substr($row->user_cpf, 0, 3) . '.xxx.xxx-xx' ?></i>
                                        </td>
                                        <td><?= $row->lucky_number; ?></td>
                                    <?php else : ?>
                                        <td colspan="2" class="text-center">
                                            <i>Ainda não foram<br>publicados os ganhadores, aguarde.</i>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container table-sorteio">
            <h2 class="special-title mb-4">Sorteios</h2>
            <div class="box-sorteio">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"><i class="fa fa-gift" aria-hidden="true"></i> Prêmio(s)</th>
                                <th scope="col"><i class="fa fa-trophy" aria-hidden="true"></i> Ganhador</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center"><i>Nenhum sorteio até o momento</i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($premiosInstantaneos)) : ?>
        <div class="container table-sorteio">
            <h2 class="special-title mb-4">Prêmios instantâneos</h2>
            <div class="box-sorteio">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <!-- <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Data do sorteio</th> -->
                                <th scope="col"><i class="fa fa-gift" aria-hidden="true"></i> Prêmio(s)</th>
                                <th scope="col"><i class="fa fa-trophy" aria-hidden="true"></i> Ganhador</th>
                                <!-- <th scope="col"><i class="fa fa-ticket" aria-hidden="true"></i> Nº da sorte</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($premiosInstantaneos->count() > 0) : ?>
                                <?php foreach ($premiosInstantaneos as $row) : ?>
                                    <tr>
                                        <td><?= $row->premio; ?></td>
                                        <td><strong>Nome:</strong> <?= $row->user_name ?>
                                            <br />
                                            <i><strong>CPF:</strong> <?= substr($row->user_cpf, 0, 3) . '.xxx.xxx-xx' ?></i>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4"><i>Nenhum prêmio até o momento</i></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($premiosNormais->count()) : ?>
        <div class="skew d-flex justify-content-center">
            <div class="no-skew text-right">
                <?php if ($limit == 'all') : ?>
                    <a href="<?= \Cake\Routing\Router::url(['controller' => 'pages', 'action' => 'sorteios']); ?>" class="btn btn-secondary">ver menos</a>
                <?php else : ?>
                    <a href="<?= \Cake\Routing\Router::url(['controller' => 'pages', 'action' => 'sorteios']); ?>/all" class="btn btn-secondary">ver mais</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prêmio</h4>
            </div>
            <div class="modal-body">
                <p><?= $award->name ?? ''; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>