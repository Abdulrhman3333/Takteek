<?php
$title = "بيانات المجموعات" ;
require_once "header.php";
?>
<h1>أسماء المجموعات:</h1>
<?php
$groupNames = $conn->query("SELECT * FROM groups");
while($group = mysqli_fetch_array($groupNames)):
    ?>
    <label><?php echo $group['groupNames']?></label>
    <form onsubmit="return confirm('هل تريد حذف المجموعة?')" action="" method='POST' style='display:inline-block'>
        <input type="hidden" name='deleteGroup' value="<?php echo $group['groupNames'] ?>">
        <button >حذف</button>
    </form>
    <br>
<?php 
endwhile;
if(isset($_POST['deleteGroup'])){ // delete group
    $conn->query("DELETE FROM groups WHERE `groupNames` ='" . $_POST['deleteAccount']."'");
    echo "<script>window.location.href='groupsData.php'</script>";
    die();
}
?>
<a href="addGroup.php">اضافة مجموعة</a>
<?php require_once "footer.php";?>