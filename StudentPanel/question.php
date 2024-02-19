<?php
include_once 'head.php';
?>

<?php if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
    if (isset($_GET['book_id'])) { ?>
        <div class="container-scroller">
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-bs-toggle="minimize">
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
                        <?php
                        $id = 1;
                        $book_id = $_GET['book_id'];
                        $sorular = $conn->query("SELECT * FROM tests where book_id = $book_id")->fetchAll();
                        foreach ($sorular as $item) {
                            ?>
                            <div class="col-lg-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <?php echo $id . ".Soru" ?>:
                                        </h4>
                                        <p class="card-description">
                                            <?php if (in_array($item['Id'], $_SESSION['soru_sepeti'])) { ?>
                                                <a type="button" href="#" class="btn btn-outline-secondary btn-sm" disabled>Soru Sepette</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a type="button" href="#" class="btn btn-outline-primary btn-sm"
                                                   onclick="soruyuSepeteEkle(<?php echo $item['Id']; ?>)">Soruyu Sepete
                                                    Ekle</a>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                        <div class="table-responsive">
                                            <p style="font-size:medium; font-weight: 400;"><?php echo htmlspecialchars_decode($item['Title']); ?></p>
                                            <div class="form-check">
                                                <label>
                                                    A) <?php echo $item['A']; ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label>
                                                    B) <?php echo $item['B']; ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label>
                                                    C) <?php echo $item['C']; ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label>
                                                    D) <?php echo $item['D']; ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label>
                                                    E) <?php echo $item['E']; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $id++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include_once 'script.php'; ?>
        <script>
            function soruyuSepeteEkle(soruID) {
                $.ajax({
                    type: "POST",
                    url: "addquestion.php",
                    data: {soruId: soruID},
                    success: function (response) {
                        alert("Soru başarıyla sepete eklendi.");
                        location.reload();
                    },
                    error: function (error) {
                        alert("Hata oluştu : " + error);
                    }
                });
            }
        </script>
    <?php } else {
        header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
    }
} else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
} ?>