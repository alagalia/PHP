<?php
require_once "check_index_usage.php";
require_once "logged_check.php";
?>

<!-- Main Content -->
<div class="container">
    <div class="col-lg-8 col-md-10 mx-auto">
        <p>LOGIN FORM</p>
        <form action="index.php?p=login" id="contactForm" novalidate name="users" method="POST">
            <div class="control-group">
                <label>Username: </label>
                <div class="form-group floating-label-form-group controls">
                    <input type="text" name="username"/><br/>
                </div>
            </div>

            <div class="control-group">
                <label>Password:</label>
                <div class="form-group floating-label-form-group controls">
                    <input type="password" name="password"/>   <br/> 
                </div>
            </div>

            <div class="form-group">
                <br>
                <input type="submit" name='login' value="login" />
            </div>
        </form>
    </div>
</div>
<hr>

<?php
if (!$is_user_logged) {
    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hash = $password . '' . $salt;
        $hash = md5($hash);
        $week = time() + 60 * 60 * 24 * 7;

        $result = mysqli_query($conn, "SELECT id, password, name FROM users WHERE username ='{$username}' AND password = '{$hash}'");
        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            $password = $row['password'];
            $pass_hesh = substr($password, 0, 5);
            setcookie("uid", $id, $week);
            setcookie("uneshto", $pass_hesh, $week);
            setcookie("name", $row['name'], $week);
            header("Location: index.php?p=index");
            ?>

            <?php
        } else {
            echo 'USER or pass is INcorrect ';
        }
    }
} else {
    echo "<meta http-equiv='refresh' content='0;url=index.php?p=index'>";
}