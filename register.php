<?php
require_once "check_index_usage.php";
require_once "logged_check.php";

if (!$is_user_logged) {
    ?>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p>REGISTER FORM</p>

                <form action="index.php?p=register" id="contactForm" novalidate name="users" method="POST">
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

                    <div class="control-group">
                        <label>Confirm password:</label>
                        <div class="form-group floating-label-form-group controls">
                            <input type="password" name="confirm_password"/><br/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label>Name:</label>
                        <div class="form-group floating-label-form-group controls">
                            <input type="text" name="first_name" text="first_name"/><br/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label>Last name:</label>
                        <div class="form-group floating-label-form-group controls">
                            <input type="text" name="last_name" text="last_name"/><br/>
                        </div>
                    </div>

                    <div class="form-group">
                        <br>
                        <input type="submit" name='submit' value="submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];

        $problems = 0;
        $errors = [];

        if ($username == '' || $username == NULL) {
            $problems = 1;
            $errors[] = "Insert username please!";
        }

        if ($password == '' || $password == NULL) {
            $problems = 1;
            $errors[] = "Insert password please!";
        } else {
            if ($password != $confirm_password) {
                $problems = 1;
                $errors[] = "Passwords dont match!";
            }
        }

        $checkUserExist_query = mysqli_query($conn, "SELECT id FROM users  WHERE username = '{$username}'");
        if (mysqli_num_rows($checkUserExist_query) > 0) {
            $problems = 1;
            $errors[] = "Username already exist!";
        }

        if ($problems == 0) {
            $query = "INSERT INTO users (username, password, name, last_name) "
                    . "VALUES('" . $username . "', '" . md5($password . '' . $salt) . "', '" . $first_name . "', '" . $last_name . "')";
            $result = mysqli_query($conn, $query);
            echo "<meta http-equiv='refresh' content='0;url=index.php?p=login'>";
        } else {
            foreach ($errors as $err) {
                echo $err . '</br>';
            }
        }
    }
} else {

    header("Location: index.php?p=index");
}
        