<?php
/**
 * @var $awardedsId
 */
?>
<style>
    .file-drop-zone {
        height: 450px;
    }

    .fileinput-remove-button,
    .fileinput-remove-button:hover,
    .fileinput-cancel-button,
    .fileinput-cancel-button:hover,
    .fileinput-upload-button,
    .fileinput-upload-button:hover {
        background-color: inherit;
    }
</style>
<!-- banner interno -->
<section class="banner-interno position-relative docs-send">
    <?php $listaDocs = 0; ?>
    <div class="container text-center">
        <h1 class="special-title">
            Envio de documentos do sorteado
        </h1>
        <div class="box-sorteio">
            <div class="box-inner">
                <?php if (!empty($premiado)) : ?>
                    <table class="table">
                        <tr>
                            <th>Data do sorteio</th>
                            <th>Prêmio(s)</th>
                            <th>Sorteado</th>
                            <th>Número da sorte</th>
                            <th>Cupom relacionado</th>
                        </tr>
                        <tr>
                            <td><?= $premiado->raffle_date->format('d/m/Y \à\s H:i:s'); ?></td>
                            <td>
                                <?= $premiado->premio; ?>
                            </td>
                            <td><i class="fas fa-trophy"></i>
                                <strong>Nome:</strong> <?= $premiado->user_name; ?>
                                <br/>
                                <i><strong>CPF:</strong> <?= substr($premiado->user_cpf, 0, 3) . '.xxx.xxx-xx' ?></i>
                            </td>
                            <td><?= $premiado->lucky_number ?></td>
                            <td><?= $premiado->tax_coupon ?></td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <b>Listagem de Documentos a serem enviados, que são:</b>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <?php if (!empty($arquivos['cpf-input-file'])) : ?>
                                <div class="alert alert-success">
                                    <?php $listaDocs += 1; ?>
                                    Arquivo já enviado
                                </div>
                                <label>CPF</label><br>
                                <?php if (pathinfo($arquivos['cpf-input-file'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                    PDF: <?= $arquivos['cpf-input-file']; ?>
                                <?php else : ?>
                                    <img src="<?= $arquivos['cpf-input-file']; ?>" style="max-width: 200px"/>
                                <?php endif; ?>
                            <?php else : ?>
                                <label>CPF</label>
                                <input id="cpf-input-file" name="cpf-input-file" type="file">
                                <div id="cpf-input-file-errors"></div>
                            <?php endif ?>
                        </div>
                        <div class="col-md-3">
                            <?php if (!empty($arquivos['documentoid-input-file'])) : ?>
                                <div class="alert alert-success">
                                    <?php $listaDocs += 1; ?>

                                    Arquivo já enviado
                                </div>
                                <label>Documento com foto (RG)</label><br>
                                <?php if (pathinfo($arquivos['documentoid-input-file'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                    PDF: <?= basename($arquivos['documentoid-input-file']); ?>
                                <?php else : ?>
                                    <img src="<?= $arquivos['documentoid-input-file']; ?>" style="max-width: 200px"/>
                                <?php endif; ?>

                            <?php else : ?>
                                <label>Documento com foto (RG)</label>
                                <input id="documentoid-input-file" name="documentoid-input-file" type="file">
                                <div id="documentoid-input-file-errors"></div>
                            <?php endif ?>
                        </div>
                        <div class="col-md-3">
                            <?php if (!empty($arquivos['endereco-input-file'])) : ?>
                                <div class="alert alert-success">
                                    <?php $listaDocs += 1; ?>
                                    Arquivo já enviado
                                </div>
                                <label>Comprovante de endereço</label><br>
                                <?php if (pathinfo($arquivos['endereco-input-file'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                    PDF: <?= basename($arquivos['endereco-input-file']); ?>
                                <?php else : ?>
                                    <img src="<?= $arquivos['endereco-input-file']; ?>" style="max-width: 200px"/>
                                <?php endif; ?>
                            <?php else : ?>
                                <label>Comprovante de endereço</label>
                                <input id="endereco-input-file" name="endereco-input-file" type="file">
                                <div id="endereco-input-file-errors"></div>
                            <?php endif ?>
                        </div>
                        <div class="col-md-3">
                            <?php if (!empty($arquivos['nf-input-file'])) : ?>
                                <div class="alert alert-success">
                                    <?php $listaDocs += 1; ?>
                                    Arquivo já enviado
                                </div>
                                <label>Cupom Fiscal</label><br>
                                <?php if (pathinfo($arquivos['nf-input-file'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                    PDF: <?= basename($arquivos['nf-input-file']); ?>

                                <?php else : ?>
                                    <img src="<?= $arquivos['nf-input-file']; ?>" style="max-width: 200px"/>
                                <?php endif; ?>
                            <?php else : ?>
                                <label>Cupom Fiscal</label>
                                <input id="nf-input-file" name="nf-input-file" type="file">
                                <div id="nf-input-file-errors"></div>
                            <?php endif ?>
                        </div>
                    </div>
                <?php else : ?>
                    <table>
                        <tr>
                            <td colspan="4"><i>Desculpe, mas você não foi encontrado em nenhuma apuração realizada.</i>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if ($listaDocs == 0) ?>
    <div class="row progress-loader">
        <div class="col-12 text-center">
            <small>
                Documentos enviados: <?php echo $listaDocs ?> / 4
            </small>
            <div class="progress" style="width:
            <?php $result = $listaDocs * 25;
            echo $result
            ?>%"></div>
        </div>
    </div>
</section>
<script>
    window.addEventListener('load', function () {
        $("#cpf-input-file").fileinput({
            uploadUrl: "<?= $this->Url->build(['controller' => 'users', 'action' => 'sorteadoEnviaDocumentosProc?awid=' . $awardedsId]) ?>",
            uploadExtraData: {
                '_csrfToken': $('[name=_csrfToken]').val()
            },
            previewFileType: ["pdf", "jpg", "png"],
            allowedFileExtensions: ["pdf", "jpg", "png"],
            maxFileSize: <?= env('UPLOAD_LIMIT_KB', 4000); ?>,
            initialPreviewAsData: true,
            initialPreviewShowDelete: true,
            overwriteInitial: false,
            theme: "fa",
            dropZoneTitle: 'Arraste e solte o PDF ou imagem do seu CPF aqui &hellip;',
            language: 'pt-BR',
            initialPreviewConfig: [
                <?php if (!empty($arquivos['cpf-input-file'])) : ?> {
                    type: "<?= pathinfo($arquivos['cpf-input-file'], PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image'; ?>",
                    showDelete: false
                },
                <?php endif ?>
            ],
        }).on('fileuploaded', function (event, data, previewId, index) {
            location.reload();
        }).on('fileuploaderror', function (event, data, msg) {
            $(".kv-fileinput-error").hide();
            // Captura o erro e exibe em um div específico
            $("#cpf-input-file-errors").html('<p>' + msg + '</p>').addClass('alert').addClass('alert-danger');
            setTimeout(function () {
                $("#cpf-input-file-errors").html('').removeClass('alert').removeClass('alert-danger');
            },5000);
        });

        $("#documentoid-input-file").fileinput({
            uploadUrl: "<?= $this->Url->build(['controller' => 'users', 'action' => 'sorteadoEnviaDocumentosProc?awid=' . $awardedsId]) ?>",
            uploadExtraData: {
                '_csrfToken': $('[name=_csrfToken]').val()
            },
            previewFileType: ["pdf", "jpg", "png"],
            allowedFileExtensions: ["pdf", "jpg", "png"],
            maxFileSize: <?= env('UPLOAD_LIMIT_KB', 4000); ?>,
            initialPreviewAsData: true,
            initialPreviewShowDelete: true,
            overwriteInitial: false,
            theme: "fa",
            dropZoneTitle: 'Arraste e solte o PDF ou imagem do seu documento de identificação (RG) aqui &hellip;',
            language: 'pt-BR',
            initialPreviewConfig: [
                <?php if (!empty($arquivos['documentoid-input-file'])) : ?> {
                    type: "<?= pathinfo($arquivos['documentoid-input-file'], PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image'; ?>",
                    showDelete: false
                },
                <?php endif ?>
            ],
        }).on('fileuploaded', function (event, data, previewId, index) {
            location.reload();
        }).on('fileuploaderror', function (event, data, msg) {
            $(".kv-fileinput-error").hide();
            // Captura o erro e exibe em um div específico
            $("#documentoid-input-file-errors").html('<p>' + msg + '</p>').addClass('alert').addClass('alert-danger');
            setTimeout(function () {
                $("#documentoid-input-file-errors").html('').removeClass('alert').removeClass('alert-danger');
            },5000);
        });

        $("#endereco-input-file").fileinput({
            uploadUrl: "<?= $this->Url->build(['controller' => 'users', 'action' => 'sorteadoEnviaDocumentosProc?awid=' . $awardedsId]) ?>",
            uploadExtraData: {
                '_csrfToken': $('[name=_csrfToken]').val()
            },
            previewFileType: ["pdf", "jpg", "png"],
            allowedFileExtensions: ["pdf", "jpg", "png"],
            maxFileSize: <?= env('UPLOAD_LIMIT_KB', 4000); ?>,
            initialPreviewAsData: true,
            initialPreviewShowDelete: false,
            overwriteInitial: false,
            theme: "fa",
            dropZoneTitle: 'Arraste e solte o PDF ou imagem do seu Comprovante de Endereço aqui &hellip;',
            language: 'pt-BR',
            initialPreviewConfig: [
                <?php if (!empty($arquivos['endereco-input-file'])) : ?> {
                    type: "<?= pathinfo($arquivos['endereco-input-file'], PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image'; ?>",
                    showDelete: false
                },
                <?php endif ?>
            ],
        }).on('fileuploaded', function (event, data, previewId, index) {
            location.reload();
        }).on('fileuploaderror', function (event, data, msg) {
            $(".kv-fileinput-error").hide();
            // Captura o erro e exibe em um div específico
            $("#endereco-input-file-errors").html('<p>' + msg + '</p>').addClass('alert').addClass('alert-danger');
            setTimeout(function () {
                $("#endereco-input-file-errors").html('').removeClass('alert').removeClass('alert-danger');
            },5000);
        });

        $("#nf-input-file").fileinput({
            uploadUrl: "<?= $this->Url->build(['controller' => 'users', 'action' => 'sorteadoEnviaDocumentosProc?awid=' . $awardedsId]) ?>",
            uploadExtraData: {
                '_csrfToken': $('[name=_csrfToken]').val()
            },
            previewFileType: ["pdf", "jpg", "png"],
            allowedFileExtensions: ["pdf", "jpg", "png"],
            maxFileSize: <?= env('UPLOAD_LIMIT_KB', 4000); ?>,
            initialPreviewAsData: true,
            initialPreviewShowDelete: false,
            overwriteInitial: false,
            theme: "fa",
            dropZoneTitle: 'Arraste e solte o PDF ou imagem da Nota Fiscal ou Cupom aqui &hellip;',
            language: 'pt-BR',
            initialPreviewConfig: [
                <?php if (!empty($arquivos['nf-input-file'])) : ?> {
                    type: "<?= pathinfo($arquivos['nf-input-file'], PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image'; ?>",
                    showDelete: false
                },
                <?php endif ?>
            ],
        }).on('fileuploaded', function (event, data, previewId, index) {
            location.reload();
        }).on('fileuploaderror', function (event, data, msg) {
            $(".kv-fileinput-error").hide();
            // Captura o erro e exibe em um div específico
            $("#nf-input-file-errors").html('<p>' + msg + '</p>').addClass('alert').addClass('alert-danger');
            setTimeout(function () {
                $("#nf-input-file-errors").html('').removeClass('alert').removeClass('alert-danger');
            },5000);
        });
    });
</script>