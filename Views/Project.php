<?php

$this->checkLoggedIn();

// post check

?>

<div class="banner">
    <h2>
        <a href="<?=BASE_URL?>">Dashboard</a>
        <i class="fa fa-angle-right"></i>
        <span>Project</span>
    </h2>
</div>

<div class="content-top">
    <div class="col-sm-8 col-md-8 col-lg-10">
        <h1>Project</h1>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newModal">Nieuwe Project</button>
    </div>
</div>
<div class="content-mid">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Project id</th>
                    <th scope="col">Naam</th>
                    <th scope="col">Begindatum</th>
                    <th scope="col">Einddatum</th>
                    <th scope="col">Tijd</th>
                    <th scope="col">Personen</th>
                    <th scope="col">Beschrijving</th>
                </tr>
            </thead>
            <tbody>
                <?php
$this->generateprojectsTable()

?>
            </tbody>
        </table>
    </div>
</div>
<div class="content-bottom">

</div>

<!-- new modal -->
<div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Nieuwe project toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newProjectNaam">Project Naam</label>
                        <input type="text" class="form-control" id="newProjectNaam" name="newProjectNaam" required>
                    </div>
                    <div class="form-group">
                        <label for="newBegindatum">Begindatum</label>
                        <input type="date" class="form-control" id="newBegindatum" name="newBegindatum" required>
                    </div>
                    <div class="form-group">
                        <label for="newEinddatum">Einddatum</label>
                        <input type="date" class="form-control" id="newEinddatum" name="newEinddatum" required>
                    </div>
                    <div class="form-group">
                        <label for="newTijd">Totaal uren</label>
                        <input type="text" class="form-control" id="newTijd" name="newTijd" required>
                    </div>
                    <div class="form-group">
                        <label for="newPersonen">Personen</label>
                        <input type="text" class="form-control" id="newPersonen" name="newPersonen" required>
                    </div>
                    <div class="form-group">
                        <label for="newBeschrijving">Beschrijving</label>
                        <input type="text" class="form-control" id="newBeschrijving" name="newBeschrijving" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" name="newProjectSubmit" class="btn btn-primary">toevoegen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_GET['projectDelete'])) {
    /*  echo '<script>alert("' . $_GET['yachtDelete'] . '")</script>'; */
    $this->deleteProject();
}

if (isset($_POST['newProjectSubmit'])) {
    /*  echo '<script>alert("' . $_GET['yachtDelete'] . '")</script>'; */
    $this->addProject();
}

?>