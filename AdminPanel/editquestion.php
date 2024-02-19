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
                    <div class="col-lg-14">
                        <div class="card">
                            <div class="card-header">Soru Düzenleme Menüsü</div>
                            <div class="card-body card-block">
                                <?php
                                    $id = $_GET['Id'];
                                    $selectedQuery = $conn->prepare("SELECT * FROM tests WHERE Id = ?");
                                    $selectedQuery->execute([$id]);
                                    $selectedRow = $selectedQuery->fetch(PDO::FETCH_ASSOC);
                                    if ($selectedRow !== null) {
                                ?>
                                <form action="postquestion.php?Id=<?php echo $selectedRow['Id'] ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="textarea-input" class=" form-control-label">Soru İçeriği</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea name="title" id="textarea-input" rows="9" class="form-control"><?php echo $selectedRow['Title'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">A Seçeneği</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="A" value="<?php echo $selectedRow['A'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">B Seçeneği</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="B" value="<?php echo $selectedRow['B'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">C Seçeneği</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="C" value="<?php echo $selectedRow['C'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">D Seçeneği</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="D" value="<?php echo $selectedRow['D'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">E Seçeneği</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="E" value="<?php echo $selectedRow['E'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Doğru Cevap</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="correct" id="select" class="form-control">
                                                <?php
                                                $correct = $selectedRow['Correct'];
                                                $options = ['A', 'B', 'C', 'D', 'E'];
                                                foreach ($options as $option) {
                                                    $selected = ($correct == $option) ? 'selected' : '';
                                                    echo "<option value=\"$option\" $selected>$option</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Soru Bankası</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="bank" id="select" class="form-control">
                                                <?php
                                                $selectedId = $selectedRow['Id'];
                                                $selectedTitle = $selectedRow['Title'];
                                                $query = $conn->query("SELECT Id, Title FROM books");
                                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                    $id = $row['Id'];
                                                    $title = $row['Title'];
                                                    $selected = ($selectedId == $id && $selectedTitle == $title) ? 'selected' : '';
                                                    echo "<option value=\"$id\" $selected>$title</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if (isset($_GET['error'])) { ?>
                                        <span class="text-danger"><?php echo $_GET['error']; ?></span>
                                        <br><br>
                                    <?php } ?>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-save"></i> Güncelle
                                    </button>
                                    <a href="questionbank.php" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> İptal
                                    </a>
                                </form>
                                <?php } ?>
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

