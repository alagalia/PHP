<?php

require_once "check_index_usage.php";
require_once "admin_check.php";

$id = (int) $_GET['delete'];

mysqli_query($conn, "DELETE FROM comment WHERE id={$id}");
header("LOCATION: index.php?p=admin_blog");



