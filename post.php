<?php
require_once "check_index_usage.php";
require_once "logged_check.php";

?>

<!-- Main Content -->
<div class="container">
    <?php
    if (!isset($_GET['post_id'])) {
        echo "<meta http-equiv='refresh' content='0;url=index.php?p=index'>";
    } else {
        $query = "SELECT id, name, content, picture, youtube FROM posts WHERE id={$_GET['post_id']}";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>

        <!-- Page Header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="post-heading">
                            <h1><?php echo $row['name']; ?> </h1>
                            <?php
                            if ($is_admin_logged) {
                                ?>
                                <hr>
                                <p>
                                    <span style="display: inline-block;"> <a href="index.php?p=admin_blog&edit=<?php echo $row['id']; ?>">Редактирай</a>
                                        <span > <a href="index.php?p=admin_blog&delete=<?php echo $row['id']; ?>">Изтрий</a></span>
                                </p>
                                <?php
                            }
                            ?>
                            <hr>
                            <span><i>Posted by
                                    <a href="#">Start </a>
                                    on 2019</i></span>
                            </br>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Post Content test -->
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">

                        <a href="#">
                            <img class="img-fluid" style="border-style:double; color: darkgrey; "src="<?php echo 'blog_pics/' . $row['picture']; ?>" />
                        </a>
                        <span class="caption text-muted"><?php echo $row['name']; ?></span>

                        <p>
                            <?php echo $row['content']; ?>  
                        </p> 
                    </div>
                    <div class="mx-auto col-lg-8 col-md-10 embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" <?php echo 'src="https://www.youtube.com/embed/' . $row['youtube'] . '"' ?>></iframe>
                    </div>
                </div>
            </div>
        </article>

        <hr>
        <!--pOST CONTENT END -->

        <div>
            <?php if ($is_user_logged) {
                ?>
                <div class="clearfix">
                    <a class="btn btn-primary float-right" href="index.php?p=comment_add&post_id=<?php echo $_GET['post_id']; ?>">Add comment</a>

                </div>
                <?php
            }
            ?>
            Comments:
            <?php
            $query = "
        SELECT comments.content, users.name
        FROM comments 
        INNER JOIN users ON users.id=user
        WHERE post={$_GET['post_id']}";

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="post-preview">
                            <p class="post-meta">
                                <?php echo $row['content']; ?> <br>
                                Posted by                       
                                <?php echo "User: " . $row['name']; ?>
                            </p>
                        </div>
                        <hr>
                    </div>
                </div>
                <?php
                #TODO delete comment
                
            }
        }
        ?>
    </div>
</div>