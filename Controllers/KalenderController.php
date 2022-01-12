<?php

include 'Calendar/Calendar.php';

class KalenderController extends Controller
{
    public function renderView()
    {
        $this->render('Kalender');
    }

    public function generateAgenda()
    {
        if (isset($_GET['date'])) {
            $year = substr($_GET['date'], 0, 4);
            $month = substr($_GET['date'], 5, 6);
        } else {
            if (isset($_GET['month'])) {
                if ($_GET['month'] > 12 || $_GET['month'] < 1) {
                    echo "error";
                    die;
                } else {
                    $month = $_GET['month'];
                }
            } else {
                $month = date('m');
            }

            if (isset($_GET['year'])) {
                if ($_GET['year'] < 1970 || $_GET['year'] > 9999) {
                    echo "error";
                    die;
                } else {
                    $year = $_GET['year'];
                }
            } else {
                $year = date('Y');
            }
        }

        $this->calendar = new Calendar($year . '-' . $month . '-01');
        $project = $this->getProjectDagen();
        if ($project != "empty") {
            foreach ($project as $key) {
                $this->calendar->add_event($key['naam'], $key['begin_tijd'] . ' - ' . $key['eind_tijd'], $key['datum'], 1, 'green', 'projectDetails/' . $key['project_id']);
            }
        }
        // $this->calendar->add_event('Birthday', '3:00-6:00', '2021-06-03', 1, 'green', 'index.php');
        // $this->calendar->add_event('Doctors', '3:00-6:00', '2021-06-04', 1, 'red', 'index.php');
        // $this->calendar->add_event('Holiday', '3:00-6:00', '2021-06-16', 7, 'yellow', 'index.php');
    }

    public function getInplannenProject()
    {
        $get = $this->model->getProjectFromDb();
        if ($get) {
            return $get;
        }
    }

    public function selectProject()
    {
        if (isset($_SESSION['project'])) {
            unset($_SESSION['project']);
        }
        $select = $this->model->selectProjectForInplannner();
        if ($select == 'done') {
            echo '<script>
            $(document).ready(function(){
                // Show the Modal on load
                $("#inplannenProjectModal").modal("show");


              });
            </script>

            ';
        }
    }

    public function getOneProject()
    {
        $get = $this->model->getProjectOneFromDb($_SESSION['project']);
        if ($get) {
            return $get;
        }
    }

    public function getInplanDatum()
    {
        $get = $this->model->getInplanDatumFromDb();
        if ($get) {
            return $get;
        }
    }

    public function inplanProject()
    {
        $newBegindatum = $_POST['newBegindatum'];
        $newEinddatum = $_POST['newEinddatum'];
        $newInplanDatum = $_POST['newInplanDatum'];
        $newBeginuren = $_POST['newBeginuren'];
        $newEinduren = $_POST['newEinduren'];

        if ($newBeginuren > $newEinduren) {
            echo "select juiste uren a.u.b";
        } else if ($newInplanDatum < $newBegindatum || $newInplanDatum > $newEinddatum) {
            echo "select juiste datum a.u.b";
        } else {
            $add = $this->model->addInplanProjectToDb($_SESSION['project'], $newInplanDatum, $newBeginuren, $newEinduren);
        }
    }

    public function getProjectDagen()
    {

        $get = $this->model->getProjectDagenFromDb();
        if ($get) {
            return $get;
        }
    }

    public function editProject()
    {
        if (isset($_SESSION['editDatum'])) {
            unset($_SESSION['editDatum']);
        }
        if (isset($_SESSION['editProject'])) {
            unset($_SESSION['editProject']);
        }
        $edit = $this->model->editProjectForInplannner();
        if ($edit == 'done') {
            echo '<script>
            $(document).ready(function(){
                // Show the Modal on load
                $("#editinplannenProjectModal").modal("show");


              });
            </script>

            ';
        }
    }

    public function getOneInplanProject()
    {
        $get = $this->model->getOneInplanProjectFromDb($_SESSION['editDatum'], $_SESSION['editProject']);
        if ($get == "empty") {
            //echo '<script>alert("select juiste datum of project")</script>';

            /* echo '<script>
            $(document).ready(function(){
            // Show the Modal on load
            $("#bewerkenSelectModal").modal("show");

            });
            </script>

            '; */
            return "err";
        } else {
            return $get;
        }
    }

    public function editProjectTime()
    {
        $id = $_POST['editId'];
        $beginTime = $_POST['editBeginTime'];
        $endTime = $_POST['editEndTime'];

        $edit = $this->model->editProjectTimeToDb($beginTime, $endTime, $id);
    }

    public function deletePlan()
    {
        $id = $_POST['editProjectId'];
        $delete = $this->model->deletePlanFromDb($id);
    }
}
