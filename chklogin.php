<?php

include "setting.php";
include "framework/emenudmenu.php";

unset($_SESSION[$GLOBALS['fw_sistem']]['username']);

if (isset($_SESSION['userData']['email'])) {
    $username = $_SESSION['userData']['email'];
} elseif (isset($_SESSION['userData']['upmid'])) {
    $username = $_SESSION['userData']['upmid'];
} elseif (isset($_POST['user']) and isset($_POST['pass'])) {
    # check login table here
    if ($_POST['user'] == 'admin' and $_POST['pass'] == 'xs2admin') {
        $username = $_POST['user'];
    } else {
        alert('Maklumat log masuk tidak sah');
    }
}

if (in_array(@$_SESSION[$GLOBALS['fw_sistem']]['superadmin'], $GLOBALS['fw_superadmin'])) {
    $username = @$_POST['username'];
    $usernow = $_SESSION[$GLOBALS['fw_sistem']]['superadmin'];
    $chguser = 1;
}

if (isset($username)) {
    # buat sql untuk semak peranan pengguna 
    $pengguna = array('email' => 'admin', 'name' => 'Administrator', 'role' => '1');
    if (is_array($pengguna)) {
        $_SESSION[$GLOBALS['fw_sistem']] = array("username" => $pengguna['email'],
            "nama" => $pengguna['name'],
            "peranan" => $pengguna['role']);

        if (@$chguser == '') {
            if (in_array($username, $GLOBALS['fw_superadmin'])) {
                $_SESSION[$GLOBALS['fw_sistem']]['superadmin'] = $username;
            }
        } else if (@$chguser == 1) {
            $_SESSION[$GLOBALS['fw_sistem']]['superadmin'] = $usernow;
        }
        gopage("action.do");
    } else {
        alert('Pengguna tidak wujud');
        gopage("logout.php", 3);
    }
} else {
    gopage("logout.php");
}
?>
        