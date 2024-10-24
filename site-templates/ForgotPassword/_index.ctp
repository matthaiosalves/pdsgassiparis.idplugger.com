<?= $this->Flash->render(); ?>
<div class="scene-form senha">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4" style="width: 22rem;">
            <div class="card-header text-center">
                <strong>Solicitar nova Senha</strong>
            </div>
            <div class="card-body">
                <div class=" pt-3 pb-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 wrap-cpf">
                                    <div class="form-group">
                                        <?= $this->Form->control('email', [
                                            'data-type' => 'email',
                                            'label' => 'E-mail',
                                            'class' => 'form-control'
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 text-center">
                                    <div class="form-group">
                                        <input type="submit" value="Solicitar Nova Senha" class="btn btn-primary w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>