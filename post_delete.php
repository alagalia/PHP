<?php

require_once "check_index_usage.php";
require_once "admin_check.php";

$id = (int) $_GET['delete'];


$result = mysqli_query($conn, "SELECT picture FROM posts WHERE id={$id}");
$row = mysqli_fetch_assoc($result);
$file = "blog_pics/" . $row['picture'];
unlink($file);
mysqli_query($conn, "DELETE FROM posts WHERE id={$id}");
header("LOCATION: index.php?p=admin_blog");



