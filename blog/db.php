<?php
$host    = 'localhost';
$user    = 'root';
$pass    = '';
$db_name = 'blogs';

$conn = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $user,$pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);