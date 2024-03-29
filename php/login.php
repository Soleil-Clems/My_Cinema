<?php
$title = "Login";
include "../includes/header.php";
include "../includes/logconfig.php";
?>
<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header("Location: profil.php");
} ?>

<section id="login-section">

    <div class="container-form" id="form">
        <form action="" method="post">
            <h2>S'identifier</h2>

            <div class="input-block">
                <input type="email" class='input' placeholder="Saisir votre adresse mail" name="email" id="mail"><br>
            </div>
            <div class="input-block">
                <input type="password" placeholder="Saisir un mot de passe" name="password" class="input" id="psw1"><br>
            </div>
            <?php if (isset($msg)) : ?>
                <p class="error"><?= $msg ?></p>
            <?php endif ?>
            <input type="submit" name="login" value="Login" id="btn">

            <div class="captcha">Cette page est protégée par Google reCAPTCHA pour nous assurer que vous n'êtes pas un robot. <a href="https://www.google.com/recaptcha/about/">En savoir plus.</a></div>
        </form>
    </div>
    </div>


</section>

<?php
include "../includes/footer.php";
?>