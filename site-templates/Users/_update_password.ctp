<div class="scene-form senha">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4" style="width: 22rem;">
            <div class="card-header text-center">
                <strong>Redefinir Senha</strong>
            </div>
            <div class="card-body">

                <div class="">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <?= $this->Flash->render() ?>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($hide_form) && $hide_form === true) { ?>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 wrap-password">
                                <div class="form-group">
                                    <?= $this->Form->control('password', ['label' => 'Senha', 'required' => 'required', 'class' => 'form-control', 'required' => 'required']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 wrap-confirm_password">
                                <div class="form-group">
                                    <?= $this->Form->control('confirm_password', ['label' => 'Confirmação de Senha', 'type' => 'password', 'required' => 'required', 'class' => 'form-control', 'required' => 'required']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <small>Senha deve conter no mínino 8 caracteres, contendo uma letra maiúscula, uma
                                        minúscula e um número</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 text-center">
                                <div class="form-group">
                                    <input type="submit" value="Redefinir Senha" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>
