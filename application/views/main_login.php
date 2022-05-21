<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html id="html-login" lang="en" style="background: linear-gradient(to top right, #004a92,#00b5e3);height: 100%;">
    <head>
        <meta charset="UTF-8">
        <title>Plan Lector Norma | <?php print($titulo); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/bulma.min.css">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/animate.min.css">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/style.css">
        <script src="<?php print base_url()?>assets/js/vue.min.js"></script>
        <script src="<?php print base_url()?>assets/js/axios.min.js"></script>
        <script src="<?php print base_url()?>assets/js/jquery.min.js"></script>
        <script src="<?php print base_url("/assets/js/bootstrap.js"); ?>"></script>
        <script src="<?php print(base_url("/assets/js/config/constants.js")); ?>"></script>
    </head>
    <body id="body-login">
        <div class="dashboard-main-wrapper" id="panel-login">
            <?php print($header); ?>
            <?php print($login);?>
            <?php print($registro);?>
            <?php print($footer); ?>
        </div>
        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="login-mensaje"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
    <script src="<?php print(base_url("/assets/js/controllers/inicio.js")); ?>"></script>
    <script src="<?php print(base_url("/assets/js/controllers/desktop.js")); ?>"></script>
</html>