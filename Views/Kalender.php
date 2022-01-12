<?php

$this->checkLoggedIn();
//$this->getProjectDagen();
//print_r($_SESSION['project']);

if (isset($_POST['newInplannenProjectSubmit'])) {
    $this->selectProject();
}

if (isset($_POST['editInplannenProjectSubmit'])) {
    $this->editProject();
}

if (isset($_POST['inplanProjectBtn'])) {
    $this->inplanProject();
}

if (isset($_POST['editProjectTime'])) {
    $this->editProjectTime();
}

if (isset($_POST['editProjectIdBtn'])) {
    $this->deletePlan();
}
?>
<div class="banner">
    <h2>
        <a href="<?= BASE_URL ?>">Dashboard</a>
        <i class="fa fa-angle-right"></i>
        <span>Kalender</span>
    </h2>
</div>

<div class="col-md-12" style="margin-top: 20px;">
    <button class="btn btn-primary" data-toggle="modal" data-target="#bewerkenSelectModal" style="float:right;">Bewerken</button>
    <button class="btn btn-primary" data-toggle="modal" data-target="#inplannenSelectModal" style="float:right;">Inplannen</button>
</div>



<form action="" method="get">
    <div class="content-top">
        <div class="col-md-12">
            <input type="month" name="date" value="<?php echo $year; ?>-<?php echo $month ?>-01">
            <input type="submit" value="Tonen" class="btn btn-primary">
        </div>
    </div>
    <div class="content-mid" style="margin-top: 40px;">
        <div class="col-md-12">
            <?php
            if (isset($_GET['month'])) {
                $month = $_GET['month'];
            } else {
                $month = date('m');
            }
            if (isset($_GET['year'])) {
                $year = $_GET['year'];
            } else {
                $year = date('y');
            }
            //<?php echo date("F", mktime(0, 0, 0, $month-1, 10));
            //        <input type="submit"  name="month" value="<?php echo $month-1; "></input>
            //------------
            //<input type="submit"  name="month" value="<?php echo $month+1; "></input>
            ?>

            <?php $this->generateAgenda(); ?>
            <?= $this->calendar ?>
        </div>
    </div>
    <div class="content-bottom">

    </div>
</form>

<div class="modal fade" id="inplannenSelectModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Nieuwe project inplannen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <?php

                    $getinplannenProject = $this->getInplannenProject();

                    ?>
                    <div class="form-group">
                        <label for="newProjectNaam">Select het project:</label>
                        <select name="inplannenProject">
                            <?php

                            foreach ($getinplannenProject as $key) {
                                echo '<option value="' . $key['project_id'] . '">' . $key['naam'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" name="newInplannenProjectSubmit" class="btn btn-primary">Selecteren</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="inplannenProjectModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Nieuwe project inplannen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <h4>Project Informaite</h4>
                    <?php

                    $getProject = $this->getOneProject();
                    foreach ($getProject as $key) {

                    ?>

                        <div class="form-group">
                            <label for="newProjectNaam">Project Naam</label>
                            <input type="text" class="form-control" id="newProjectNaam" name="newProjectNaam" value="<?= $key['naam']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="newBegindatum">Begindatum</label>
                            <input type="date" class="form-control" id="newBegindatum" name="newBegindatum" value="<?= $key['begindatum']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="newEinddatum">Einddatum</label>
                            <input type="date" class="form-control" id="newEinddatum" name="newEinddatum" value="<?= $key['einddatum']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="newTijd">Totaal uren</label>
                            <input type="text" class="form-control" id="newTijd" name="newTijd" value="<?= $key['tijd']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="newPersonen">Personen</label>
                            <input type="text" class="form-control" id="newPersonen" name="newPersonen" value="<?= $key['personen']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="newBeschrijving">Beschrijving</label>
                            <input type="text" class="form-control" id="newBeschrijving" name="newBeschrijving" value="<?= $key['beschrijving']; ?>" readonly>
                        </div>

                        <h4>plannen informaite</h4>

                        <div class="form-group">
                            <label for="newBeschrijving">inplan datum</label>
                            <input type="date" class="form-control" id="" name="newInplanDatum">
                        </div>

                        <div class="form-group">
                            <label for="newBeschrijving">Beginuren</label>
                            <input type="time" class="form-control" id="" name="newBeginuren">
                        </div>

                        <div class="form-group">
                            <label for="newBeschrijving">Einduren</label>
                            <input type="time" class="form-control" id="" name="newEinduren">
                        </div>
                    <?php

                    }
                    ?>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" name="inplanProjectBtn" class="btn btn-primary">plannen</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="bewerkenSelectModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Bewerken project </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="newProjectNaam">Select het Project:</label>
                        <select name="editProject">
                            <?php
                            foreach ($getinplannenProject as $key) {
                                echo '<option value="' . $key['project_id'] . '">' . $key['naam'] . '</option>';
                            }
                            ?>


                        </select>
                    </div>


                    <?php
                    $getDatum = $this->getInplanDatum();
                    ?>
                    <div class="form-group">
                        <label for="newProjectDatum">Select de datum:</label>
                        <select name="editDatum">
                            <?php
                            foreach ($getDatum as $key) {
                                echo '<option value="' . $key['datum'] . '">' . $key['datum'] . '</option>';
                            }
                            ?>


                        </select>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" name="editInplannenProjectSubmit" class="btn btn-primary">Selecteren</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editinplannenProjectModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Bewerken project inplannen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <?php
                    $getTime = $this->getOneInplanProject();

                    if ($getTime == 'err') {
                        echo 'select juiste datum of project';
                    } else {
                        foreach ($getTime as $key) {

                    ?>


                </div>
                <div class="form-group" style="display:none;">
                    <label for="newProjectNaam">Id</label>
                    <input type="text" class="form-control" name="editId" value="<?= $key['id'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newProjectNaam">Begin tijd</label>
                    <input type="time" class="form-control" name="editBeginTime" value="<?= $key['begin_tijd'] ?>">
                </div>

                <div class="form-group">
                    <label for="newProjectNaam">Eind tijd</label>
                    <input type="time" class="form-control" name="editEndTime" value="<?= $key['eind_tijd'] ?>">
                </div>
        <?php
                        }
                    }
        ?>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
            <button type="submit" name="editProjectTime" class="btn btn-primary">Bewerken</button>
            </form>
            <form method="post">
                <?php

                foreach ($getTime as $key) {
                ?>
                    <div class="form-group" style="display:none;">
                        <label for="newProjectNaam">Id</label>
                        <input type="text" class="form-control" name="editProjectId" value="<?= $key['id'] ?>" readonly>
                    </div>

                <?php
                }
                if ($getTime != 'err') {
                    echo '<button type="submit" style="float: left;" name="editProjectIdBtn" class="btn btn-danger">verwijderen</button>';
                }
                ?>
        </div>
        </form>
    </div>
</div>
</div>