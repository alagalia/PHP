<?php

$is_user_logged = false;
$is_admin_logged = false;

if (isset($_COOKIE['uid'])) {
    //ако има куки 
    $_COOKIE['uid'] = (int) $_COOKIE['uid'];
    $result = mysqli_query($conn, "SELECT id, password FROM users WHERE id={$_COOKIE['uid']}");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        //проверява дали има потребител с това куки
        if ($row['id'] == $_COOKIE['uid']) {
            //проверява дали съвпадат паролите
            $pass_hesh = substr($row['password'], 0, 5);
            if ($pass_hesh != $_COOKIE['uneshto']) {
                //password incorect 
                header("Location: index.php?p=login");
            } else if($row['id']==3)
            {
                $is_user_logged = true;//сетваме го заради  проверка в header
                $is_admin_logged = true;
            } else {
                $is_user_logged = true; // дава възможност да коментира
            }
        } else {
            header("Location: index.php?p=login");
        }
    } else {
        header("Location: index.php?p=login");
    }
}