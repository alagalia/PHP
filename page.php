<?php

require_once "check_index_usage.php";
if (!isset($_GET['p'])) {
    $_GET['p'] = 'home';
}

switch ($_GET['p']) {
    case 'home':
        include_once 'home.php';
        break;
    case 'index':
        include_once 'home.php';
        break;
    case 'register':
        include_once 'register.php';
        break;
    case 'login':
        include_once 'login.php';
        break;
    case 'admin':
        include_once 'admin.php';
        break;
    case 'logout':
        include_once 'logout.php';
        break;
    case 'post':
        include_once 'post.php';
        break;
    case 'post_add':
        include_once 'post_add.php';
        break;
    case 'posts_all':
        include_once 'posts_all.php';
        break;
    case 'comment_add':
        include_once 'comment_add.php';
        break;
    case 'admin_blog':
        include_once 'admin_blog.php';
        break;
    case 'posts_by':
        include_once 'posts_by.php';
        break;
    default:
        include_once '404.php';
        break;
}
?>