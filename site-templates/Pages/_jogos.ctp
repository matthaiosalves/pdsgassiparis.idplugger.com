<?php
if (!isset($jogos)) {
    die("não configurado");
}
?>
<!-- banner interno -->
<section class="banner-interno">
    <div class="container text-center">
        <h1>jogos</h1>
        <span>Enquanto você torce pelos prêmios, aqui toda a sua família pode participar da brincadeira.</span>
        <span><strong>Clique na atividade escolhida e bom divertimento!</strong></span>
        <div class="grid-brincadeiras">
            <?php if ($jogos->count() > 0): ?>
                <?php foreach ($jogos as $row): ?>
                    <a href="/jogos/<?=\Cake\Utility\Text::slug($row->name);?>"><img src="<?= $row->path_preview; ?>"></a>
                <?php endforeach; ?>
            <?php else: ?>
                <i>Nenhum jogo no momento</i>
            <?php endif; ?>
        </div>
    </div>
</section>
