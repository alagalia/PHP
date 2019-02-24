<?php
require_once "check_index_usage.php";
require_once "admin_check.php";

if ($is_admin_logged) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="post-title">EDIT POST</h2>
                <div style="border: cadetblue double 5px; padding: 15px">
                    <form action="index.php?p=admin_blog&edit=<?php echo $_GET['edit']; ?>" name="edit_blog" method="POST" enctype="multipart/form-data" >
                        <?php
                        $_GET['edit'] = (int) $_GET['edit'];
                        $result = mysqli_query($conn, "SELECT * FROM posts WHERE id={$_GET['edit']}");
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                            <br>
                            <div class="control-group">
                                <label>Title: </label>
                                <div>
                                    <input type="text" name="name" value="<?php echo $row['name']; ?>" />
                                </div>
                            </div>

                            <br>
                            <div class="control-group">
                                <label>Content:</label>       
                                <div>
                                    <textarea name='content' rows="4" cols="50"><?php echo $row['content']; ?></textarea>
                                </div>
                            </div>

                            <br>
                            <div class="control-group">
                                <label>Категория</label>
                                <div>
                                    <?php
                                    $result_category = mysqli_query($conn, "SELECT * FROM category");
                                    if (mysqli_num_rows($result_category) > 0):
                                        ?>
                                        <select name="category">
                                            <?php
                                            while ($row_category = mysqli_fetch_assoc($result_category)):
                                                ?>
                                                <option value="<?php echo $row_category['id']; ?>" 
                                                <?php
                                                echo ($row['category'] == $row_category['id'] ? 'selected' : '');
                                                ?> >
                                                    <?php echo $row_category['name']; ?></option>
                                            <?php endwhile;
                                            ?>
                                        </select>
                                        <?php
                                    endif;
                                    ?>
                                    <input type="hidden" name="kachen_fail" value="<?php echo $row['picture']; ?>">
                                    <?php
                                }
                                ?>
                            </div> 
                        </div>

                        <br>
                        <div class="control-group">
                            <label>Picture</label>
                            <div>
                                <input type="file" name="file_za_kachvane">
                            </div>
                        </div>
                        <br>
                        <div class="control-group" >
                            <input type="submit" name="send_edit" value="Send" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>               

    <?php
    if (isset($_POST['send_edit'])) {
        $id = $_GET['edit'];
        $name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['name']));
        $content = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['content']));
        $category = (int) htmlspecialchars(mysqli_real_escape_string($conn, $_POST['category']));
        if ($_FILES["file_za_kachvane"]["name"] == '') {

            if ($category != 0) {
                $result = mysqli_query($conn, "UPDATE posts SET name='{$name}', content='{$content}', category='{$category}' WHERE id={$id}");
                if ($result) {
                    echo '<div class="alert alert-primary alert-fixed">Post was upadated successfull!</div>';
                    echo "<meta http-equiv='refresh' content='3;url=index.php?p=post&post_id={$id}'>";
                } else {
                    echo ':/';
                }
            }
        } else {

            $target_dir = "blog_pics/";
            $target_name = uniqid() . basename($_FILES["file_za_kachvane"]["name"]);
            $target_file = $target_dir . $target_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            move_uploaded_file($_FILES["file_za_kachvane"]["tmp_name"], $target_file);

            if ($category != 0) {
                $result = mysqli_query($conn, "UPDATE posts SET name='{$name}', category='{$category}', picture='{$target_name}'  WHERE id={$id}");
                if ($result) {
                    echo 'Post was upadated successfull!';
                } else {
                    echo ':/';
                }
            }
        }
    }
} else {
    echo "<meta http-equiv='refresh' content='3;url=index.php?p=index'>";
}