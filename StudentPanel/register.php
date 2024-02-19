<?php
include_once 'head.php';
?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../assets/images/logo.svg" alt="logo">
                            </div>
                            <h4>Aramıza Hoş Geldin ! Şimdi kayıt ol ve dersleri keşfet.</h4>
                            <h6 class="fw-light">Kayıt Ol</h6>
                            <form class="pt-3" method="post" action="registerpost.php">
                                <br/>
                                <input type="text" class="form-control form-control-lg" name="name" placeholder="Ad Soyad">
                                <br/>
                                <input type="text" class="form-control form-control-lg" name="username" placeholder="Kullanıcı Adı">
                                <br/>
                                <input type="text" class="form-control form-control-lg" name="mail" placeholder="Mail">
                                <br/>
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="Şifre">
                                <br/>
                                <input type="password" class="form-control form-control-lg" name="re_password" placeholder="Şifre Tekrar">
                                <br/>
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Kayıt Ol</button>
                                <br/>
                                <?php if (isset($_GET['error'])) { ?>
                                    <span class="text-danger"><?php echo $_GET['error']; ?></span>
                                <?php } ?>
                                <div class="text-center mt-4 fw-light">
                                    Zaten bir hesabınız var mı ? <a href="login.php" class="text-primary">Giriş Yap</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once 'script.php';
?>