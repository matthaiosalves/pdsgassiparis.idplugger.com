<!-- quiz -->
<section id="quiz" class="quiz quiz-id-<?php echo isset($quiz) ? $quiz->id : ''; ?>">
    <div class="container">
        <div class="row justify-content-center">
            <?= $this->Flash->render(); ?>
            <?php if (isset($fatalError)) : ?>
                <div class="col-md-12">
                    <div class="box-quiz">
                        <?= $this->Html->link('Voltar para home do site', ['controller' => 'Pages', 'action' => 'home'], ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            <?php else : ?>
                <?= $this->Form->create(null, ['id' => 'form-participate', 'autocomplete' => 'off', 'onSubmit' => 'enviando()']); ?>
                <?php if (isset($quiz->quiz_questions) && count($quiz->quiz_questions) > 0) : ?>
                    <?php
                    if ($quiz->shuffle_questions) {
                        shuffle($quiz->quiz_questions);
                    }
                    ?>
                    <!-- form aqui-->
                    <!-- ITEM QUIZ -->
                    <?php foreach ($quiz->quiz_questions as $question) : ?>
                        <div class="row box-quiz">
                            <div class="col-md-12 box-quiz-question">
                                <h2 class="text-center special-title mb-4"><?php echo $question->question_text; ?></h2>
                            </div>
                            <div class="col-md-12 box-quiz-answers card">
                                <h4 class="text-center titleQuestion"><?= $question->question_description; ?></h4>
                                <div class="row justify-content-center">
                                    <?php if (isset($question->quiz_questions_answers) && count($question->quiz_questions_answers) > 0) : ?>
                                        <?php if (isset($question->quiz_questions_answers) && count($question->quiz_questions_answers) > 0) { ?>
                                            <?php
                                            if ($quiz->shuffle_answers) {
                                                shuffle($question->quiz_questions_answers);
                                            }
                                            ?>
                                            <?php
                                            $quiz_classWrap = 'input-text';
                                            $quiz_nameInput = 'quizzes.' . $quiz->id . '.' . $question->id;
                                            $quiz_type = 'text';
                                            $quiz_classInput = 'form-control';
                                            $quiz_wrapInputClass = 'form-group';
                                            $quiz_value = '';
                                            $quiz_label = '';
                                            $quiz_control_method = 'control';
                                            $quiz_multiOption = false;

                                            switch ($question->answer_type) {
                                                case 'string':
                                                    break;
                                                case 'options':
                                                    $quiz_classWrap = 'input-radio';
                                                    $quiz_type = 'radio';
                                                    $quiz_classInput = 'checkbox custom-control-input';
                                                    $quiz_control_method = 'radio';
                                                    $quiz_wrapInputClass = '';
                                                    break;
                                                case 'multi_options':
                                                case 'multi_options_limit':
                                                    $quiz_multiOption = true;
                                                    $quiz_classWrap = 'input-check';
                                                    $quiz_type = 'checkbox';
                                                    $quiz_classInput = 'form-check-input checkbox custom-control-input';
                                                    $quiz_wrapInputClass = 'form-check';
                                                    break;
                                            }
                                            ?>
                                            <?php foreach ($question->quiz_questions_answers as $answer) : ?>
                                                <?php if ($question->answer_type == 'string') : ?>
                                                    <div class="col-md-12 <?= $quiz_classWrap ?>">
                                                        <input type="<?= $quiz_type ?>" name="quizzes[<?= $quiz->id; ?>][<?= $question->id; ?>]<?php if ($quiz_multiOption) {
                                                                                                                                                    echo "[]";
                                                                                                                                                } ?>" id="<?= $quiz_nameInput . '.' . $answer->id; ?>" class="<?= $quiz_classInput ?>" />
                                                    </div>
                                                <?php else : ?>
                                                    <div class="col-md-12 <?= $quiz_classWrap ?>">
                                                        <label class="<?= $quiz_wrapInputClass ?> item">
                                                            <input type="<?= $quiz_type ?>" name="quizzes[<?= $quiz->id; ?>][<?= $question->id; ?>]<?php if ($quiz_multiOption) {
                                                                                                                                                        echo "[]";
                                                                                                                                                    } ?>" value="<?= $answer->id; ?>" id="<?= $quiz_nameInput . '.' . $answer->id; ?>" class="<?= $quiz_classInput ?> checkbox custom-control-input" />
                                                            <span class="checkmark custom-control-label" for="<?= $quiz_nameInput . '.' . $answer->id; ?>">
                                                                <?php if (isset($answer->answer_image) && !empty($answer->answer_image)) : ?>
                                                                    <div class="foto answer_image">
                                                                        <img src="<?= $answer->answer_image ?>" class="img-fluid" alt="<?= html_entity_decode($answer->answer_text); ?>" />
                                                                    </div>
                                                                <?php endif ?>
                                                                <h3 class="titleAnswer"><?= $answer->answer_text; ?></h3>
                                                            </span>
                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php } ?>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="loading" class="text-center">
                                            <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="skew">
                                            <div class="no-skew">
                                                <button class="btn btn-primary btn-cta button" type="submit" style="display: none;" id="btnEnviar">
                                                    Confirmar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div id="loading" class="text-center">
                                <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="skew">
                                <div class="no-skew">
                                    <button class="btn btn-secondary btn-cta button" type="submit" style="display: none;" id="btnEnviar">
                                        Confirmar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <?php endif; ?>
                <?= $this->Form->end() ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if (isset($customTexts['modalPosCadastro']) && $customTexts['modalPosCadastro']) : ?>
    <!-- Modal -->
    <div class="modal fade" id="modalPosCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $customTexts['modalPosCadastro']['titulo'] ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $customTexts['modalPosCadastro']['body']; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
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

    .item:hover {
        background: var(--primary);

        transition: all .2s;
    }

    .item:hover .titleAnswer {
        color: #fff;
    }

    .special-title {
        color: #fff !important;
    }

    .special-title:after {
        background-color: #fff;
    }

    .box-quiz span {
        margin-bottom: 0;
    }

    .item.selected .custom-control-label h3 {
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

    #loading .fa-refresh {
        color: var(--primary);
    }
</style>
<script>
    const enviando = function() {
        $("#btnEnviar").hide();
        $("#loading").show();
    }
    setTimeout(function() {
        $("#loading").fadeOut(function() {
            $("#btnEnviar").fadeIn();
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