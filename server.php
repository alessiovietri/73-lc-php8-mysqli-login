<?php

/**
 * La password di default è appunto password
 */

function login($username, $password, $conn)
{
    // verifico se la sessione è già stata avviata
    // https://www.php.net/manual/en/function.session-status.php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    $md5password = md5($password);

    $stmt = $conn->prepare("SELECT `id`, `username` FROM `users` WHERE `username` = ? and `password` = ?");
    $stmt->bind_param('ss', $username, $md5password);

    $stmt->execute();

    $result = $stmt->get_result();

    $num_rows = $result->num_rows;

    if ($num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['userId'] = $row['id'];
        $_SESSION['username'] = $row['username'];
    } else {
        $_SESSION['userId'] = 0;
        $_SESSION['username'] = '';
    }

    /**
     * Senza prepared statement ci esponiamo al rischio di atticchi di tipo SQL Injection
     * 
     * Ad esempio un utente malintenzionato potrebbe usare questa stringa come username ed ottenere l'accesso alla piattaforma
     * ' OR 1 = 1; #
     * o provare addirittura ad accedere come admin
     * admin'; #
     * 
     * Se avessimo abilitato l'esecuzione multi query
     * $result = $conn->multi_query
     * un utente potrebbe addirittura inserire del codice che va a cancellare il contenuto delle nostre tabelle
     * '; delete from `sensitive_data`; #
     */

    /*$sql = "SELECT `id`, `username` FROM `users` WHERE `username` = '" . $username . "' and `password` = '" . $md5password . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['userId'] = $row['id'];
        $_SESSION['username'] = $row['username'];
    } else {
        $_SESSION['userId'] = 0;
        $_SESSION['username'] = '';
    }*/

    session_write_close();
}
