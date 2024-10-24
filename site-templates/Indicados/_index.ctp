<div class="scene-form">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4">
            <div class="card-header">
                <h3>Cadastro de indicados</h3>
            </div>
            <div class="card-body">
                <div class="pt-3">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <?= $this->Flash->render(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Link para divulgação:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="mylink" value="<?= $link; ?>"/>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="btnCopyLink">Copiar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="form-group justify-content-around">
                                <label class="labelfocus">E-mail do indicado</label>
                                <?= $this->Form->control('email', [
                                    'type' => 'email',
                                    'autocorrect' => 'off',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'required' => true,
                                    'autocomplete' => 'off',
                                    'maxlength' => '254'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right wrap-agree_terms my-auto">
                            <div class="form-group">
                                <a href="/lucky-numbers" class="btn btn-outline-secondary">Voltar</a>
                                <button type="submit" class="btn btn-primary" id="btnCadastrarIndicado">Indicar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    <?php $this->Html->scriptStart(array('block' => 'scriptBottom', 'inline' => false)); ?>
    $(function () {
        checkRecaptchaV3($("#form-indicados"));
        $("#mylink").on('keydown', function (e) {
            e.preventDefault();
        });
        $("#btnCopyLink").on('click', function () {
            copy2Clipboard();
            $(this).removeClass('btn-outline-secondary').addClass('btn-outline-success').text('Copiado');
        });
    });

    function copy2Clipboard() {
        /* Get the text field */
        var copyText = document.getElementById("mylink");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");
    }
    <?php $this->Html->scriptEnd(); ?>
</script>
