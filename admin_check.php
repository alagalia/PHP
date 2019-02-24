<?php

require_once 'logged_check.php';
if (!$is_admin_logged) {
    echo "<meta http-equiv='refresh' content='0;url=index.php?p=index'>";
}