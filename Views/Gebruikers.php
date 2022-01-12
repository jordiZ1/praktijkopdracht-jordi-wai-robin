<?php

$this->checkLoggedIn();
$this->checkAdmin();

// post check
if (isset($_POST['newSubmit'])) {
    $this->newUser();
}

if(isset($_POST['editSubmit'])) {
    $this->editUser();
}

if(isset($_POST['removeSubmit'])) {
    $this->removeUser();
}

?>

<div class="banner">
    <h2>
        <a href="<?= BASE_URL ?>">Dashboard</a>
        <i class="fa fa-angle-right"></i>
        <span>Gebruikers</span>
    </h2>
</div>

<div class="content-top">
    <div class="col-sm-8 col-md-8 col-lg-10">
        <h1>Gebruikers</h1>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newModal">Nieuwe gebruiker</button>
    </div>
</div>
<div class="content-mid">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Naam</th>
                    <th scope="col">Email</th>
                    <th scope="col">Beroep</th>
                    <th scope="col">Beheerder</th>
                    <th scope="col">Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $this->generateUsersTable();
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
                    <h5 class="modal-title">Nieuwe gebruiker toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newNaam">Naam</label>
                        <input type="text" class="form-control" id="newNaam" name="newNaam" required>
                    </div>
                    <div class="form-group">
                        <label for="newEmail">Email</label>
                        <input type="text" class="form-control" id="newEmail" name="newEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="newWachtwoord">Wachhtwoord</label>
                        <input type="password" class="form-control" id="newWachtwoord" name="newWachtwoord" required>
                    </div>
                    <div class="form-group">
                        <label for="newBeroep">Beroep</label>
                        <input type="text" class="form-control" id="newBeroep" name="newBeroep" required>
                    </div>
                    <div class="form-group">
                        <label for="newRole">Role</label>
                        <select name="newRole" class="form-control" id="newRole" required>
                            <option value="0">Gebruiker</option>
                            <option value="1">Beheerder</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" name="newSubmit" class="btn btn-primary">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
</div>