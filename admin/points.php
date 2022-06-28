<?php
// this page is to give points to the students 
$title = "النقاط" ;
require_once "header.php";
?>

<form method="POST">
    <?php
    $groupNames = $conn->query("SELECT * FROM groups"); // table header and group name
    while($group = mysqli_fetch_array($groupNames)):
        $stuNames = $conn->query("SELECT * FROM user_psw WHERE `group` = '" . $group["groupNames"] . "'");  
    ?>
<table class='pointsTable'>
    <tr><td colspan= "4"><?php echo $group['groupNames'] ?></td></tr>
    <tr> <th>الرقم</th> <th>الاسم</th> <th>النقود الحالية</th> <th>الاضافة</th></tr> 
<?php
    while($student = mysqli_fetch_array($stuNames)): // print all stundnt in this group
        echo "<tr>"; 
        echo "<td>". $student['id']. "</td>";
        echo "<td>". $student['name']. "</td>";
        echo "<td>". $student['money']. "</td>"; 
        echo '<td> <input size="4" type="text" name="addPoints' . $student['id'] . '"> </td>';
        echo "</tr>";
        
    
    endwhile;
    echo "</table></br>";
endwhile;
    $message = "";
    $stuNames = $conn->query("SELECT * FROM user_psw");
    if(isset($_POST['submit'])){
        $message = "تم اضافة النقاط بنجاح"; // needs to fix, it is not working
        while($student = mysqli_fetch_array($stuNames)){
            $conn->query('UPDATE user_psw SET `money`= ' . ($_POST["addPoints" . $student["id"]] + $student["money"]) . ' WHERE `id` = ' . $student["id"] );
        }
        header("Location: points.php");
    }
    
    // idea: make js function, when the user enter two digits the cursor switch to the next textbox.  to make entering points easy
?>

    <input type="submit" name="submit" value="اضافة النقاط">
</form>

<br>

<?php require_once "footer.php";?>