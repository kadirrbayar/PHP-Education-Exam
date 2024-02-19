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
                        <h3 class="title-5 m-b-35">Öğrenci Bilgileri</h3>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                <tr>
                                    <th>Ad Soyad</th>
                                    <th>Mail</th>
                                    <th>Kullanıcı Adı</th>
                                    <th>Test Sayısı</th>
                                    <th>Doğru Sayısı</th>
                                    <th>Yanlış Sayısı</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $users = $conn->query("SELECT * FROM users")->fetchAll();
                                foreach ($users as $item) {
                                    $id = $item['Id'];
                                    $totalTest = $conn->query("SELECT COUNT(*) FROM sptests where user_id = $id");
                                    $totalResult = $totalTest->fetchColumn();

                                    $stmk = $conn->prepare("SELECT SUM(Correct) FROM sptests WHERE user_id = :user_id");
                                    $stmk->bindParam(':user_id', $id, PDO::PARAM_INT);
                                    $stmk->execute();
                                    $totalCorrect = $stmk->fetchColumn();
                                    $totalCorrect = ($totalCorrect !== null) ? $totalCorrect : 0;

                                    $stmz = $conn->prepare("SELECT SUM(Wrong) FROM sptests WHERE user_id = :user_id");
                                    $stmz->bindParam(':user_id', $id, PDO::PARAM_INT);
                                    $stmz->execute();
                                    $totalWrong = $stmz->fetchColumn();
                                    $totalWrong = ($totalWrong !== null) ? $totalWrong : 0;
                                    ?>
                                    <tr>
                                        <td><?php echo $item['Name']; ?></td>
                                        <td><?php echo $item['Mail']; ?></td>
                                        <td><?php echo $item['Username']; ?></td>
                                        <td><?php echo $totalResult ?></td>
                                        <td><?php echo $totalCorrect ?></td>
                                        <td><?php echo $totalWrong ?></td>
                                        <td>
                                            <a href="deletestudents.php?Id=<?php echo $item['Id']; ?>" class="btn btn-outline-primary btn-sm" title="Sil">
                                                <i class="zmdi zmdi-delete"></i>
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

