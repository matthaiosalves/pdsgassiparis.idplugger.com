<?php
if (!isset($jogo)) {
    die("não configurado");
}
?>
<!-- banner interno -->
<section class="banner-interno">
    <div class="container text-center">
        <h1>jogos</h1>
        <div class="acoes">
            <div class="skew">
                <div class="no-skew">
                    <a href="/jogos" class="btn-cta"><i class="fas fa-chevron-left"></i> Ver mais</a>
                </div>
            </div>
            <div class="skew">
                <div class="no-skew">
                    <a href="javascript:window.print()" class="btn-cta vasado">Imprimir <i class="fas fa-print"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center">
            <img src="<?=$jogo->path_preview;?>">
            <div class="share">
                <a href="#" target="_blank" id="fb-share-btt"><i class="fab fa-facebook"></i></a>
                <a href="#" id="whatsapp-share-btt" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <span>compartilhe</span>
            </div>
        </div>
    </div>
</section>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v7.0"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let urllocal = window.location.href;
        //conteúdo que será compartilhado: Título da página + URL
        var conteudo = encodeURIComponent(document.title + " " + urllocal);

        //altera a URL do botão
        document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;
        document.getElementById("fb-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + urllocal + "&src=sdkpreparse";
    }, false);
</script>