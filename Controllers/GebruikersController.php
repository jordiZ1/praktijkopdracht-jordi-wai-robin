<?php

class GebruikersController extends Controller
{
    public function renderView()
    {
        $this->render("Gebruikers");
    }

    public function generateUsersTable()
    {
        //get all user information
        $users = $this->model->getUsersFromDB();

        foreach ($users as $user) {
            $this->generateRow($user);
        }
    }

    public function newUser()
    {
        $status = $this->model->newUser();

        if ($status == "success") {
            echo "success";
        } else if ($status == "duplicMail") {
            echo "email address al gebruikt";
        } else {
            echo "error";
        }
    }

    public function editUser()
    {
        $status = $this->model->editUser();

        if ($status == "success") {
            echo "success";
        } else if ($status == "duplicMail") {
            echo "email address al gebruikt";
        } else {
            echo "error";
        }
    }

    public function removeUser()
    {
        $status = $this->model->removeUser();

        if ($status == "success") {
            echo "success";
        } else {
            echo "error";
        }
    }

    private function generateRow($user)
    {
?>
        <tr>
            <td><?= $user["naam"] ?></td>
            <td><?= $user["email"] ?></td>
            <td><?= $user["beroep"] ?></td>
            <td><?= ($user["admin"] == 1) ? "True" : "False" ?></td>
            <td>
                <button type="button" data-toggle="modal" data-target="#editModal<?= $user['gebruiker_id'] ?>"><i class="fa fa-edit"></i></button>
                <button type="button" data-toggle="modal" data-target="#removeModal<?= $user['gebruiker_id'] ?>"><i class="fa fa-remove"></i></button>
            </td>
        </tr>

        <div class="modal fade" id="editModal<?= $user['gebruiker_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $user['gebruiker_id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="">
                        <input type="text" name="editID" value="<?= $user['gebruiker_id'] ?>" style="visibility: hidden;">
                        <div class="modal-header">
                            <h5 class="modal-title">Gebruiker bewerken</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="editNaam">Naam</label>
                                <input type="text" class="form-control" id="editNaam" name="editName" value="<?= $user['naam'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="editEmail">Email</label>
                                <input type="text" class="form-control" id="editEmail" name="editEmail" value="<?= $user['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="editBeroep">Beroep</label>
                                <input type="text" class="form-control" id="editBeroep" name="editBeroep" value="<?= $user['beroep'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="editRole">Role</label>
                                <select name="editRole" class="form-control" id="editRole">
                                    <option value="0" <?= ($user["admin"] == 1) ? "" : "selected" ?>>Gebruiker</option>
                                    <option value="1" <?= ($user["admin"] == 1) ? "selected" : "" ?>>Beheerder</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                            <button type="submit" name="editSubmit" class="btn btn-primary">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="removeModal<?= $user['gebruiker_id'] ?>" tabindex="-1" aria-labelledby="removeModalLabel<?= $user['gebruiker_id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="">
                        <input type="text" name="removeID" value="<?= $user['gebruiker_id'] ?>" style="visibility: hidden;">
                        <div class="modal-header">
                            <h5 class="modal-title">Remove user</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                        </div>
                        <div class="modal-body">
                            <p>Weet u zeker dat u gebruiker <?= $user['naam'] ?> wilt verwijderen</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                            <button type="submit" name="removeSubmit" class="btn btn-danger">Gebruiker verwijderen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}
?>