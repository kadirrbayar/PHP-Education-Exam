<?php
$sql = "SELECT COUNT(*) AS count FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $result['count'];

$sql2 = "SELECT COUNT(*) AS count FROM tests";
$stmk = $conn->prepare($sql2);
$stmk->execute();
$result2 = $stmk->fetch(PDO::FETCH_ASSOC);
$count2 = $result2['count'];


$sql3 = "SELECT COUNT(*) AS count FROM books";
$stmr = $conn->prepare($sql3);
$stmr->execute();
$result3 = $stmr->fetch(PDO::FETCH_ASSOC);
$count3 = $result3['count'];

$sql4 = "SELECT COUNT(*) AS count FROM message";
$stmd = $conn->prepare($sql4);
$stmd->execute();
$result4 = $stmd->fetch(PDO::FETCH_ASSOC);
$count4 = $result4['count'];

?>

<div class="row m-t-25">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c1">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-account"></i>
                    </div>
                    <div class="text">
                        <h2><?php echo $count ?></h2>
                        <span>Toplam Öğrenci Sayısı</span>
                    </div>
                </div>
                <div class="overview-chart">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c2">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-bookmark"></i>
                    </div>
                    <div class="text">
                        <h2><?php echo $count2 ?></h2>
                        <span>Toplam Soru Sayısı</span>
                    </div>
                </div>
                <div class="overview-chart">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c3">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-book"></i>
                    </div>
                    <div class="text">
                        <h2><?php echo $count3 ?></h2>
                        <span>Toplam Soru Bankaları</span>
                    </div>
                </div>
                <div class="overview-chart">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c4">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-inbox"></i>
                    </div>
                    <div class="text">
                        <h2><?php echo $count4 ?></h2>
                        <span>Gelen Mesaj Sayısı</span>
                    </div>
                </div>
                <div class="overview-chart">
                </div>
            </div>
        </div>
    </div>
</div>