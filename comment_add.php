<?php
require_once "check_index_usage.php";
require_once 'logged_check.php';
if(!$is_user_logged){
header("Location: index.php?p=index");
}
?>
<form action="index.php?p=comment_add&post_id=<?php echo $_GET['post_id']; ?>" name="edit_blog" method="POST" enctype="multipart/form-data" >

    <label>Comment text</label>
    <textarea name='content' rows="4" cols="50"></textarea>
    <input type="submit" name="send" value="Send" />
</form>
<?php
if (isset($_POST['send'])){
$content = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['content']));
$user_id="'".$_COOKIE['uid']."'";
$post_id="'".$_GET['post_id']."'";

$request = "INSERT INTO comments (content, user, post) VALUES('{$content}', $user_id, $post_id)";

echo $request;
    $content = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['content']));

    $result = mysqli_query($conn, $request);
    if ($result) {
        header("Location: index.php?p=post&post_id={$_GET['post_id']}");
    } else {
        echo 'Sorry, request has not done!';
    }
}



