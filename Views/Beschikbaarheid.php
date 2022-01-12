<?php

$this->checkLoggedIn();

if(isset($_POST['editSubmit'])) {
    $this->editBeschikbaarheid();
}

?>

<div class="banner">
    <h2>
        <a href="<?= BASE_URL ?>">Dashboard</a>
        <i class="fa fa-angle-right"></i>
        <span>Beschikbaarheid</span>
    </h2>
</div>

<div class="content-top">
    <div class="col-md-12">
        <h1>Beschikbaarheid</h1>
    </div>
</div>
<div class="content-mid">
    <div class="col-md-12">
        <table class="table">
            <?php
            if ($_SESSION['UID']['admin'] == 1) { ?>
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Maandag</th>
                        <th scope="col">Dinsdag</th>
                        <th scope="col">Woensdag</th>
                        <th scope="col">Donderdag</th>
                        <th scope="col">Vrijdag</th>
                        <th scope="col">Zaterdag</th>
                        <th scope="col">Zondag</th>
                        <th scope="col">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $this->generateAdminBeschikbaarheid();
                    ?>
                </tbody>
            <?php } else { ?>
                <thead>
                    <tr>
                        <th scope="col">Maandag</th>
                        <th scope="col">Dinsdag</th>
                        <th scope="col">Woensdag</th>
                        <th scope="col">Donderdag</th>
                        <th scope="col">Vrijdag</th>
                        <th scope="col">Zaterdag</th>
                        <th scope="col">Zondag</th>
                        <th scope="col">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $this->generateBeschikbaarheid();
                    ?>
                </tbody>
            <?php }
            ?>
        </table>
    </div>
</div>
<div class="content-bottom">

</div>