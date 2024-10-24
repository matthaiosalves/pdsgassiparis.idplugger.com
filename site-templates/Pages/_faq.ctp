<?php
if (!isset($faq)) {
    die("não configurado");
}
?>
<section class="internal-page banner-interno" id="faq">
    <div class="container">
        <h2 class="special-title mb-4">Perguntas Frequentes</h2>
        <div class="accordion mt-5" id="accordionFAQ">
            <?php foreach ($faq as $key => $question) : ?>
                <article class="card">
                    <div class="card-header" id="head-question-<?= $key ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed text-secondary" type="button" data-toggle="collapse"
                                    data-target="#card-question-<?= $key ?>" aria-expanded="true"
                                    aria-controls="card-question-<?= $key ?>">
                                <?= ($key + 1) . " - " . $question->question ?>
                            </button>
                        </h2>
                    </div>
                    <div id="card-question-<?= $key ?>" class="collapse" aria-labelledby="head-question-<?= $key ?>"
                         data-parent="#accordionFAQ">
                        <div class="card-body">
                            <?= $question->answer ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>