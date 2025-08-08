<?php
include('functions.php');

$id=$_GET['NIM'];
$is_approved=$_GET['is_approved'];

$q = "update tahapan set is_approved=$is_approved where NIM=$id";

mysqli_query($db, $q)

header(location:'login.php');
?>