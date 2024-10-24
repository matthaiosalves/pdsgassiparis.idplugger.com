<?php
if (!isset($videos)) {
    die('não configurado');
}
?>
<div class="container">
    <h3>vídeos</h3>
    <div class="row-videos">
        <?php if ($videos->count() > 0): ?>
            <?php foreach ($videos as $row):
                $json = json_decode($row->content_json);
                if (empty($json->url)) {
                    continue;
                }
                ?>
                <div class="item">
                    <iframe width="100%" height="225" src="<?= $json->url; ?>" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                    <div class="share">
                        <a href="#" class="whatsapp-share-btn" target="_blank"><i
                                    class="fab fa-facebook"></i></a>
                        <a href="#" class="fb-share-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <span>compartilhe</span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="item">
                <i style="color: white">Nenhum vídeo no momento</i>
            </div>
        <?php endif; ?>

    </div>
</div>