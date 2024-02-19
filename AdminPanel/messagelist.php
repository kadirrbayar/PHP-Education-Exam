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
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Gelen Mesajlar</h2>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-40">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th>Adı Soyadı</th>
                                    <th>Mail</th>
                                    <th>Mesaj İçeriği</th>
                                    <th>Tarih</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $mesajlar = $conn->query("SELECT * FROM message")->fetchAll();
                                foreach ($mesajlar as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['Name']; ?></td>
                                        <td><?php echo $item['Mail']; ?></td>
                                        <td><?php echo substr($item['Message'], 0, 50); ?>...</td>
                                        <td><?php echo date('d/m/y H:i', strtotime($item['Date'])); ?></td>
                                        <td><a href="messageshow.php?Id=<?php echo $item['Id'] ?>" class="btn btn-info" title="Detaylar">
                                                <i class="zmdi zmdi-inbox"> Mesajı Oku</i>
                                            </a>
                                            <a href="messagedeletepost.php?Id=<?php echo $item['Id'] ?>" class="btn btn-danger" title="Sil">
                                                <i class="zmdi zmdi-delete"> Sil</i>
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
} else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
}
?>

