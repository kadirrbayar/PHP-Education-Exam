<?php
include_once 'head.php';
?>

<?php if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) { ?>

<div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo" href="index.html">
                    <img src="../assets/images/logo.svg" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">
                    <img src="../assets/images/logo-mini.svg" alt="logo" />
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                    <h1 class="welcome-text">Hoş Geldin ! <span class="text-black fw-bold"><?php echo $_SESSION['Name']; ?></span></h1>
                    <h3 class="welcome-sub-text">Öğrenci eğitim paneli ile testler hazırlayabilir ve çözebilirsiniz.</h3>
                </li>
            </ul>
            <?php
                include_once 'navbar.php';
            ?>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
        <?php
            include_once 'sidebar.php';
        ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Kullanıcı Bilgileri</h4>
                  <p class="card-description">
                    Buradan profil bilgilerinizi güncelleyebilirsiniz. Şifrenizi değiştirmek istemiyorsanız boş bırakınız.
                  </p>
                  <form class="forms-sample" action="profilepost.php" method="post">
                      <input type="hidden" value="<?php echo $_SESSION['Id']; ?>">
                      <div class="form-group">
                        <label>Adınız Soyadınız</label>
                        <input type="text" class="form-control" placeholder="Ad Soyad" name="name" value="<?php echo $_SESSION['Name']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $_SESSION['Username']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Mail</label>
                        <input type="email" class="form-control" placeholder="Email" name="mail" value="<?php echo $_SESSION['Mail']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Eski Şifre</label>
                        <input type="password" class="form-control" name="oldpassword" placeholder="Şifrenizi değiştirmek istemiyorsanız boş bırakın.">
                      </div>
                      <div class="form-group">
                        <label>Yeni Şifre</label>
                        <input type="password" class="form-control" name="password" placeholder="Şifrenizi değiştirmek istemiyorsanız boş bırakın.">
                      </div>
                      <div class="form-group">
                        <label>Yeni Şifre Yeniden</label>
                        <input type="password" class="form-control" name="confirmpassword" placeholder="Tekrar Şifre">
                      </div>
                      <?php if (isset($_GET['error'])) { ?>
                          <span class="text-success"><?php echo $_GET['error']; ?></span>
                          <br><br>
                      <?php } ?>
                      <button type="submit" class="btn btn-primary me-2">Güncelle</button>
                      <a href="index.php" class="btn btn-light">İptal</a>
                  </form>
                </div>
              </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php
    include_once 'script.php';
} else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
} ?>
