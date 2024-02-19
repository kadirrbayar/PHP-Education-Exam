<ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown d-none d-lg-block">
        <a href="questiontable.php" class="btn btn-primary text-white me-0"><i class="icon-basket"></i> Soru Sepeti</a>
    </li>
    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['Name']; ?></p>
                <p class="fw-light text-muted mb-0"><?php echo $_SESSION['Mail']; ?></p>
            </div>
            <a class="dropdown-item" href="profile.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Profilim</a>
            <a class="dropdown-item" href="../logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i> Oturumu Kapat </a>
        </div>
    </li>
</ul>