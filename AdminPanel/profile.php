<?php
include_once 'head.php'
?>

<?php if (isset($_SESSION['Id']) && isset($_SESSION['Mail']) && isset($_SESSION['Admin'])) { ?>

<body>
<div class="page-wrapper">
    <header class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo" href="index.html">
                        <img src="../assets/images/icon/logo.png" alt="CoolAdmin"/>
                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <?php
        include_once 'sidebarMobile.php';
        ?>
    </header>
    <?php
    include_once 'sidebar.php';
    ?>
    <div class="page-container">
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <?php
                    include_once 'header.php';
                    ?>
                </div>
            </div>
        </header>
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-lg-14">
                        <div class="card">
                            <div class="card-header">Profil Düzenleme Paneli</div>
                            <div class="card-body card-block">
                                <form action="profilepost.php" method="post" class="">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" id="name" name="Name" placeholder="Adınız" value="<?php echo $_SESSION['Name'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input type="email" id="email" name="Mail" placeholder="Email" value="<?php echo $_SESSION['Mail'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <input type="password" name="OldPassword" placeholder="Eski Şifre" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock-open"></i>
                                            </div>
                                            <input type="password" name="Password" placeholder="Şifrenizi değiştirmek istemiyorsanız boş bırakın." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock-open"></i>
                                            </div>
                                            <input type="password" name="NewPassword" placeholder="Tekrar Yeni Şifre" class="form-control">
                                        </div>
                                    </div>
                                    <?php if (isset($_GET['error'])) { ?>
                                        <span class="text-danger"><?php echo $_GET['error']; ?></span>
                                        <br><br>
                                    <?php } ?>
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-success">Güncelle</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    include_once 'footer.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'script.php';
}
else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
}
?>

