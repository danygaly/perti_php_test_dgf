<header>
    <nav class="navbar navbar-expand-lg header-main navbar-dark">
        <a href="<?php print(base_url("/logout")); ?>" class="sub-menu" id="logout"><span class="navbar-toggler navbar-personal-icon"></span></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav mr-auto"></div>
                <span id="header-text-username">Usuario: <?php print($nombre); ?></span>
                <span id="header-text-mail">Correo: <?php print($mail); ?></span>
            <span id="logout-span"><a href="<?php print(base_url("/logout")); ?>" class="sub-menu" id="logout">Cerrar sesión</a></span>
        </div>
    </nav>
</header>