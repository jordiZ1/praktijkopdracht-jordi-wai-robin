<nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <h1> <a class="navbar-brand" href="<?= BASE_URL ?>">Mollenhof</a></h1>
    </div>
    <div class=" border-bottom">
        <!-- Brand and toggle get grouped for better mobile display -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="drop-men">
            <ul class=" nav_1">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle dropdown-at" data-toggle="dropdown">
                        <span class=" name-caret"><?= $_SESSION["UID"]["naam"] ?><i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu " role="menu">
                        <li><a href="?logout=true"><i class="fa fa-user"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->

        <div class="clearfix"></div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?= BASE_URL ?>" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>kalender" class=" hvr-bounce-to-right"><i class="fa fa-calendar nav_icon "></i><span class="nav-label">Agenda</span></a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>beschikbaarheid" class=" hvr-bounce-to-right"><i class="fa fa-clipboard nav_icon "></i><span class="nav-label">Beschikbaarheid</span></a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>vrij_vragen" class=" hvr-bounce-to-right"><i class="fa fa-sun-o nav_icon "></i><span class="nav-label">Vrij vragen</span></a>
                    </li>
                    <?php if ($_SESSION["UID"]["admin"] == 1) { ?>
                        <li>
                            <a href="<?= BASE_URL ?>gebruikers" class=" hvr-bounce-to-right">
                                <i class="fa fa-user nav_icon"></i>
                                <span class="nav-label">Gebruikers</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?= BASE_URL ?>project" class=" hvr-bounce-to-right">
                            <i class="fa fa-tasks nav_icon"></i>
                            <span class="nav-label">Projecten</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<?php
if (isset($_GET['logout'])) {

    unset($_SESSION['UID']);
    echo "<script>
    location.href = '" . BASE_URL . "login'
    </script>";
}
?>

<!-- page wrappers -->
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">