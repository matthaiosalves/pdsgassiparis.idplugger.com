<!-- quiz -->
<section class="quiz">
    <div class="container">
        <?= $this->Flash->render(); ?>
        <?php if (isset($fatalError)) : ?>
            <div class="box-quiz">
                <?= $this->Html->link('Voltar para home do site', ['controller' => 'Pages', 'action' => 'home'], ['class' => 'btn btn-primary']); ?>
            </div>
        <?php else : ?>
            <?php if (isset($quiz->quiz_questions) && count($quiz->quiz_questions) > 0) : ?>
                <!-- ITEM QUIZ -->
                <?php foreach ($quiz->quiz_questions as $question) : ?>
                    <div class="box-quiz">
                        <span>Pergunta: <?php echo $question->question_text; ?></span>
                        <span>Sua resposta:</span>
                        <?php if ($question->answer_type !== 'string') : ?>
                            <?php if (isset($question->quiz_questions_answers) && count($question->quiz_questions_answers) > 0) : ?>
                                <?php if (isset($question->quiz_questions_answers) && count($question->quiz_questions_answers) > 0) { ?>
                                    <div class="">
                                        <?php foreach ($question->quiz_questions_answers as $answer) : ?>
                                            <?php foreach ($quiz->quiz_user_answers as $userAnswer) : ?>
                                                <?php if ($userAnswer->quiz_id == $quiz->id && $userAnswer->quiz_question_id == $question->id && $userAnswer->quiz_answer_id == $answer->id) : ?>
                                                    <div class="row justify-content-center text-center">
                                                        <div class="col-md-6">
                                                            <?php if (!empty($answer->answer_image)) : ?>
                                                                <img src="<?= $answer->answer_image ?>" class="img-fluid" alt="<?= html_entity_decode($answer->answer_text); ?>">
                                                            <?php endif; ?>
                                                            <h4><?= $answer->answer_text; ?></h4>
                                                        </div>
                                                    </div>
                                                    <br>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php } ?>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="">
                                <?php foreach ($quiz->quiz_user_answers as $userAnswer) : ?>
                                    <?php if ($userAnswer->quiz_id == $quiz->id && $userAnswer->quiz_question_id == $question->id) : ?>
                                        <div class="row justify-content-center text-center">
                                            <div class="col-md-6">
                                                <h4><?= $userAnswer->answer_text; ?></h4>
                                            </div>
                                        </div>
                                        <br>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <!-- BTN ENVIAR -->
                <div id="loading" class="text-center">
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="skew">
                    <div class="no-skew text-center">
                        <a href="<?= \Cake\Routing\Router::url($redirect ?? ['_name' => 'painel']); ?>" class="button btn btn btn-secondary" id="btnContinuar" style="display: none;">Continuar</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
<style>
    .quiz {
        min-height: 900px;
    }

    #form-participate .wrap-answers .input-radio label {
        width: 100%;
        cursor: pointer;
    }

    #form-participate input[type="radio"] {
        margin-right: 10px;
        display: none;
    }

    .box-quiz-answers {
        max-width: 358px;
        width: 100%;
        margin: 0 auto;
        padding-top: 25px;
        padding-bottom: 25px;
    }

    #quiz .item {
        position: relative;
        margin-bottom: 30px;
        padding-left: 0;
        border: 1px solid #707070;
        border-radius: 6px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 65px;

        cursor: pointer;
    }

    .special-title {
        color: #fff;
    }

    .special-title:after {
        background-color: #fff;
    }

    .box-quiz span {
        margin-bottom: 0;
    }

    .item.selected .custom-control-label h3,
    .box-quiz h4,
    .box-quiz span {
        color: #fff;
    }

    .item.selected {
        background-color: var(--primary);
    }

    .titleQuestion {
        color: var(--secondary) !important;
        margin-bottom: 45px !important;
        text-align: start !important;
        font-size: 1.125rem !important;
    }

    .titleAnswer {
        font-size: 1rem;
        margin-bottom: 0;
        color: var(--secondary);
    }
</style>
<script>
    window.onload = function() {
        $("#btnContinuar").on('click', function() {
            $("#btnContinuar").hide();
            $("#loading").show();
        });
    }
    setTimeout(function() {
        $("#loading").fadeOut(function() {
            $("#btnContinuar").fadeIn();
        });
    }, 2000);
</script>
<script>
    const radios = document.querySelectorAll('.input-radio input[type="radio"]');
    const items = document.querySelectorAll('.input-radio .item');

    function resetSelections() {
        items.forEach(item => {
            item.classList.remove('selected');
        });
    }

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            resetSelections();
            if (this.checked) {
                this.closest('.item').classList.add('selected');
            }
        });
    });
</script>