<?php
$config = $config ?? null;
?>
<style>
    .datepicker table tr td.disabled,
    .datepicker table tr td.disabled:hover {
        color: silver;
    }
</style>
<div class="scene-form">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4">
            <h3 class="mx-4 px-3">Cupom em processamento</h3>
            <div class="card-body pt-4">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            Seu cupom foi gerado, porém, devido a abundante quantidade de números da sorte para serem
                            gerados, este processo irá ser feito em paralelo por até 1 hora.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-primary"
                           href="<?= $this->Url->build(['controller' => 'luckyNumbers', 'action' => 'index']) ?>">Meus
                            Cupons</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>