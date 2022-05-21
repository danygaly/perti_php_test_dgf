<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio | <?php print($titulo); ?></title>
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/bulma.min.css">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/animate.min.css">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php print base_url()?>assets/css/main-style.css">
        <script src="<?php print base_url()?>assets/js/vue.min.js"></script>
        <script src="<?php print base_url()?>assets/js/axios.min.js"></script>
        <script src="<?php print base_url()?>assets/js/jquery.min.js"></script>
        <script src="<?php print base_url("/assets/js/bootstrap.js"); ?>"></script>
        <script src="<?php print(base_url("/assets/js/config/constants.js")); ?>"></script>
        
        
    </head>
    <body>
        <div class="dashboard-main-wrapper">
            <?php print($header); ?>
            <?php print($contenido); ?>
            <?php print($footer); ?>
        </div>
    </body>
    <script src="<?php print(base_url("/assets/js/controllers/desktop.js")); ?>"></script>
</html>