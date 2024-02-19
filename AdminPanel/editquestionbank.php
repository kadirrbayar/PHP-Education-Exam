<?php
include_once 'head.php'
?>

<?php if (isset($_SESSION['Id']) && isset($_SESSION['Mail']) && isset($_SESSION['Admin'])) {
        if (isset($_GET['Id'])) { ?>

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
                        <?php
                        $Id = $_GET['Id'];
                        $stmt = $conn->prepare("SELECT * FROM books WHERE Id = :Id");
                        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
                        $stmt->execute();
                        $question = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($question) { ?>
                        <div class="card">
                            <div class="card-header">
                                Soru Bankası Düzenleme Paneli
                            </div>
                            <form action="questionbankpost.php" method="post">
                                <div class="card-body card-block">
                                    <input type="hidden" name="Id" class="form-control" value="<?php echo $question['Id']; ?>">
                                    <div class="form-group">
                                        <label>Soru Bankası</label>
                                        <input type="text" name="title" placeholder="Ad" class="form-control" value="<?php echo $question['Title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Yayın Evi</label>
                                        <input type="text" name="present" placeholder="Yayın" class="form-control" value="<?php echo $question['Present'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Görsel</label>
                                        <input type="text" name="ImageUrl" placeholder="Görsel Url" class="form-control" value="<?php echo $question['ImageUrl'] ?>">
                                    </div>
                                    <?php if (isset($_GET['error'])) { ?>
                                        <span class="text-danger"><?php echo $_GET['error']; ?></span>
                                        <br><br>
                                    <?php } ?>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Güncelle
                                    </button>
                                    <a href="questionbank.php" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> İptal
                                    </a>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
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
    header("Location: questionbank.php");
    }
}
else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
}
?>
