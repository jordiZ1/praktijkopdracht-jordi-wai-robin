<?php

if (isset($_POST['loginBtn'])) {
    $this->login();
}

if (isset($_POST['resetpwSubmit'])) {
    $this->forgetpw();
}

if (isset($_POST['resetSubmit'])) {
    $this->resetpw();
}

if (isset($_GET['page'])  == 'wachtwoord-resetten') {
?>
    <div class="login">
        <h1><a href="<?= BASE_URL ?>login">Mollenhof </a></h1>
        <div class="login-bottom">
            <h2>Reset Wachtwoord</h2>
            <form method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <p>Controlleer uw Email voor de reset code</p>
                        <br />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="login-mail">
                        <input name="resetCode" type="text" placeholder="Reset code" required>
                    </div>
                    <div class="login-mail">
                        <input name="resetPassword" type="password" placeholder="nieuw wachtwoord" required>
                        <i class="fa fa-lock"></i>
                    </div>
                    <div class="login-mail">
                        <input name="resetPasswordCheck" type="password" placeholder="Herhaal wachtwoord" required>
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="col-md-6 login-do">
                    <label class="hvr-shutter-in-horizontal login-sub">
                        <input type="submit" value="Reset wachtwoord" name="resetSubmit">
                    </label>
                </div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>
<?php
} else {
?>
    <div class="login">
        <h1><a href="<?= BASE_URL ?>login">Mollenhof </a></h1>
        <div class="login-bottom">
            <h2>Login</h2>
            <form method="POST">
                <div class="col-md-12">
                    <div class="login-mail">
                        <input name="loginEmail" type="text" placeholder="Email" required>
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input name="loginPassword" type="password" placeholder="Password" required>
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="col-md-6 login-do">
                    <label class="hvr-shutter-in-horizontal login-sub">
                        <input type="submit" value="login" name="loginBtn">
                    </label>
                </div>
                <div class="col-md-6">
                    <a href="" data-toggle="modal" data-target="#resetpw">Wachtwoord vergeten</a>
                </div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>
<?php
}
?>

<!-- wachtwoord vergeten modal -->
<div class="modal fade" id="resetpw" tabindex="-1" aria-labelledby="resetpwLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Wachtwoord vergeten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mol-modal-info">
                            <p>Vul hieronder uw e-mailadres in</p>
                            <p>U zult een email ontvangen met daarin een reset code</p>
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="resetEmail">Email</label>
                        <input type="text" class="form-control" id="resetEmail" name="resetEmail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" name="resetpwSubmit" class="btn btn-primary">Versturen</button>
                </div>
            </form>
        </div>
    </div>
</div>