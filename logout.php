<?php
session_start();
session_destroy();
header('Location: Welcome_page.php');
?>

