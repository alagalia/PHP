<?php
require_once "check_index_usage.php";
require_once "admin_check.php";
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h2 class="post-title">ADD POST</h2>
            <div style="border: cadetblue double 5px; padding: 15px">
                <form action="index.php?p=admin_blog" name="add_blog" method="POST" enctype="multipart/form-data">
                    <div class="control-group">
                        <label>Title: </label>
                        <div>
                            <input type="text" name="name"/><br/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label>Category:</label>
                        <div>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM category");
                            if (mysqli_num_rows($result) > 0):
                                ?>
                                <select name="category">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php endwhile;
                                    ?>
                                </select>
                            <?php endif;
                            ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label>Description:</label>
                        <div>
                            <textarea name='description' rows="2" cols="50"></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label>Picture:</label>
                        <div>
                            <input type="file" name="file_za_kachvane">
                        </div>
                    </div>

                    <div class="control-group">
                        <label>Youtube code:</label>
                        <div>
                            <input type="text" name="youtube" /><br/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label>Content:</label>
                        <div>
                            <textarea name='content' rows="4" cols="50"></textarea>
                            <br/>
                        </div>
                    </div>

                    <div class="form-group">
                        <br>
                        <input class="btn btn-primary" type="submit" name="send" value="Send" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<?php
if (isset($_POST['send'])) {
    $name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['name']));
    $category = (int) htmlspecialchars(mysqli_real_escape_string($conn, $_POST['category']));
    $description = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['description']));
    $target_dir = "blog_pics/";
    $picture = uniqid() . basename($_FILES["file_za_kachvane"]["name"]);
    $target_file = $target_dir . $picture;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["file_za_kachvane"]["tmp_name"], $target_file);

    $youtube = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['youtube']));
    $content = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['content']));


    if ($category != 0) {
        $request = "INSERT INTO `posts`(`name`, `category`, `description`, `picture`, `youtube`, `content`, `aded_by`) 
                   VALUES ('{$name}',{$category},'{$description}','{$picture}','{$youtube}','{$content}',{$_COOKIE['uid']})";
        $result = mysqli_query($conn, $request);
        if ($result) {
            echo "<meta http-equiv='refresh' content='0;url=index.php?p=index'>";
        } else {
            echo ':/';
        }
    }
}



