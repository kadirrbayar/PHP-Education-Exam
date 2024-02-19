<?php
include_once 'head.php';
if (!isset($_SESSION['soru_sepeti'])) {
    $_SESSION['soru_sepeti'] = array();
}
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
                    <img src="../assets/images/logo.svg" alt="logo"/>
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">
                    <img src="../assets/images/logo-mini.svg" alt="logo"/>
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                    <h1 class="welcome-text">Hoş Geldin ! <span
                                class="text-black fw-bold"><?php echo $_SESSION['Name']; ?></span></h1>
                    <h3 class="welcome-sub-text">Öğrenci eğitim paneli ile testler hazırlayabilir ve
                        çözebilirsiniz.</h3>
                </li>
            </ul>
            <?php
            include_once 'navbar.php';
            ?>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
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
                    <?php $sorubankasi = $conn->query("SELECT * FROM books")->fetchAll();
                    foreach ($sorubankasi as $item) {
                        $count = $conn->query("SELECT book_id, COUNT(*) as adet FROM tests WHERE book_id = $item[Id] GROUP BY book_id")->fetch();
                    ?>
                    <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex">
                                                <img class="img" style="width:200px;height:200px;"
                                                     src="<?php echo $item['ImageUrl']; ?>" alt="profile">
                                                <div class="wrapper ms-3">
                                                    <b><?php echo $item['Title']; ?></b>
                                                    <br>
                                                    <p class="text-muted mb-0"><?php echo $item['Present']; ?></p>
                                                    <p class="text-muted mb-0"><?php echo ($count ? $count['adet'] : 0) ?> Soru Bulunmaktadır</p>
                                                    <br><br>
                                                    <a type="button"
                                                       href="question.php?book_id=<?php echo $item['Id']; ?>"
                                                       class="btn btn-inverse-primary btn-fw">Soruları Gör</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once 'script.php';
    } else {
        header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
    } ?>
