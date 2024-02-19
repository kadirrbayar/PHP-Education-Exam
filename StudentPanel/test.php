<?php
include_once 'head.php';
?>

<?php if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) { ?>

    <div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                    <h1 class="welcome-text">Sınav Başladı. <span id="kalanSure" class="text-primary fw-bold"></span></h1>
                    <h3 class="welcome-sub-text">Sınavınız 45 Dakikadır. Başarılar Dileriz.</h3>
                </li>
            </ul>
        </div>
    </nav>
        <div class="container-fluid page-body-wrapper">
                <div class="content-wrapper">
                    <div class="row">
                                <div class="col-lg-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title question-title">
                                                Test
                                            </h4>
                                            <div class="table-responsive">
                                                <p style="font-size:medium; font-weight: 400;">Soru 1</p>
                                                <div class="form-check">
                                                </div>
                                                <div class="form-check">
                                                </div>
                                                <div class="form-check">
                                                </div>
                                                <div class="form-check">
                                                </div>
                                                <div class="form-check">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <button id="finishButton" class="btn btn-danger">Sınavı Bitir</button>
                    <a class="btn btn-primary" href="testtable.php">Sınavdan Çık</a>
                </div>
        </div>

    </div>
    <?php
    include_once 'script.php'; ?>
    <?php
} else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
} ?>