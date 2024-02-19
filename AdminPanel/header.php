<div class="header-wrap">
    <div class="header-button">
        <div class="account-wrap">
            <div class="account-item clearfix js-item-menu">
                <div class="image">
                    <img src="../assets/images/icon/avatar-01.jpg" />
                </div>
                <div class="content">
                    <a class="js-acc-btn" href="#"><?php echo $_SESSION['Name']; ?></a>
                </div>
                <div class="account-dropdown js-dropdown">
                    <div class="info clearfix">
                        <div class="image">
                            <a href="#">
                                <img src="../assets/images/icon/avatar-01.jpg" />
                            </a>
                        </div>
                        <div class="content">
                            <h5 class="name">
                                <a href="profile.php"><?php echo $_SESSION['Name']; ?></a>
                            </h5>
                            <span class="email"><?php echo $_SESSION['Mail']; ?></span>
                        </div>
                    </div>
                    <div class="account-dropdown__body">
                        <div class="account-dropdown__item">
                            <a href="profile.php">
                                <i class="zmdi zmdi-settings"></i>Profil Ayarları</a>
                        </div>
                    </div>
                    <div class="account-dropdown__footer">
                        <a href="../logout.php">
                            <i class="zmdi zmdi-power"></i>Çıkış Yap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
