<div class="row">
    <div class="col-lg-12">
        <h2 class="title-1 m-b-25">En Çok Test Çözen Öğrenciler</h2>
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                <tr>
                    <th>Adı Soyadı</th>
                    <th>Mail</th>
                    <th>Kullanıcı Adı</th>
                    <th class="text-right">Toplam Test</th>
                    <th class="text-right">Doğru Sayısı</th>
                    <th class="text-right">Yanlış Sayısı</th>
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
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>