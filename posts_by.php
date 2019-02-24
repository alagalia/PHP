<?php
require_once "check_index_usage.php";
require_once "logged_check.php";
?>


<!-- Main Content --> 
<div class="container">
    <?php
    $_GET['category'] = (int) $_GET['category'];
    if (!$_GET['category']) {
        echo "<meta http-equiv='refresh' content='0;url=index.php?p=index'>";
    } else {

        $request = "SELECT posts.id, posts.name, description, aded_by, category.name as 'catname', posts.date FROM posts JOIN category ON posts.category=category.id WHERE category = {$_GET['category']} ORDER BY date DESC ";

        $result = mysqli_query($conn, $request);



        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-preview">
                        <a href="index.php?p=post&post_id=<?php echo $row['id']; ?>">
                            <h2 class="post-title">
                                <?php echo $row['name']; ?>
                            </h2>
                            <h3 class="post-subtitle">
                                <?php echo $row['description']; ?>
                            </h3>
                        </a>
                        <p class="post-meta">Posted by
                            <a href="#"><?php echo "User: " . $row['aded_by']; ?></a>
                            on <?php echo $row['date'] ?>
                        </p>
                        <p class="post-meta">
                            <?php echo "Category: " . $row['catname']; ?>
                        </p>
                        <?php
                        if ($is_admin_logged) {
                            ?>
                            <p>
                                <span style="display: inline-block;"> <a href="index.php?p=admin_blog&edit=<?php echo $row['id']; ?>">Редактирай</a>
                                    <span > <a href="index.php?p=admin_blog&delete=<?php echo $row['id']; ?>">Изтрий</a></span>
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                    <hr>

                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

<hr>