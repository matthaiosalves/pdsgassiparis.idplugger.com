<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$config = $config ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->fetch('page_title'); ?></title>

    <!-- Meta -->
    <!-- ADVICE: Remove the meta keywords tag from any matching pages. -->
    <meta name="description" content="<?= $this->fetch('page_meta_description'); ?>">
    <meta property="og:type" content="<?= $this->fetch('page_og_type'); ?>">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
    <meta property="og:title" content="<?= $this->fetch('page_og_title'); ?>">
    <meta property="og:description" content="<?= $this->fetch('page_og_description'); ?>">
    <meta property="og:url" content="<?= $this->fetch('page_og_url'); ?>">
    <meta property="og:image" content="<?= $this->fetch('page_og_image'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $this->fetch('page_og_url'); ?>">
    <meta name="twitter:title" content="<?= $this->fetch('page_og_title'); ?>">
    <meta name="twitter:description" content="<?= $this->fetch('page_og_description'); ?>">
    <meta name="twitter:image" content="<?= $this->fetch('page_og_image'); ?>">
    <!-- Meta -->
    <?= $this->Html->meta('icon', $config->branding->images->favicon ?? '/assets/favicon.ico', ['type' => 'icon']) ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
    <?php if (!file_exists("webroot/assets/css/style.min.css")): ?>
        <link rel="stylesheet"
            href="<?= $this->Url->build(
                        "/assets/css/style-default.min.css",
                        true
                    ); ?>?<?= filemtime(WWW_ROOT . 'assets/css/style-default.min.css') ?>" />
    <?php else: ?>
        <link rel="stylesheet"
            href="<?= $this->Url->build(
                        "/assets/css/style.min.css",
                        true
                    ); ?>?<?= filemtime(WWW_ROOT . 'assets/css/style.min.css') ?>" />
    <?php endif; ?>

    <?php if (!empty($config->tagmanager_text)) { ?>
        <!-- Google Tag Manager -->
        <script>
            const $gtmCode = '<?php echo $config->tagmanager_text; ?>';
        </script>
        <!-- Google tag (gtag.js) -->
        <script async
            src="https://www.googletagmanager.com/gtag/js?id=<?php echo $config->tagmanager_text; ?>"></script>
        <script src="<?= $this->Url->build("/assets/js/gtm.js", true); ?>"></script>
        <!-- End Google Tag Manager -->
    <?php } ?>

    <?php
    $footerH = $config->tickets_settings->active ? '1' : '0';
    echo "<script>localStorage.setItem('footerH', '$footerH')</script>";
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?php
    $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_path = parse_url($current_url, PHP_URL_PATH);
    switch ($url_path) {
        case '/private/users/login':
            echo $this->Html->css('login.css');
            break;
        case '/private/forgot-password':
            echo $this->Html->css('forget.css');
            break;
    }
    ?>
    <?= $this->Html->css('global.css') ?>
</head>

<body class="<?php echo $this->get('bodyClass'); ?>">
    <?php if (!empty($config->tagmanager_text)) { ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $config->tagmanager_text; ?>"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php } ?>

    <?php if ($this->request->getSession()->check('loggedAsAdmin') && $this->request->getSession()->read('loggedAsAdmin') > 0) { ?>
        <!--  IF sessão possui info que o cliente está autenticado por atendente-->
        <div class="logged-as-user"
            style="position: fixed;bottom: 0;left: 0;right: 0;padding: 10px;background: yellow;color: #000;margin: 0;z-index: 9999;text-align: center;border-top: 1px solid #d6c602;font-size: 14px;">
            <p>
                Você está utilizando a conta de: <?php echo $this->request->getSession()->read('loggedAsAdminUserName') ?>
                <span class="pr-5"></span>
                <a href="/admin/users/clients">Voltar para a conta de administrador</a>
            </p>
        </div>
    <?php } ?>

    <?php if (isset($allow_show_front_contents) && $allow_show_front_contents === true) { ?>
        <?= $this->fetch('content') ?>
    <?php } else { ?>
        <div style="text-align: center; width: 100%">
            <p>Disponível em breve!</p>
        </div>
    <?php } ?>

    <?php if (isset($config->recaptcha_v3_key) && !empty($config->recaptcha_v3_key)): ?>
        <script>
            var recaptchaV3Key = '<?= $config->recaptcha_v3_key; ?>';
        </script>
        <script src="https://www.google.com/recaptcha/api.js?render=<?= $config->recaptcha_v3_key; ?>"></script>
    <?php else: ?>
        <script>
            var recaptchaV3Key = 'development';
        </script>
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/812c6087bc.js" crossorigin="anonymous"></script>
    <script src="/front/private/v1/js/moment.min.js"></script>
    <?php
    $customHelper = '@/front/public/' . $config->template_version . '/js/helpers.js';
    if (file_exists($customHelper)) {
        $customHelper .= '?v=' . date('Ymd');
        echo $this->Html->script($customHelper);
    } else {
        echo $this->Html->script('@/front/private/v1/js/helpers.js');
    }

    global $scripts_to_footer;
    if (isset($scripts_to_footer) && is_array($scripts_to_footer)) {
        foreach ($scripts_to_footer as $key => $script) {
            echo $script;
        }
    }
    ?>
    <?= $this->fetch('scriptBottom') ?>

    <?php //todo: remover facebook_settings
    ?>
    <?php if (isset($config->facebook_settings) && property_exists(
        $config->facebook_settings,
        'active'
    ) && $config->facebook_settings->active) { ?>
        <!--
    <div id="fb-root"></div>
    <script>
    /*
        window.fbAsyncInit = function () {
            FB.init({
                appId: '<?= $config->facebook_settings->app_id; ?>',
                xfbml: true,
                version: '<?= $config->facebook_settings->default_graph_version; ?>'
            });
            FB.AppEvents.logPageView();
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/pt_BR/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        */
    </script>
    -->
    <?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha256-NXRS8qVcmZ3dOv3LziwznUHPegFhPZ1F/4inU7uC8h0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <?php
    $trocarSenha = (strpos(
        $this->request->getAttribute("here"),
        'users/edit'
    ) === false && $this->request->getSession()->read('Auth.User.status') == 2);
    if ($trocarSenha): ?>
        <div class="modal fade" id="modalTrocaSenha" tabindex="-1" role="dialog" aria-labelledby="Modal Troca Senha"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header alert-danger">
                        <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            É necessário que sua senha seja atualizada!
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'edit')); ?>"
                            class="btn btn-primary">Trocar a senha</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#modalTrocaSenha").modal();
        </script>
    <?php endif; ?>

    <?php
    //MODAL PARA APÓS O ENCERRAMENTO:
    $now = new \Datetime();
    if (
        !empty($config->end_promotion_date) &&
        $now > $config->end_promotion_date
    ):
    ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-promocao-encerrada">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #fff; color: #000">
                        <span class="modal-title h5 text-bold"><?= $config->promotion_name; ?></span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="padding: 2px 0px 2px 2px;">
                        <div class="scroll"
                            style="max-height: 80vh; overflow-x: hidden;   display: block; padding: 15px; overflow-y: auto;background: #fff; color: #000;font-size: 18px">
                            Promoção encerrada em: <?= $config->end_promotion_date->format('d/m/Y'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
    <script type="application/javascript"
        src="<?= PUBLIC_TEMPLATE_PATH . $config->template_version; ?>/js/Layout/default.js"></script>

    <?php
    if (!empty(env('FRONT_LIVE_CHAT_ID'))): ?>
        <!-- SC-16959: LIVE CHAT -->
        <script src="https://cdn.pulse.is/livechat/loader.js" data-live-chat-id="<?= env('FRONT_LIVE_CHAT_ID'); ?>"
            async></script>
    <?php endif; ?>
</body>

</html>