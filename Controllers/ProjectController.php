<?php

class ProjectController extends Controller
{
    public function renderview()
    {
        $this->render('Project');
    }

    public function generateprojectsTable()
    {
        //get all project information
        $project = $this->model->getProjectFromDB();

        foreach ($project as $project) {
            $this->generateRow($project);
        }
    }

    public function addProject()
    {

        $status = $this->model->newProject();

        if ($status == "success") {
            echo "success";
            echo "<script>location.href='" . BASE_URL . "project'</script>";
        }
    }

    public function deleteProject()
    {
        $delete = $this->model->deleteProjectFromDb();
        if ($delete == 'done') {
            echo "<script>location.href='" . BASE_URL . "project'</script>";
        }

    }

    public function editProject()
    {
        $edit = $this->model->updateProject();
        if ($edit == 'done') {
            echo "<script>location.href='" . BASE_URL . "project'</script>";
        }

    }

    private function generateRow($project)
    {
        ?>
<tr>
    <td><?=$project["project_id"]?></td>
    <td><?=$project["naam"]?></td>
    <td><?=$project["begindatum"]?></td>
    <td><?=$project["einddatum"]?></td>
    <td><?=$project["tijd"]?></td>
    <td><?=$project["personen"]?></td>
    <td><?=$project["beschrijving"]?></td>
    <td>
        <button type="button" data-toggle="modal" data-target="#editModal<?=$project['project_id']?>"><i
                class="fa fa-edit"></i></button>
        <button type="button" data-toggle="modal" data-target="#removeModal<?=$project['project_id']?>"><i
                class="fa fa-remove"></i></button>
        <a href="<?=BASE_URL?>projectDetails/<?=$project['project_id']?>" style="display:block;"><button
                type="button">details</button></a>
        <?php

        ?>

    </td>
</tr>

<div class="modal fade" id="editModal<?=$project['project_id']?>" tabindex="-1"
    aria-labelledby="editModalLabel<?=$project['project_id']?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Project bewerken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNaam">project id</label>
                        <input type="text" class="form-control" id="editProjectId" name="editProjectId"
                            value="<?=$project['project_id']?>">
                    </div>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNaam">Naam</label>
                        <input type="text" class="form-control" id="editNaam" name="editNaam"
                            value="<?=$project['naam']?>">
                    </div>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNaam">begindatum</label>
                        <input type="text" class="form-control" id="editBegindatum" name="editBegindatum"
                            value="<?=$project['begindatum']?>">
                    </div>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNaam">einddatum</label>
                        <input type="text" class="form-control" id="editEinddatum" name="editEinddatum"
                            value="<?=$project['einddatum']?>">
                    </div>

                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNaam">tijd</label>
                        <input type="text" class="form-control" id="editTijd" name="editTijd"
                            value="<?=$project['tijd']?>">
                    </div>

                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNaam">personen</label>
                        <input type="text" class="form-control" id="editPersonen" name="editPersonen"
                            value="<?=$project['personen']?>">
                    </div>

                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNaam">beschrijving</label>
                        <input type="text" class="form-control" id="editBeschrijving" name="editBeschrijving"
                            value="<?=$project['beschrijving']?>">
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" name="editProjectSubmit" class="btn btn-primary">Opslaan</button>
                    <?php

        if (isset($_POST['editProjectSubmit'])) {
            $this->editProject();
        }

        ?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="removeModal<?=$project['project_id']?>" tabindex="-1"
    aria-labelledby="removeModalLabel<?=$project['project_id']?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Remove project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u project <?=$project['naam']?> wilt verwijderen</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <a href="<?php echo BASE_URL . 'project?projectDelete=' . $project['project_id']; ?>"
                        class="btn btn-success">Yes</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
}
}
?>
