<?php
include_once 'head.php';
?>

<?php if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) { ?>

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
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                         aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <?php
                                                    $userId = $_SESSION['Id'];

                                                    $stmt = $conn->query("SELECT COUNT(*) FROM books");
                                                    $count = $stmt->fetchColumn();

                                                    $stmk = $conn->prepare("SELECT SUM(Correct) FROM sptests WHERE user_id = :user_id");
                                                    $stmk->bindParam(':user_id', $userId, PDO::PARAM_INT);
                                                    $stmk->execute();
                                                    $totalCorrect = $stmk->fetchColumn();
                                                    $totalCorrect = ($totalCorrect !== null) ? $totalCorrect : 0;

                                                    $stmz = $conn->prepare("SELECT SUM(Wrong) FROM sptests WHERE user_id = :user_id");
                                                    $stmz->bindParam(':user_id', $userId, PDO::PARAM_INT);
                                                    $stmz->execute();
                                                    $totalWrong = $stmz->fetchColumn();
                                                    $totalWrong = ($totalWrong !== null) ? $totalWrong : 0;

                                                    $totalTest = $conn->query("SELECT COUNT(*) FROM sptests where user_id = $userId");
                                                    $totalResult = $totalTest->fetchColumn();

                                                    $stmr = $conn->prepare("SELECT GROUP_CONCAT(DISTINCT test_id) as testIds FROM sptests WHERE user_id = :user_id");
                                                    $stmr->bindParam(':user_id', $userId, PDO::PARAM_INT);
                                                    $stmr->execute();
                                                    $result2 = $stmr->fetch(PDO::FETCH_ASSOC);
                                                    $testIds = $result2['testIds'];
                                                    $numberOfTests = 0;
                                                    if ($testIds !== null) {
                                                        $testIdArray = explode(',', $testIds);
                                                        $numberOfTests = count($testIdArray);
                                                    }

                                                    ?>
                                                    <div>
                                                        <p class="statistics-title">Toplam Soru Sayısı</p>
                                                        <h3 class="rate-percentage"><?php echo $numberOfTests; ?></h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Tüm Soru Bankaları</p>
                                                        <h3 class="rate-percentage"><?php echo $count; ?></h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Toplam Test Sayısı</p>
                                                        <h3 class="rate-percentage"><?php echo $totalResult; ?></h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Doğru Sayısı</p>
                                                        <h3 class="rate-percentage"><?php echo $totalCorrect; ?></h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Yanlış Sayısı</p>
                                                        <h3 class="rate-percentage"><?php echo $totalWrong; ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                                    <h4 class="card-title card-title-dash">
                                                                        Testlerim</h4>
                                                                </div>
                                                                <ul class="bullet-line-list">
                                                                    <?php $id = $_SESSION['Id'];
                                                                    $test = $conn->query("SELECT * FROM sptests WHERE user_id = $id LIMIT 7")->fetchAll();
                                                                    foreach ($test as $item) {
                                                                        $testIds = explode(',', $item['test_id']);
                                                                        $numberOfTests = count($testIds);
                                                                        ?>
                                                                        <li>
                                                                            <div class="d-flex justify-content-between">
                                                                                <div>
                                                                                    <span class="text-light-green"><?php echo $item['Title']; ?></span>
                                                                                </div>
                                                                                <p><?php echo $numberOfTests; ?>
                                                                                    Soru</p>
                                                                            </div>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <div class="list align-items-center pt-3">
                                                                    <div class="wrapper w-100">
                                                                        <p class="mb-0">
                                                                            <a href="testtable.php"
                                                                               class="fw-bold text-primary">Tüm testleri
                                                                                gör...
                                                                                <i class="mdi mdi-arrow-right ms-2"></i></a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <h4 class="card-title card-title-dash">
                                                                                Etkinlikler</h4>
                                                                        </div>
                                                                        <div class="list-wrapper">
                                                                            <ul class="todo-list todo-list-rounded">
                                                                                <?php $event = $conn->query("SELECT * FROM event")->fetchAll();
                                                                                foreach ($event as $item) { ?>
                                                                                    <li class="d-block">
                                                                                        <div class="form-check w-100">
                                                                                            <label class="form-check-label">
                                                                                                <input class="checkbox" type="checkbox">
                                                                                                <?php echo $item['Description']; ?>
                                                                                                 <i class="input-helper rounded"></i>
                                                                                            </label>
                                                                                            <div class="d-flex mt-2">
                                                                                                <div class="ps-4 text-small me-3">
                                                                                                    <?php
                                                                                                    $dateTime = new DateTime($item['Date']);
                                                                                                    $formattedDateTime = $dateTime->format('d/m/y');
                                                                                                    echo $formattedDateTime;
                                                                                                    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                <?php } ?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include_once 'footer.php';
                ?>
            </div>
        </div>
    </div>
    <?php
    include_once 'script.php';
} else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
} ?>

