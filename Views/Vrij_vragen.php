<?php

$this->checkLoggedIn();

//post check
if(isset($_POST['newDagSubmit'])) {
    $this->newVrijeDag();
}

if (isset($_POST['removeSubmit'])) {
    $this->removeVrijeDag();
}

?>

<div class="banner">
    <h2>
        <a href="<?= BASE_URL ?>">Dashboard</a>
        <i class="fa fa-angle-right"></i>
        <span>Vrij vragen</span>
    </h2>
</div>

<div class="content-top">
    <div class="col-md-10">
        <h1>Vrij vragen</h1>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newDagModal">Dag vrij nemen</button>
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
                        <th scope="col">Dag</th>
                        <th scope="Beschrijving">Beschrijving</th>
                        <th scope="col">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $this->generateAdminVrij();
                    ?>
                </tbody>
            <?php } else { ?>
                <thead>
                    <tr>
                        <th scope="col">Dag</th>
                        <th scope="Beschrijving">Beschrijving</th>
                        <th scope="col">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $this->generateVrij();
                    ?>
                </tbody>
            <?php }
            ?>
        </table>
    </div>
</div>
<div class="content-bottom">

</div>

<div class="modal fade" id="newDagModal" tabindex="-1" aria-labelledby="newDagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Vrije dag nemen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="resetEmail">Dag</label>
                        <input type="date" class="form-control" id="newDagDate" name="newDagDate" required>
                    </div>
                    <div class="form-group">
                        <label for="resetEmail">Beschrijving</label>
                        <input type="text" class="form-control" id="newDagBes" name="newDagBes">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" name="newDagSubmit" class="btn btn-primary">Versturen</button>
                </div>
            </form>
        </div>
    </div>
</div>