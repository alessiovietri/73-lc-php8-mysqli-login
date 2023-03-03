<?php
// verifico se la sessione è già stata avviata
// https://www.php.net/manual/en/function.session-status.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['logout']) && $_POST['logout'] === '1') {
    session_destroy();
    header("location: index.php?logout=success");
}
