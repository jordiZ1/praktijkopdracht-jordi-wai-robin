<?php
class ProjectDetailsController extends Controller
{
    public function renderview()
    {
        $check = $this->getUrl();
        if ($check == true) {
            $this->render('ProjectDetails');
        } else {
            echo "<script>alert('error')</script>";
        }

    }

    public function getUrl()
    {
        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        $url = rtrim($url, "/");
        $url = explode("/", $url);
        $url = $url[1];

        //echo $url;
        if (!empty($url)) {
            return true;
        }
    }

    public function deleteProjectLeden()
    {
        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        $url = rtrim($url, "/");
        $url = explode("/", $url);
        $url = $url[1];

        $delete = $this->model->deletProjectLedenFromDb($url, $_SESSION['UID']['gebruiker_id']);

        if ($delete == 'done') {
            echo "<script>location.href='" . BASE_URL . "projectDetails/" . $_GET['projectLedenDelete'] . "'</script>";
        }

    }

    public function getProjectLeden()
    {
        $this->model->getProjectLedenFromDb();
    }

    public function getProjectDetails()
    {

        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        $url = rtrim($url, "/");
        $url = explode("/", $url);
        $url = $url[1];

        $project = $this->model->getProjectOneFromDb($url);

        foreach ($project as $project) {
            $this->generateTable($project);
        }
    }

    public function checkAangemeldProject()
    {
        $check = $this->model->checkProjectledenDb();

    }

    public function meldingProjecttoModel()
    {
        $check = $this->model->meldenProject($_GET['projectAanmelden'], $_SESSION["UID"]['gebruiker_id']);
        if ($check == "success") {

            echo "<script>location.href='" . BASE_URL . "projectDetails/" . $_GET['projectAanmelden'] . "'</script>";
        }
    }

    public function checkAanMelden()
    {

        $check = $this->model->checkAanmeld($_SESSION["UID"]['gebruiker_id']);
        if ($check) {
            return $check;
        }

    }

    public function getUser()
    {
        $getUser = $this->model->getUserFromDb();
        if ($getUser) {
            return $getUser;
        }
    }

    public function kopppelPerson()
    {
        $userId = $_POST['koppelenPerson'];
        $option = $_POST['koppelenOption'];

        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        $url = rtrim($url, "/");
        $url = explode("/", $url);
        $url = $url[1];

        if ($option == "yes") {
            $check = $this->model->meldenProject($url, $userId);

            if ($check == "success") {

                echo "<script>location.href='" . BASE_URL . "projectDetails/" . $url . "'</script>";
            }
        } else if ($option == "no") {
            $delete = $this->model->deletProjectLedenFromDb($url, $userId);

            if ($delete == 'done') {
                echo "<script>location.href='" . BASE_URL . "projectDetails/" . $url . "'</script>";
            }

        }

    }

    public function getProjectUser()
    {
        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        $url = rtrim($url, "/");
        $url = explode("/", $url);
        $url = $url[1];

        $getUser = $this->model->getProjectUserFromDb($url);
        if ($getUser) {
            return $getUser;
        } else if (empty($getUser)) {
            return 'err';
        }

    }

    public function generateTable($project)
    {

        $this->getProjectUser();
        ?>







<tr>
    <td style="width:100px;">Project id</td>
    <td style="width:50px;">:</td>
    <td style="width:200px;"><?=$project["project_id"]?></td>
</tr>
<tr>
    <td>Naam</td>
    <td>:</td>
    <td><?=$project["naam"]?></td>
</tr>
<tr>
    <td>Begindatum</td>
    <td>:</td>
    <td><?=$project["begindatum"]?></td>
</tr>
<tr>
    <td>Einddatum</td>
    <td>:</td>
    <td><?=$project["einddatum"]?></td>
</tr>
<tr>
    <td>Tijd</td>
    <td>:</td>
    <td><?=$project["tijd"]?></td>
</tr>
<tr>
    <td>Personen</td>
    <td>:</td>
    <td><?=$project["personen"]?></td>
</tr>

<tr>
    <td>leden</td>
    <td>:</td>
    <td>
        <?php
if ($this->getProjectUser() != 'err') {
            foreach ($this->getProjectUser() as $key) {
                echo $key['email'] . '<br>';
            }}
        ?>

    </td>
    <?php
if ($_SESSION["UID"]["admin"] == 1) {

            echo '<td><button type="button" data-toggle="modal" data-target="#koppelenModal' . $project['project_id'] . '" >Koppelen</button></td>';}

        ?>
</tr>


<tr>
    <td>Beschrijving</td>
    <td>:</td>
    <td><?=$project["beschrijving"]?></td>
</tr>



<tr>
    <?php

        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        $url = rtrim($url, "/");
        $url = explode("/", $url);
        $url = $url[1];

        if ($_SESSION["UID"]["admin"] == 0) {
            $check = $this->checkAangemeldProject();
            if ($check == "success") {
                // echo "1";
            }
            $checkA = $this->checkAanMelden();
            if ($checkA[0]['project_id'] == $url && $checkA[0]['gebruiker_id'] == $_SESSION["UID"]['gebruiker_id']) {
                //echo "<script>alert('1')</script>";
                echo '<tr><td><button type="button" data-toggle="modal" data-target="#removeProjectLedenModal' . $project['project_id'] . '" >Annuleren</button></td></tr>';
            } else {
                //echo "<script>alert('2')</script>";
                echo '<tr><td><button type="button" data-toggle="modal" data-target="#meldenModal' . $project['project_id'] . '" >Aanmelden</button></td></tr>';
            }
        }

        ?>
    <div class="modal fade" id="meldenModal<?=$project['project_id']?>" tabindex="-1"
        aria-labelledby="meldenModalLabel<?=$project['project_id']?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title">Project aanmelden</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="fa fa-remove"></i></button>
                    </div>
                    <div class="modal-body">
                        Wilt u project <?=$project['naam']?> aanmelden?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <a href="<?php echo BASE_URL . 'projectdetails/' . $project['project_id'] . '?projectAanmelden=' . $project['project_id']; ?>"
                            class="btn btn-success">Yes</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeProjectLedenModal<?=$project['project_id']?>" tabindex="-1"
        aria-labelledby="removeProjectLedenModalLabel<?=$project['project_id']?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title">Remove project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="fa fa-remove"></i></button>
                    </div>
                    <div class="modal-body">
                        <p>Weet u zeker dat u het project <?=$project['naam']?> wilt verlaten?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <a href="<?php echo BASE_URL . 'projectdetails/' . $project['project_id'] . '?projectLedenDelete=' . $project['project_id']; ?>"
                            class="btn btn-success">Yes</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="koppelenModal<?=$project['project_id']?>" tabindex="-1"
        aria-labelledby="koppelenModalLabel<?=$project['project_id']?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="Post" action="">
                    <div class="modal-header">
                        <h5 class="modal-title">Remove project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="fa fa-remove"></i></button>
                    </div>
                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Koppelen</label>
                            </div>
                            wilt u
                            <select class="custom-select" name="koppelenPerson">
                                <?php

        $this->getUser();
        foreach ($this->getUser() as $key) {
            echo '<option value="' . $key['gebruiker_id'] . '">' . $key['naam'] . '</option>';
        }
        ?>
                            </select>
                            aan het project

                            <select class="custom-select" name="koppelenOption">
                                <option value="yes">toevoegen</option>
                                <option value="no">verwijderen</option>
                            </select>
                            ?
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <input type="submit" name="koppelenBtn" class="btn btn-success" value="Yes">
                    </div>
                </form>

                <?php

        if (isset($_POST['koppelenBtn'])) {
            $this->kopppelPerson();
        }
        ?>
            </div>
        </div>
    </div>


    <?php
}

}