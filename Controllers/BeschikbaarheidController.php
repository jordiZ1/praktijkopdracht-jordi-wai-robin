<?php

class BeschikbaarheidController extends Controller
{
    public function renderView()
    {
        $this->render("Beschikbaarheid");
    }

    public function generateBeschikbaarheid()
    {
        $beschikbaarheid = $this->model->getBeschikbaarheid($_SESSION['UID']['gebruiker_id']);

        if ($beschikbaarheid == "empty") {
            echo "<p>er ging iets fout tijdens het ophalen van uw beschikbaarheid</p>";
        } else {
            $this->generateUserRow($beschikbaarheid);
        }
    }

    public function generateAdminBeschikbaarheid()
    {
        $allData = $this->model->getAdminBeschikbaarheid();

        if ($allData == "empty") {
            echo "<p>er ging iets fout tijdens het ophalen van de beschikbaarheid</p>";
        } else {
            foreach ($allData as $data) {
                $this->generateAdminRow($data);
            }
        }
    }

    public function editBeschikbaarheid()
    {
        $status = $this->model->updateBeschikbaarheid();

        if ($status != 'success') {
            echo "er ging iets mis";
        }
    }

    private function generateUserRow($data)
    {
        $ma = ($data['ma'] == "NULL") ? "-" : explode('-', $data['ma']);
        $di = ($data['di'] == "NULL") ? "-" : explode('-', $data['di']);
        $wo = ($data['wo'] == "NULL") ? "-" : explode('-', $data['wo']);
        $do = ($data['do'] == "NULL") ? "-" : explode('-', $data['do']);
        $vr = ($data['vr'] == "NULL") ? "-" : explode('-', $data['vr']);
        $za = ($data['za'] == "NULL") ? "-" : explode('-', $data['za']);
        $zo = ($data['zo'] == "NULL") ? "-" : explode('-', $data['zo']);
?>
        <tr>
            <td><?= ($ma == '-') ? $ma : $ma[0] . '-' . $ma[1] ?></td>
            <td><?= ($di == '-') ? $di : $di[0] . '-' . $di[1] ?></td>
            <td><?= ($wo == '-') ? $wo : $wo[0] . '-' . $wo[1] ?></td>
            <td><?= ($do == '-') ? $do : $do[0] . '-' . $do[1] ?></td>
            <td><?= ($vr == '-') ? $vr : $vr[0] . '-' . $vr[1] ?></td>
            <td><?= ($za == '-') ? $za : $za[0] . '-' . $za[1] ?></td>
            <td><?= ($zo == '-') ? $zo : $zo[0] . '-' . $zo[1] ?></td>
            <td>
                <button type="button" data-toggle="modal" data-target="#editModal<?= $data['gebruiker_id'] ?>"><i class="fa fa-edit"></i></button>
            </td>
        </tr>

        <div class="modal fade" id="editModal<?= $data['gebruiker_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $data['gebruiker_id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="">
                        <input type="text" name="editID" value="<?= $data['gebruiker_id'] ?>" style="visibility: hidden;">
                        <div class="modal-header">
                            <h5 class="modal-title">Beschikbaarheid bewerken</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mol-modal-info">
                                    <p>U kunt uw beschikbaarheid per dag aanpassen.</p>
                                    <p>Als u een dag beschikbaar wilt zijn klikt u het vinkje aan en vult u vervolgens een begin en eindtijd in.</p>
                                    <p>Als u niet langer meer beschikbaar wilt zijn klikt u het vinkje uit.</p>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Ma: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="ma" name="checkMa" <?= ($ma == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartMa" value="<?= ($ma == '-') ? '' : $ma[0] ?>">
                                        <input type="time" class="form-control" name="newEndMa" value="<?= ($ma == '-') ? '' : $ma[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Di: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="di" name="checkDi" <?= ($di == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartDi" value="<?= ($di == '-') ? '' : $di[0] ?>">
                                        <input type="time" class="form-control" name="newEndDi" value="<?= ($di == '-') ? '' : $di[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Wo: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="wo" name="checkWo" <?= ($wo == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartWo" value="<?= ($wo == '-') ? '' : $wo[0] ?>">
                                        <input type="time" class="form-control" name="newEndWo" value="<?= ($wo == '-') ? '' : $wo[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Do: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="do" name="checkDo" <?= ($do == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartDo" value="<?= ($do == '-') ? '' : $do[0] ?>">
                                        <input type="time" class="form-control" name="newEndDo" value="<?= ($do == '-') ? '' : $do[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Vr: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="vr" name="checkVr" <?= ($vr == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartVr" value="<?= ($vr == '-') ? '' : $vr[0] ?>">
                                        <input type="time" class="form-control" name="newEndVr" value="<?= ($vr == '-') ? '' : $vr[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Za: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="za" name="checkZa" <?= ($za == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartZa" value="<?= ($za == '-') ? '' : $za[0] ?>">
                                        <input type="time" class="form-control" name="newEndZa" value="<?= ($za == '-') ? '' : $za[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Zo: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="zo" name="checkZo" <?= ($zo == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartZo" value="<?= ($zo == '-') ? '' : $zo[0] ?>">
                                        <input type="time" class="form-control" name="newEndZo" value="<?= ($zo == '-') ? '' : $zo[1] ?>">
                                    </div>
                                </div>
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
    <?php
    }

    private function generateAdminRow($data)
    {
        $ma = ($data['ma'] == "NULL") ? "-" : explode('-', $data['ma']);
        $di = ($data['di'] == "NULL") ? "-" : explode('-', $data['di']);
        $wo = ($data['wo'] == "NULL") ? "-" : explode('-', $data['wo']);
        $do = ($data['do'] == "NULL") ? "-" : explode('-', $data['do']);
        $vr = ($data['vr'] == "NULL") ? "-" : explode('-', $data['vr']);
        $za = ($data['za'] == "NULL") ? "-" : explode('-', $data['za']);
        $zo = ($data['zo'] == "NULL") ? "-" : explode('-', $data['zo']);
    ?>
        <tr>
            <td><?= $data['naam'] ?></td>
            <td><?= ($ma == '-') ? $ma : $ma[0] . '-' . $ma[1] ?></td>
            <td><?= ($di == '-') ? $di : $di[0] . '-' . $di[1] ?></td>
            <td><?= ($wo == '-') ? $wo : $wo[0] . '-' . $wo[1] ?></td>
            <td><?= ($do == '-') ? $do : $do[0] . '-' . $do[1] ?></td>
            <td><?= ($vr == '-') ? $vr : $vr[0] . '-' . $vr[1] ?></td>
            <td><?= ($za == '-') ? $za : $za[0] . '-' . $za[1] ?></td>
            <td><?= ($zo == '-') ? $zo : $zo[0] . '-' . $zo[1] ?></td>
            <td>
                <button type="button" data-toggle="modal" data-target="#editModal<?= $data['gebruiker_id'] ?>"><i class="fa fa-edit"></i></button>
            </td>
        </tr>

        <div class="modal fade" id="editModal<?= $data['gebruiker_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $data['gebruiker_id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="">
                        <input type="text" name="editID" value="<?= $data['gebruiker_id'] ?>" style="visibility: hidden;">
                        <div class="modal-header">
                            <h5 class="modal-title">Beschikbaarheid bewerken</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mol-modal-info">
                                    <p>U kunt uw beschikbaarheid per dag aanpassen.</p>
                                    <p>Als u een dag beschikbaar wilt zijn klikt u het vinkje aan en vult u vervolgens een begin en eindtijd in.</p>
                                    <p>Als u niet langer meer beschikbaar wilt zijn klikt u het vinkje uit.</p>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Ma: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="ma" name="checkMa" <?= ($ma == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartMa" value="<?= ($ma == '-') ? '' : $ma[0] ?>">
                                        <input type="time" class="form-control" name="newEndMa" value="<?= ($ma == '-') ? '' : $ma[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Di: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="di" name="checkDi" <?= ($di == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartDi" value="<?= ($di == '-') ? '' : $di[0] ?>">
                                        <input type="time" class="form-control" name="newEndDi" value="<?= ($di == '-') ? '' : $di[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Wo: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="wo" name="checkWo" <?= ($wo == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartWo" value="<?= ($wo == '-') ? '' : $wo[0] ?>">
                                        <input type="time" class="form-control" name="newEndWo" value="<?= ($wo == '-') ? '' : $wo[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Do: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="do" name="checkDo" <?= ($do == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartDo" value="<?= ($do == '-') ? '' : $do[0] ?>">
                                        <input type="time" class="form-control" name="newEndDo" value="<?= ($do == '-') ? '' : $do[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Vr: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="vr" name="checkVr" <?= ($vr == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartVr" value="<?= ($vr == '-') ? '' : $vr[0] ?>">
                                        <input type="time" class="form-control" name="newEndVr" value="<?= ($vr == '-') ? '' : $vr[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Za: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="za" name="checkZa" <?= ($za == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartZa" value="<?= ($za == '-') ? '' : $za[0] ?>">
                                        <input type="time" class="form-control" name="newEndZa" value="<?= ($za == '-') ? '' : $za[1] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span>Zo: </span>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" class="newTimeCheck" value="zo" name="checkZo" <?= ($zo == '-') ? '' : 'checked' ?>></div>
                                        <input type="time" class="form-control" name="newStartZo" value="<?= ($zo == '-') ? '' : $zo[0] ?>">
                                        <input type="time" class="form-control" name="newEndZo" value="<?= ($zo == '-') ? '' : $zo[1] ?>">
                                    </div>
                                </div>
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
<?php
    }
}
