<?= $this->Flash->render() ?>

<div class="scene-form page-changed-update-password senha">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4">
            <div class="card-body">

                <div class="mt-4 pb-4">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 text-center">
                            <h1>Senha Alterada com Sucesso</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 text-center">
                            <a class="btn btn-primary"
                               href="<?= $this->Url->build(['controller' => 'users', 'action' => 'login']) ?>">Login</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
