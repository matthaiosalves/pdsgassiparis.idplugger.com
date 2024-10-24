<div class="scene-form tickets">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card mt-4 mb-4" style="width: 100%">
            <h3 class="mx-4 text-center">Criar novo <?php echo $configuration->tickets->name ?? ''; ?></h3>
            <div class="card-footer">
                <?php echo $this->Form->create(null, [
                    'valueSources' => 'query',
                    'id' => 'form-tickets',
                    'type' => 'post',
                    'url' => $this->Url->build(array('controller' => 'Users', 'action' => 'ticketNew'))
                ]); ?>
                <div class="row">
                    <div class="col-12">
                        <div id="msg-erro">
                            <?= $this->Flash->render(); ?>
                        </div>
                        <?php if (!empty($erroMsg)): ?>
                            <div class="alert alert-danger">
                                <?= $erroMsg; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php echo $this->Form->control('title', [
                            'label' => 'Assunto:',
                            'class' => 'form-control'
                        ]); ?>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <?php echo $this->Form->control('content', [
                            'type' => 'textarea',
                            'label' => 'Mensagem:',
                            'class' => 'form-control'
                        ]); ?>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="input text">
                            <input type="submit" value="Enviar" class="btn btn-primary"/>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
