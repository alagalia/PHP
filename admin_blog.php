<?php
require_once "check_index_usage.php";
require_once "logged_check.php";
?>
<?php
if (@$_GET['edit']) {
    require_once 'post_update.php';
} elseif (@$_GET['delete']) {
    require_once 'post_delete.php';
} else {
    require_once "post_add.php";
}
?>



<table border="1">
    ACCESS ADMIN blog PAGE  
    <?php
    $result = mysqli_query($conn, "SELECT * FROM posts");
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>	
            <td><a href="index.php?p=admin_blog&edit=<?php echo $row['id']; ?>">Редактирай</a></td>	
            <td><a href="index.php?p=admin_blog&delete=<?php echo $row['id']; ?>">Изтрий</a></td>	
        </tr>
        <?php
    }
    ?>

</table>