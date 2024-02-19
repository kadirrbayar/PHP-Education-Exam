<?php
include_once 'head.php'
?>

<?php if (isset($_SESSION['Id']) && isset($_SESSION['Mail']) && isset($_SESSION['Admin']) && isset($_GET['Id'])) { ?>

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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Mesaj İçeriği</strong>
                            </div>
                            <div class="card-body">
                                <div class="vue-misc">
                                    <?php
                                    $id = $_GET['Id'];
                                    $selectedQuery = $conn->prepare("SELECT * FROM message WHERE Id = ?");
                                    $selectedQuery->execute([$id]);
                                    $selectedRow = $selectedQuery->fetch(PDO::FETCH_ASSOC);
                                    if ($selectedRow !== null) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Adı Soyadı :</b>
                                            <br>
                                            <p><?php echo $selectedRow['Name'] ?></p>
                                            <br>
                                            <b>Konu :</b>
                                            <br>
                                            <p><?php echo $selectedRow['Subject'] ?></p>
                                            <br>
                                            <b>Mail :</b>
                                            <br>
                                            <p><?php echo $selectedRow['Mail'] ?></p>
                                            <br>
                                            <b>Tarih :</b>
                                            <br>
                                            <p><?php echo date('d/m/y H:i', strtotime($selectedRow['Date'])); ?></p>
                                            <br>
                                        </div>
                                        <div class="col-md-12">
                                            <b>Gelen Mesaj :</b>
                                            <br>
                                            <div class="jumbotron">
                                                <?php echo $selectedRow['Message'] ?>
                                            </div>
                                        </div>
                                        <a href="messagelist.php" class="btn btn-info" title="Geri Gel">
                                            <i class="zmdi zmdi-arrow-back"> Mesajlara Dön</i>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
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
} else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
}
?>

