<?php

class Vrij_vragenController extends Controller
{
    public function renderView()
    {
        $this->render('Vrij_vragen');
    }

    public function generateVrij()
    {
        $vrijDagen = $this->model->getVrijeDagen();

        if ($vrijDagen != "empty") {
            foreach ($vrijDagen as $dag) {
                $this->generateUserRow($dag);
            }
        }
    }

    public function generateAdminVrij()
    {
        $vrijDagen = $this->model->getAdminVrijeDagen();

        if ($vrijDagen != "empty") {
            foreach ($vrijDagen as $dag) {
                $this->generateAdminRow($dag);
            }
        }
    }

    public function newVrijeDag()
    {
        $status = $this->model->newVrijeDag();

        if ($status != "success") {
            echo "er ging iets fout";
        }
    }

    public function removeVrijeDag()
    {
        $status = $this->model->removeVrijeDag();

        if($status != 'success') {
            echo "Er ging iets fout";
        }
    }

    private function generateUserRow($dag)
    {
?>
        <tr>
            <td><?= $dag['dag'] ?></td>
            <td><?= $dag['beschrijving'] ?></td>
            <td><button type="button" data-toggle="modal" data-target="#removeModal<?= $dag['vrij_aanvraag_id'] ?>"><i class="fa fa-remove"></i></button></td>
        </tr>

        <div class="modal fade" id="removeModal<?= $dag['vrij_aanvraag_id'] ?>" tabindex="-1" aria-labelledby="removeModalLabel<?= $dag['vrij_aanvraag_id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="">
                        <input type="text" name="vrij_aanvraag_id" value="<?= $dag['vrij_aanvraag_id'] ?>" style="visibility: hidden;">
                        <div class="modal-header">
                            <h5 class="modal-title">Vrije dag verwijderen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                        </div>
                        <div class="modal-body">
                            <p>Weet u zeker dat u deze vrije dag wilt verwijderen</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                            <button type="submit" name="removeSubmit" class="btn btn-danger">Vrijvraag verwijderen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }

    private function generateAdminRow($dag)
    {
    ?>
        <tr>
            <td><?= $dag['naam'] ?></td>
            <td><?= $dag['dag'] ?></td>
            <td><?= $dag['beschrijving'] ?></td>
            <td><button type="button" data-toggle="modal" data-target="#removeModal<?= $dag['vrij_aanvraag_id'] ?>"><i class="fa fa-remove"></i></button></td>
        </tr>

        <div class="modal fade" id="removeModal<?= $dag['vrij_aanvraag_id'] ?>" tabindex="-1" aria-labelledby="removeModalLabel<?= $dag['vrij_aanvraag_id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="">
                        <input type="text" name="vrij_aanvraag_id" value="<?= $dag['vrij_aanvraag_id'] ?>" style="visibility: hidden;">
                        <div class="modal-header">
                            <h5 class="modal-title">Vrije dag verwijderen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                        </div>
                        <div class="modal-body">
                            <p>Weet u zeker dat u deze vrije dag wilt verwijderen</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                            <button type="submit" name="removeSubmit" class="btn btn-danger">Vrijvraag verwijderen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}
