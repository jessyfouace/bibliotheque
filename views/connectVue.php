<?php
include("template/header.php"); ?>
<p class="col-12 text-center mt-4"><?php echo $messageConnection; ?></p>

<div class="container login-container">
    <p class="text-center sizeinfo font-weight-bold"></p>
            <div class="row">
                <div class="col-lg-6 login-form-1">
                    <h3>Connection</h3>
                    <form action="connect.php" method="post">
                        <p class="font-weight-bold"></p>
                        <div class="form-group">
                            <label class="btnForgetPwd" for="pseudoconnection">Nom:</label>
                            <input id="pseudoconnection" type="text" class="form-control" placeholder="Votre Nom *" name="nickname" required/>
                        </div>
                        <p class="font-weight-bold"></p>
                        <div class="form-group">
                            <label class="btnForgetPwd" for="pwdconnection">Mot de passe:</label>
                            <input id="pwdconnection" type="password" class="form-control" placeholder="Votre mot de passe *" name="password" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Connection" />
                        </div>
                        <input type="hidden" value="connect" name="connect">
                    </form>
                </div>
                <div class="col-lg-6 login-form-2">
                    <h3>Inscription</h3>
                    <form action="connect.php" method="post">
                        <p class="font-weight-bold"></p>
                        <div class="form-group">
                            <label class="btnForgetPwd" for="pseudo">Nom:</label>
                            <input id="pseudo" type="text" class="form-control" placeholder="Votre Nom *" name="nickname" required/>
                        </div>
                        <p class="font-weight-bold"></p>
                        <div class="form-group">
                            <label class="btnForgetPwd" for="pwd">Mot de passe:</label>
                            <input id="pwd" type="password" class="form-control" placeholder="Votre mot de passe *" name="password" required/>
                        </div>
                        <p class="font-weight-bold"></p>
                        <div class="form-group">
                            <label class="btnForgetPwd" for="pwdconfirm">Confirmation mot de passe:</label>
                            <input id="pwdconfirm" type="password" class="form-control" placeholder="Confirmation de votre mot de passe *" name="confirmpassword" required/>
                        </div>
                        <div class="form-group">
                            <label class="btnForgetPwd" for="mail">Adresse e-mail:</label>
                            <input id="mail" type="email" class="form-control" placeholder="Adresse e-mail *" name="mail" required/>
                        </div>
                        <input type="hidden" value="inscription" name="inscription">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Inscription" />
                        </div>
                    </form>
                </div>
            </div>
</div>


<?php include("template/footer.php");
