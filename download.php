<?php
include 'FileHandlerClass.php';
session_start();
$title=$_GET['id'];
$fileDownloader= DownloadHandler::getInistance($_SESSION['folder'], $title);
$fileDownloader->DownloadFile();

	?>