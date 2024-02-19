<?php
    include_once 'head.php'
?>
<?php if (isset($_SESSION['Id']) && isset($_SESSION['Mail']) && isset($_SESSION['Admin'])) {
    header("Location: index.php");
    exit();
}?>
<body>
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="../assets/images/icon/logo.png" alt="Admin Panel">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="registerpost.php" method="post">
                            <div class="form-group">
                                <label>Ad Soyad</label>
                                <input class="au-input au-input--full" type="text" name="name" placeholder="Ad Soyad">
                            </div>
                            <div class="form-group">
                                <label>Mail Adresi</label>
                                <input class="au-input au-input--full" type="email" name="mail" placeholder="Mail Adresi">
                            </div>
                            <div class="form-group">
                                <label>Şifre</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Şifre">
                            </div>
                            <div class="form-group">
                                <label>Şifre Yeniden</label>
                                <input class="au-input au-input--full" type="password" name="confirmpassword" placeholder="Şifre Tekrar">
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Kayıt Ol</button>
                        </form>
                        <?php if (isset($_GET['error'])) { ?>
                            <span class="text-danger"><?php echo $_GET['error']; ?></span>
                        <?php } ?>
                        <div class="register-link">
                            <p>
                                Giriş yapmak için tıklayın.
                                <a href="login.php">Giriş Yap</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include_once 'script.php';
?>