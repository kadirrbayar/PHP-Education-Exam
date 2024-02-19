<?php
include_once 'head.php';
?>

<?php if (isset($_SESSION['Id']) && isset($_SESSION['Username']) && isset($_GET['Id'])) { ?>

    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                    <h1 class="welcome-text">Sınav Başladı. <span id="kalanSure" class="text-primary fw-bold"></span>
                    </h1>
                    <h3 class="welcome-sub-text">Sınavınız 45 Dakikadır. Başarılar Dileriz.</h3>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
        <div class="content-wrapper">
            <div class="row">
                <?php
                $id = 1;
                $Id = $_GET['Id'];
                $sorular = $conn->query("SELECT * FROM sptests WHERE Id = $Id")->fetch(PDO::FETCH_ASSOC);
                $test_ids = array_map('intval', explode(',', $sorular['test_id']));
                $questionCount = count($test_ids);
                $examDuration = $questionCount * 2;

                foreach ($test_ids as $test_id) {
                    $tests_query = $conn->prepare("SELECT * FROM tests WHERE Id = ?");
                    $tests_query->execute([$test_id]);
                    if ($tests_query->rowCount() > 0) {
                        $test_record = $tests_query->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title question-title" id="<?php echo $test_record['Id'] ?>">
                                        <?php echo $id . ".Soru" ?>:
                                    </h4>
                                    <div class="table-responsive">
                                        <p style="font-size:medium; font-weight: 400;">
                                            <?php echo htmlspecialchars_decode($test_record['Title']); ?>
                                        </p>
                                        <div class="form-check">
                                            <input type="radio" name="answer_<?php echo $test_record['Id']; ?>"
                                                   value="A"
                                                   data-question-id="<?php echo $test_record['Id']; ?>"> <?php echo $test_record['A']; ?>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="answer_<?php echo $test_record['Id']; ?>"
                                                   value="B"
                                                   data-question-id="<?php echo $test_record['Id']; ?>"> <?php echo $test_record['B']; ?>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="answer_<?php echo $test_record['Id']; ?>"
                                                   value="C"
                                                   data-question-id="<?php echo $test_record['Id']; ?>"> <?php echo $test_record['C']; ?>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="answer_<?php echo $test_record['Id']; ?>"
                                                   value="D"
                                                   data-question-id="<?php echo $test_record['Id']; ?>"> <?php echo $test_record['D']; ?>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="answer_<?php echo $test_record['Id']; ?>"
                                                   value="E"
                                                   data-question-id="<?php echo $test_record['Id']; ?>"> <?php echo $test_record['E']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $id++;
                    }
                } ?>
            </div>
            <button id="finishButton" class="btn btn-danger">Sınavı Bitir</button>
            <a class="btn btn-primary" href="testtable.php">Sınavdan Çık</a>
        </div>
    </div>
    <?php
    include_once 'script.php'; ?>

    <script>
        $(document).ready(function () {
            var totalTime = <?php echo $examDuration ?> *
            60;
            var timerInterval;
            var remainingTime = totalTime;

            function startTimer() {
                timerInterval = setInterval(function () {
                    var minutes = Math.floor(remainingTime / 60);
                    var seconds = remainingTime % 60;
                    var displayTime = minutes + "dk " + seconds + "sn";
                    $(".welcome-sub-text").text("Sınavınız toplam " + minutes + " dakikadır. Yanlışlar doğruları götürmemektedir. Başarılar Dileriz.");
                    $("#kalanSure").text("Kalan Süre : " + displayTime);
                    if (remainingTime <= 0) {
                        clearInterval(timerInterval);
                        finishExam();
                    }
                    remainingTime--;
                }, 1000);
            }

            startTimer();

            $("#finishButton").click(function () {
                clearInterval(timerInterval);
                finishExam();
            });

            function finishExam() {
                var answers = {};
                $("input[type='radio']:checked").each(function () {
                    var questionId = $(this).data("question-id");
                    var selectedAnswer = $(this).val();
                    answers[questionId] = selectedAnswer;
                });
                $("input[type='radio']").prop("disabled", true);
                $.ajax({
                    url: "result.php?Id=<?php echo $Id; ?>",
                    method: "POST",
                    data: {answers: answers},
                    success: function (response) {
                        displayResults(response);
                    },
                    error: function (error) {
                        console.error("Sonuçları post etme hatası:", error);
                    }
                });
            }

            function displayResults(response) {
                var result = JSON.parse(response);
                var correctAnswers = result.correctAnswers;
                var userAnswers = result.userAnswers;
                var correctCount = 0;
                var incorrectCount = 0;

                for (var questionId in correctAnswers) {
                    var questionElement = $("#" + questionId);
                    if (userAnswers.hasOwnProperty(questionId)) {
                        if (userAnswers[questionId] === correctAnswers[questionId]) {
                            correctCount++;
                            questionElement.text(questionElement.text() + " (Doğru)").css("color", "blue");
                        } else {
                            incorrectCount++;
                            questionElement.text(questionElement.text() + " (Yanlış - Doğru Cevap: " + correctAnswers[questionId] + ")").css("color", "red");
                        }
                    } else {
                        questionElement.text(questionElement.text() + " (Yanıt verilmemiş - Doğru Cevap: " + correctAnswers[questionId] + ")").css("color", "gray");
                    }
                }
                $(".welcome-sub-text").text("Sınavınız tamamlandı. Doğru ve yanlışlarınızı kontrol ediniz.");
                $("#kalanSure").text("");
                $(".welcome-text").text("Sınav Bitti. Doğru Sayısı : " + correctCount + " Yanlış Sayısı : " + incorrectCount);
                alert("Doğru sayısı: " + correctCount + "\nYanlış sayısı: " + incorrectCount);

                $.ajax({
                    url: "updatecounts.php",
                    method: "POST",
                    data: {correctCount: correctCount, incorrectCount: incorrectCount, Id: <?php echo $Id; ?> },
                    success: function (response) {
                        console.log("Sptest tablosu güncellendi.");
                    },
                    error: function (error) {
                        console.error("Sptest tablosunu güncelleme hatası:", error);
                    }
                });
            }
        });
    </script>

    <?php
} else {
    header("Location: login.php?error=" . urlencode("Lütfen bu sayfayı görüntülemek için önce oturum açın."));
} ?>