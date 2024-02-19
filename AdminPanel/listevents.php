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
                    <div class="col-md-14">
                        <div class="overview-wrap">
                            <h3 class="title-5 m-b-35">Etkinlikler</h3>
                            <a href="events.php" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus-box"></i>Yeni Etkinlik Ekle
                            </a>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Etkinlik İçeriği</th>
                                    <th>Tarih</th>
                                    <th>Güncelle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $event = $conn->query("SELECT * FROM event")->fetchAll();
                                foreach ($event as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['Id']; ?></td>
                                        <td><?php echo substr($item['Description'], 0, 50); ?></td>
                                        <td><?php echo $item['Date']; ?></td>
                                        <td>
                                            <a href="editevents.php?Id=<?php echo $item['Id'] ?>" class="btn btn-outline-success btn-sm" title="Güncelle">
                                                <i class="zmdi zmdi-save">&nbsp; Güncelle</i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="deleteevents.php?Id=<?php echo $item['Id'] ?>" class="btn btn-outline-danger btn-sm" title="Sil">
                                                <i class="zmdi zmdi-delete">&nbsp; Sil</i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
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

