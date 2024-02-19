<?php
$sql3 = "SELECT COUNT(*) AS count FROM books";
$stmr = $conn->prepare($sql3);
$stmr->execute();
$result3 = $stmr->fetch(PDO::FETCH_ASSOC);
$count3 = $result3['count'];
?>
<main>
    <section class="slider-area ">
        <div class="slider-active">
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-12">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay="0.2s">Online<br>Sınav<br>Platformu</h1>
                                <p data-animation="fadeInLeft" data-delay="0.4s">Bizimle, öğrenme deneyiminizi
                                    kişiselleştirerek hedeflerinize ulaşmanın keyfini çıkarabilirsiniz. Sitemizde
                                    bulunan geniş soru bankaları sayesinde kendi testlerinizi oluşturabilir ve
                                    istediğiniz derslere ait soruları seçerek öğrenme sürecinizi
                                    güçlendirebilirsiniz.</p>
                                <a href="StudentPanel/register.php" class="btn hero-btn" data-animation="fadeInLeft"
                                   data-delay="0.7s">Şimdi Kayıt Ol</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="services-area">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="assets/img/icon/icon1.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3><?php echo $count3; ?> Soru Bankası</h3>
                            <p>Kendi sınavlarınızı oluşturun ve öğrenme sürecinizi kontrol edin.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="assets/img/icon/icon2.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Geniş Ders Kapsamı</h3>
                            <p>Binlerce soru arasından istediğiniz dersi seçin.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="assets/img/icon/icon3.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Esneklik ve Kolay Kullanım</h3>
                            <p>Her yerden erişilebilir, kullanıcı dostu bir platform.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="courses-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Popüler Kaynaklarımız</h2>
                    </div>
                </div>
            </div>
            <div class="courses-actives">
                <?php $sorubankasi = $conn->query("SELECT * FROM books")->fetchAll();
                foreach ($sorubankasi as $item) { ?>
                    <div class="properties pb-20">
                        <div class="properties__card">
                            <div class="properties__img overlay1">
                                <a href="#"><img src="<?php echo $item['ImageUrl'] ?>" style="height: 360px; width: 359px;" alt=""></a>
                            </div>
                            <div class="properties__caption">
                                <p><?php echo $item['Present'] ?></p>
                                <h3><a href="#"><?php echo $item['Title'] ?></a></h3>
                                <a href="#" class="border-btn border-btn2">Şimdi Keşfet</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <section class="about-area3 fix">
        <div class="support-wrapper align-items-center">
            <div class="right-content3">
                <div class="right-img">
                    <img src="assets/img/gallery/about3.png" alt="">
                </div>
            </div>
            <div class="left-content3">
                <div class="section-tittle section-tittle2 mb-20">
                    <div class="front-text">
                        <h2 class="">Kazanımlarınız</h2>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Sitemiz, kullanıcılara kendi testlerini oluşturma ve derslere özel soru bankalarından seçim
                            yapma imkanı sunarak öğrenme deneyimini kişiselleştirmelerine olanak tanır.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Platformumuz, çeşitli dersler için geniş bir soru bankası sunar. Kullanıcılar, matematikten
                            edebiyata, fen bilimlerinden sosyal bilimlere kadar birçok konuda zengin içeriklere
                            erişebilirler.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Kullanıcılar, çözdükleri testler ve sorular üzerinden anlık geri bildirim alabilirler. Doğru
                            ve yanlış cevaplarını görmek, eksik oldukları konuları belirlemelerine yardımcı olur.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="team-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Eğitmenlerimiz</h2>
                    </div>
                </div>
            </div>
            <div class="team-active">
                <?php $sorubankasi = $conn->query("SELECT * FROM admins")->fetchAll();
                foreach ($sorubankasi as $item) {
                ?>
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="assets/img/gallery/team1.png" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="#"><?php echo $item['Name'] ?></a></h5>
                        <p><?php echo $item['Mail'] ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="about-area2 fix pb-padding">
        <div class="support-wrapper align-items-center">
            <div class="right-content2">
                <div class="right-img">
                    <img src="assets/img/gallery/about2.png" alt="">
                </div>
            </div>
            <div class="left-content2">
                <div class="section-tittle section-tittle2 mb-20">
                    <div class="front-text">
                        <h2 class="">Hemen Başlayın, Bilgiye Yolculuğunuz Sadece Bir Adım Uzakta!</h2>
                        <p>Eğitimde yeni bir döneme adım atmak için hemen kaydolun ve öğrenme deneyiminizi
                            kişiselleştirin. Soru bankalarımız arasından istediğiniz dersleri seçerek kendi testlerinizi
                            oluşturun. Esneklik ve özelleştirilebilirlikle dolu bu platformda, başarıya giden yolda ilk
                            adımı atın. Hemen üye olun ve bilgiye açılan kapıları aralayın!</p>
                        <a href="#" class="btn">Kayıt Ol</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>