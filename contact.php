<?php
require_once 'head.php';
require_once 'preloader.php';
require_once 'sidebar.php';
?>
<main>
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">İletişim</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Ana Sayfa</a></li>
                                        <li class="breadcrumb-item"><a href="#">İletişim</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">İletişime Geç</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="contactpost.php" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" placeholder=" Mesajınız..."></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text" placeholder="Ad Soyad">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email" placeholder="Mail Adresi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text" placeholder="Konu">
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_GET['error'])) { ?>
                            <span class="text-danger"><?php echo $_GET['error']; ?></span>
                            <br><br>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <span class="text-primary"><?php echo $_GET['success']; ?></span>
                            <br><br>
                        <?php } ?>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Mesajı Gönder</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>İstanbul,Bağcılar</h3>
                            <p>Menekşe Sokak No 42</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+90 216 442 42 42</h3>
                            <p>Sabah 8 Akşam 5 Aralığı Müsaittir.</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>info@hkegitim.com</h3>
                            <p>Sorularınız için mail gönderebilirsiniz.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
require_once 'footer.php';
require_once 'script.php';
?>

