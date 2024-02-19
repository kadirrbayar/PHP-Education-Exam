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
                            <h2 class="title-1">Tüm Soru Bankaları</h2>
                            <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#mediumModal">
                                <i class="zmdi zmdi-plus"></i>Yeni Soru Bankası Ekle
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-14">
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th>Görsel</th>
                                    <th>Soru Bankası</th>
                                    <th>Yayın Evi</th>
                                    <th>Soru Sayısı</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sorubankasi = $conn->query("SELECT * FROM books")->fetchAll();
                                foreach ($sorubankasi as $item) {
                                    $count = $conn->query("SELECT book_id, COUNT(*) as adet FROM tests WHERE book_id = $item[Id] GROUP BY book_id")->fetch();
                                    ?>
                                    <tr>
                                        <td><img src="<?php echo $item['ImageUrl'] ?>" alt="Image" style="border-radius: 50%; width: 80px; height: 80px; vertical-align: middle;"></td>
                                        <td><?php echo $item['Title']; ?></td>
                                        <td><?php echo $item['Present']; ?></td>
                                        <td><?php echo ($count ? $count['adet'] : 0) ?> Soru</td>
                                        <td>
                                            <a href="editquestionbank.php?Id=<?php echo $item['Id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="deletequestionbank.php?Id=<?php echo $item['Id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-trash"></i></a>
                                            <a href="questiontable.php?Id=<?php echo $item['Id']; ?>" class="btn btn-dark btn-sm"><i class="fa fa-book"></i> Sorular</a>
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

        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Yeni Soru Bankası Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="questionbankpost.php" method="post">
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Soru Bankası</label>
                                <input type="text" name="title" placeholder="Ad" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Yayın Evi</label>
                                <input type="text" name="present" placeholder="Yayın" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Görsel</label>
                                <input type="text" name="ImageUrl" placeholder="Görsel Url" class="form-control">
                            </div>
                            <?php if (isset($_GET['error'])) { ?>
                                <span class="text-danger"><?php echo $_GET['error']; ?></span>
                                <br><br>
                            <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary">Ekle</button>
                    </div>
                    </form>
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

