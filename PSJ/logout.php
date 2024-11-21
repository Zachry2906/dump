<?php
session_start();

// Hancurkan sesi pengguna
$_SESSION = array();
session_destroy();
session_abort();

// Redirect ke halaman login
header("Location: index.php");
exit();
?>
