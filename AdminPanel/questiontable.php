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
                    <?php
                    $Id = $_GET['Id'];
                    $stmt = $conn->prepare("SELECT * FROM books WHERE Id = :Id");
                    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
                    $stmt->execute();
                    $question = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($question) { ?>
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1"><strong>Soru Bankası : </strong><?php echo $question['Title']; ?></h2>
                            <a class="au-btn au-btn-icon au-btn--blue2" href="addquestion.php?Id=<?php echo $question['Id']; ?>">
                                <i class="zmdi zmdi-file-add"></i>Yeni Soru Ekle
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                    <br>
                    <div class="col-lg-14">
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>İçerik</th>
                                    <th>Doğru Cevap</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $id = $_GET['Id'];
                                $sorubankasi = $conn->query("SELECT * FROM tests where book_id = $id")->fetchAll();
                                foreach ($sorubankasi as $item) {
                                ?>
                                    <tr>
                                        <td><?php echo $item['Id'] ?></td>
                                        <td><?php echo substr($item['Title'], 0, 50); ?>...</td>
                                        <td><?php echo $item['Correct'] ?></td>
                                        <td>
                                            <a href="editquestion.php?Id=<?php echo $item['Id']; ?>"" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>Düzenle</a>
                                            <a href="deletequestionpost.php?Id=<?php echo $item['Id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-trash"></i>Sil</a>
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

