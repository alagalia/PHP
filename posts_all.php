<?php
require_once "check_index_usage.php";
require_once "logged_check.php";
?>
<!-- Main Content --> 
<div class="container">
    <!-- Pager -->
    <div class="clearfix">
        <div>
            <?php
            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 5;
            $offset = ($pageno - 1) * $no_of_records_per_page;

            // Check connection
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                die();
            }

            $total_pages_sql = "SELECT COUNT(*) FROM posts";
            $result = mysqli_query($conn, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);

            $sql = "SELECT posts.id, posts.name, description, aded_by, category.name as 'catname', posts.date
                            FROM posts 
                            JOIN category 
                            ON posts.category=category.id 
                            ORDER BY date DESC LIMIT $offset, $no_of_records_per_page";

            $res_data = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($res_data)) {
                ?>
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
                        </p
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
                <?php
            }
            ?>
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="pagination">
                    <li class="btn"><a href="index.php?p=posts_all&pageno=1">First</a></li>
                    <li class="btn" <?php
                    if ($pageno <= 1) {
                        echo 'disabled';
                    }
                    ?>> 
                        <a href="<?php
                        if ($pageno <= 1) {
                            echo 'index.php?p=posts_all';
                        } else {
                            echo "index.php?p=posts_all&pageno=" . ($pageno - 1);
                        }
                        ?>">Prev</a>
                    </li>
                    <li class="btn"<?php
                    if ($pageno >= $total_pages) {
                        echo 'disabled';
                    }
                    ?>>
                        <a href="<?php
                        if ($pageno >= $total_pages) {
                            echo 'index.php?p=posts_all';
                        } else {
                            echo "index.php?p=posts_all&pageno=" . ($pageno + 1);
                        }
                        ?>">Next</a>
                    </li>
                    <li class="btn"><a href="index.php?p=posts_all&pageno=<?php echo $total_pages; ?>">Last</a></li>
                </ul>
            </div>
        </div>    
    </div>
</div>
<hr>
