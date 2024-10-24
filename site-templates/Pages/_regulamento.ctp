<style>
    #regulamento,
    #regulamento p,
    #regulamento h1,
    #regulamento h2,
    #regulamento h3,
    #regulamento h4,
    #regulamento h5,
    #regulamento h6,
    #regulamento span,
    #regulamento a,
    #regulamento li,
    #regulamento ol,
    #regulamento ul,
    #regulamento em,
    #regulamento strong,
    #regulamento b,
    #regulamento i,
    #regulamento table,
    #regulamento th,
    #regulamento td {
        color: #000;
    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
        color: #495057 !important;
    }

    #regulamento .tab-content {
        background-color: #ffffff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    #regulamento .content {
        background-color: #dee2e6;
        padding: 10px 25px;
    }

    #regulamento h2 {
        background-color: var(--secondary);
        border-color: var(--secondary);
        padding: 10px 25px;
        text-align: center;
        color: #fff;
        margin-bottom: 0;
    }
</style>
<section class="internal-page banner-interno" id="regulamento">
    <div class="container">
        <h3 class="special-title mb-4">Regulamento</h3>
        <?php
        if (!empty($regulations)) :
            if (count($regulations) > 1) :
                $i = 0;
        ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php foreach ($regulations as $regulation) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($i == 0) : echo 'active';
                                                endif; ?>" id="tab<?php echo $i; ?>" data-toggle="tab" href="#content<?php echo $i; ?>" role="tab" aria-controls="content<?php echo $i; ?>" aria-selected="true"><?= $regulation->value->title ?></a>
                        </li>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </ul>
            <?php
            endif;
            ?>
            <div class="tab-content" id="myTabContent">
                <?php $i = 0;
                foreach ($regulations as $regulation) : ?>
                    <?php $regulation = $regulation->value; ?>

                    <div class="tab-pane fade <?php if ($i == 0) : echo 'show active';
                                                endif; ?>" id="content<?php echo $i; ?>" role="tabpanel" aria-labelledby="tab<?php echo $i; ?>">
                        <h2><?= $regulation->title ?></h2>
                        <div class="content">
                            <?= $regulation->content ?>
                        </div>
                    </div>

                <?php $i++;
                endforeach; ?>
            </div>
        <?php else : ?>
            <p>Nenhum regulamento registrado no momento.</p>
        <?php endif; ?>
    </div>
</section>