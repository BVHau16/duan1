<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo/logo.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo/logo.png" alt="" height="70">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo/logo.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo/logo.png" alt="" height="70">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Tuấn Anh</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome Tuấn Anh</h6>
            <a class="dropdown-item" href="auth-logout-basic.html"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">


            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Quản lý</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=list_account" >
                    <i class="ri-user-line"></i><span data-key="t-advance-ui">Quản lý khách hàng</span>
                    </a>
                    <a class="nav-link menu-link" href="index.php?act=lisdm" >
                    <i class="ri-file-list-2-fill"></i><span >Danh mục</span>
                    </a>
                    <a class="nav-link menu-link" href="index.php?act=listsp" >
                        <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Danh sách sản phẩm</span>
                    </a>
                    <a class="nav-link menu-link" href="index.php?act=admin_donhang" >
                    <i class="ri-shopping-cart-2-line"></i><span data-key="t-advance-ui">Quản lý đơn hàng</span>
                    </a>
                    <a class="nav-link menu-link" href="index.php?act=listspcomment" >
                    <i class="ri-message-2-line"></i> <span data-key="t-advance-ui">Quản lý bình luận</span>
                    </a>
               
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>