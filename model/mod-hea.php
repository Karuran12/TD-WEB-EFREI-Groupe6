<?php
include_once 'bdd.php'; 
$isConnected = isset($_SESSION['user']);
$userAvatar = $isConnected ? $_SESSION['user']['avatar'] : 'photos/avatar1.png';
?>