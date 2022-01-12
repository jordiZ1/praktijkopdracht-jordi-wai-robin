<?php

$this->checkLoggedIn();

?>

<div class="banner">
    <h2>
        <a href="<?= BASE_URL ?>">Dashboard</a>
        <i class="fa fa-angle-right"></i>
        <span>404</span>
    </h2>
</div>

<div class="content-top">
    <div class="row">
        <div class="col-md-12 mol-flex mol-jc-ct mol-ai-ct mol-dr-row">
            <h1>OOOPS</h1>
            <img src="<?= BASE_URL ?>template/images/mole-cartoon.png" alt="mole picture">
            <h2>Deze pagina bestaat niet.</h2>
        </div>
    </div>
</div>
<div class="content-mid">
    <div class="row">
        <div class="col-md-12 mol-flex mol-jc-ct">
            <button onclick="window.history.back()" class="btn btn-primary btn-lg">Pagina terug</button>
        </div>
    </div>
</div>
<div class="content-bottom">

</div>