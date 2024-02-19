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
                        <form action="loginpost.php" method="post">
                            <div class="form-group">
                                <label>Mail Adresi</label>
                                <input class="au-input au-input--full" type="email" name="mail" placeholder="Mail Adresi">
                            </div>
                            <div class="form-group">
                                <label>Şifre</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Şifreniz">
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Giriş Yap</button>
                        </form>
                        <?php if (isset($_GET['error'])) { ?>
                            <span class="text-danger"><?php echo $_GET['error']; ?></span>
                        <?php } ?>
                        <div class="register-link">
                            <p>
                                Öğrenci girişi yapmak için tıklayın.
                                <a href="../StudentPanel/login.php">Öğrenci Girişi</a>
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