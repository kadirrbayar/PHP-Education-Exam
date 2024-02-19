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
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash">Eklenen Sorular</h4>
                                        <p class="card-subtitle card-subtitle-dash">
                                            Sepetinizde <?php echo count($_SESSION['soru_sepeti']); ?> soru
                                            bulunmaktadır.</p>
                                    </div>
                                    <div>
                                        <a class="btn btn-outline-primary" href="savequestion.php"><i class="mdi mdi-content-save"></i>
                                            Testi Kaydet
                                        </a>
                                        <a class="btn btn-outline-info" href="questionbank.php"><i
                                                    class="mdi mdi-basket"></i>
                                            Yeni Soru Ekle
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                    <table class="table select-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Soru</th>
                                            <th>Soru Bankası</th>
                                            <th>Sil</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($_SESSION['soru_sepeti'])) {
                                            $i = 1;
                                            foreach ($_SESSION['soru_sepeti'] as $soruid) {
                                                $soru = $conn->query("SELECT tests.Id, tests.Title AS testTitle, books.Title AS bookTitle, books.Present FROM tests JOIN books ON tests.book_id = books.Id WHERE tests.Id = $soruid")->fetch();
                                                if ($soru) {
                                                    ?>
                                                    <tr>
                                                        <td><p style="font-size: 15px"><?php echo $i; ?></p>
                                                        </td>
                                                        <td>
                                                            <p style="font-size: 15px"><?php echo substr($soru['testTitle'], 0, 40) ?>
                                                                ...</p>
                                                        </td>
                                                        <td>
                                                            <p style="font-size: 15px">
                                                                <?php echo $soru['bookTitle']; ?> / <span
                                                                        style="font-weight: bold"><?php echo $soru['Present']; ?></span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-outline-primary" href="#"
                                                               onclick="soruyuSepettenSil(<?php echo $soru['Id']; ?>)"><i
                                                                        class="mdi mdi-delete"></i>
                                                                Soruyu Sil
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                $i++;
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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
    ?>
    <script>
        function soruyuSepettenSil(soruID) {
            $.ajax({
                type: "POST",
                url: "removequestion.php",
                data: {soruId: soruID},
                success: function (response) {
                    alert("Soru başarıyla sepetten silindi.");
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
    } ?>
