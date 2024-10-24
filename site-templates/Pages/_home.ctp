<?php

use App\Orchestrator;

$orchestrator = new Orchestrator();
$promotion = $orchestrator->get("promotion/{$config->promotion_id}");
?>
<style>
    body {
        overflow-x: hidden;
    }

    p,
    .subtitle {
        color: #787878;
    }

    .banner {
        background-image: url('/front/public/<?= $config->template_version; ?>/images/banner-principal.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        min-height: 840px;
    }

    .comoParticipar {
        padding-top: 60px;
        padding-bottom: 60px;
        background-color: #e8e8e8;
    }

    .special-title {
        color: #40484c;
    }

    .linha {
        position: relative;
    }

    .premio {
        padding-top: 70px;
        padding-bottom: 60px;
        background-color: #ffffff;

        position: relative;
    }

    .premio .boxImagePremio {
        display: flex;
        align-items: center;
        justify-content: end;
    }

    .premio .rowPremios {
        align-items: center;
    }

    .premio .imagemDisney {
        width: 235px;
        margin-top: 10px;
    }

    .premio .rowPremios h4 {
        color: #40484c;
        font-size: 27px;
        font-weight: bold;
        font-family: "Poppins-Black";
    }

    .premio .torre {
        position: absolute;
        top: 75px;
        right: -49px;
        width: 730px;
        z-index: 2;
    }

    .rowSteps {
        flex-wrap: nowrap;
        justify-content: center;
    }

    .d-mobile {
        display: none;
    }

    .d-desk {
        display: block;
    }

    .rowButton {
        margin-left: -38px;
        margin-top: 70px;
        margin-bottom: 50px;
    }

    @media(max-width: 2000px) {
        .premio .torre {
            position: absolute;
            top: 550px;
            right: -49px;
            width: 300px;
            z-index: 2;
        }
    }

    @media(max-width: 1220px) {
        .rowPremios {
            flex-wrap: wrap;
        }

        .premio .boxImagePremio,
        .rowParticiparPremios {
            justify-content: center;
        }

        .rowPremios .description {
            text-align: center;
        }
    }

    @media(max-width: 1070px) {
        .comoParticipar .boxStep {
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rowButton {
            margin-left: 0;
            width: 100%;
        }

        .rowSteps {
            flex-wrap: wrap;
        }

        .d-mobile {
            display: block;
        }

        .d-desk {
            display: none;
        }
    }

    @media(max-width: 768px) {
        .banner {
            min-height: 480px;
        }
    }
</style>

<section class="banner">
    <div class="container">
        <div class="row">

        </div>
    </div>
</section>
<section class="comoParticipar" id="comoParticipar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="title-section text-center special-title">COMO PARTICIPAR</h2>
                <p class="subtitle text-center">Confira abaixo em 3 passos como você pode ganhar uma viagem com acompanhante para Paris.</p>
            </div>
        </div>
        <div class="row rowSteps">
            <div class="boxStep">
                <img src="/front/public/<?= $config->template_version; ?>/images/compre.png" alt="" class="d-desk">
                <img src="/front/public/<?= $config->template_version; ?>/images/compre-mobile.png" alt="" class="d-mobile">
            </div>
            <div class="boxStep">
                <img src="/front/public/<?= $config->template_version; ?>/images/cadastre-se.png" alt="" class="d-desk">
                <img src="/front/public/<?= $config->template_version; ?>/images/cadastre-se-mobile.png" alt="" class="d-mobile">
            </div>
            <div class="boxStep">
                <img src="/front/public/<?= $config->template_version; ?>/images/boa-sorte.png" alt="" class="d-desk">
                <img src="/front/public/<?= $config->template_version; ?>/images/boa-sorte-mobile.png" alt="" class="d-mobile">
            </div>
        </div>

        <div class="row justify-content-center align-items-center rowButton col">
            <a href="/private/users/login" class="btn btn-primary">QUERO PARTICIPAR!</a>
        </div>
    </div>
</section>
<img src="/front/public/<?= $config->template_version; ?>/images/linha-azul.png" alt="" class="linha">
<section class="premio" id="premio">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="title-section text-center special-title">PRÊMIO</h2>
                <p class="subtitle text-center">Veja abaixo o que o sorteio contempla.</p>
            </div>
        </div>

        <div class="row rowPremios">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 boxImagePremio">
                <img src="/front/public/<?= $config->template_version; ?>/images/imagem-premio.png" alt="">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                <h4>Concorra a uma viagem para Paris,
                    com acompanhante e tudo pago!</h4>
                <img class="imagemDisney mb-2" src="/front/public/<?= $config->template_version; ?>/images/disneysvg.svg" alt="">
                <p class="mb-3 description">Além da viagem e hospedagem na Cidade Luz, o ganhador receberá também 1 par de ingressos para conhecer a magia da
                    Disneland Paris.</p>
                <div class="row rowParticiparPremios col">
                    <a href="/private/users/login" class="btn btn-primary mt-4">QUERO PARTICIPAR!</a>
                </div>
            </div>
        </div>
    </div>

    <img src="/front/public/<?= $config->template_version; ?>/images/torre.png" alt="" class="torre">
</section>
<img src="/front/public/<?= $config->template_version; ?>/images/linha-vermelha.png" alt="" class="linha">