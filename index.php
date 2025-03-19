<?php

if (!isset($_SESSION)) {
    session_start();
}
ob_start(); // Bắt đầu bộ đệm đầu ra


include './models/pdo.php';
include './views/header.php';


include './views/footer.php';


ob_end_flush();
