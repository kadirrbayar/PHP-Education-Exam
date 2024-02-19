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
                            <div class="card-header">Etkinlik</div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Etkinlik Ekleme Paneli</h3>
                                </div>
                                <hr>
                                <form action="eventpost.php" method="post" novalidate="novalidate">
                                    <div class="form-group">
                                        <textarea name="title" rows="9" placeholder="Etkinlik içeriği" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                    <div>
                                        <?php if (isset($_GET['error'])) { ?>
                                            <span class="text-danger"><?php echo $_GET['error']; ?></span>
                                            <br><br>
                                        <?php } ?>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Kaydet</span>
                                        </button>
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

