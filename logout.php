<?php

setcookie("uid", "", time() - 3600);
setcookie("uneshto", "", time() - 3600);
setcookie("name", "", time() - 3600);
$is_user_logged = false;
$is_admin_logged = false;

echo "<meta http-equiv='refresh' content='0;url=index.php?p=index'>";

