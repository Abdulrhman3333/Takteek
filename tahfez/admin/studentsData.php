<?php 
$title = "بيانات الطلاب" ;
require_once "header.php";
?>

<a href="addStudent.php">إضافة طالب</a>

<h1>بيانات الطلاب</h1>
<!-- بيانات الطلاب جدول -->
<table class="studentTable">
    <thead>
        <tr>
            <th>الرقم</th> <th>الاسم</th> <th>النقود</th> <th>نقاط الحياة</th><th>اسم المستخدم</th> <th>الرمز السري</th> <th>المجموعة</th> 
            <th>سلاح1</th> <th>سلاح2</th> <th>سلاح3</th> <th>دفاع</th> <th>مرات التحمّل</th> <th>قوة الدفاع</th> <th>التفاصيل</th>
        </tr>
    </thead>
    <tbody>

<?php
if(isset($_POST['deleteAccount'])){ //delete students from the data base from two tables
    $conn->query("DELETE FROM user_psw WHERE id =" . $_POST['deleteAccount']);
    $conn->query("DELETE FROM weapons WHERE id =" . $_POST['deleteAccount']);
    echo "<script>window.location.href='admin/studentsData.php'</script>"; // refresh the page
    die();
}
if(isset($_POST['save'])){ // update the enterd information about this student
    $conn->query('UPDATE user_psw SET `name` = "' . $_POST["name"] .'" , `money` = ' . $_POST["money"] .' , `lifeP` = ' . $_POST["lifeP"] .' , `user` = "' . $_POST["user"] .'" , `psw` = "' . $_POST["psw"] .'" , `group` = "' . $_POST["group"] .'" WHERE `id` = '. $_GET['id'] );
    $conn->query('UPDATE weapons SET `w1` = "' . $_POST["w1"] .'" , `w2` = "' . $_POST["w2"] .'" , `w3` = "' . $_POST["w3"] .'" , `d1` = "' . $_POST["d1"] .'" , `usingTimesd1` = ' . $_POST["usingTimesd1"] .' , `powerd1` = ' . $_POST["powerd1"] .' WHERE `id` = '. $_GET['id'] );
}

if(isset($_GET['id'])){ // display only this student
    $displayStu = $conn->query("SELECT * FROM user_psw WHERE `id` = '". $_GET['id']. "' limit 1")->fetch_array(MYSQLI_ASSOC);
    $weapons = $conn->query("SELECT * FROM weapons WHERE `id` = '" . $_GET['id'] . "' limit 1")->fetch_array(MYSQLI_ASSOC);
    updateGroupPoints($conn); 
        ?>
    <form method="POST">
        <tr>
            <td><?php echo $displayStu['id']?></td>
            <td><input type="text" size="4" name="name" value="<?php echo $displayStu['name']?>"></td>
            <td><input type="text" size="4" name="money" value="<?php echo $displayStu['money']?>"></td>
            <td><input type="text" size="4" name="lifeP" value="<?php echo $displayStu['lifeP']?>"></td>
            <td><input type="text" size="4" name="user" value="<?php echo $displayStu['user']?>"></td>
            <td><input type="text" size="4" name="psw" value="<?php echo $displayStu['psw']?>"></td>
            <td><input type="text" size="4" name="group" value="<?php echo $displayStu['group']?>"></td>
            <td><input type="text" size="4" name="w1" value="<?php echo $weapons['w1']?>"></td>
            <td><input type="text" size="4" name="w2" value="<?php echo $weapons['w2']?>"></td>
            <td><input type="text" size="4" name="w3" value="<?php echo $weapons['w3']?>"></td>
            <td><input type="text" size="4" name="d1" value="<?php echo $weapons['d1']?>"></td>
            <td><input type="text" size="4" name="usingTimesd1" value="<?php echo $weapons['usingTimesd1']?>"></td>
            <td><input type="text" size="4" name="powerd1" value="<?php echo $weapons['powerd1']?>"></td>
            <input type="submit" name="save" value="حفظ التغييرات" >
        </form>
            <td>
                <form onsubmit="return confirm('هل تريد حذف الحساب?')" action="" method='POST' style='display:inline-block'>
                    <input type="hidden" name='deleteAccount' value="<?php echo $displayStu['id'] ?>">
                    <button >حذف</button>
                </form>
            </td>
        </tr>
<?php


}else{ // if there is no $_GET['id'], it will show all students data
    $stuNames = $conn->query("SELECT * FROM user_psw")->fetch_all(MYSQLI_ASSOC);
    $weaponsNames = $conn->query("SELECT * FROM weapons")->fetch_all(MYSQLI_ASSOC);
    for ($i=0; $i < count($stuNames); $i++):
        ?>
        <tr>
            <td><?php echo $stuNames[$i]['id']?></td>
            <td><?php echo $stuNames[$i]['name']?></td>
            <td><?php echo $stuNames[$i]['money']?></td>
            <td><?php echo $stuNames[$i]['lifeP']?></td>
            <td><?php echo $stuNames[$i]['user']?></td>
            <td><?php echo $stuNames[$i]['psw']?></td>
            <td><?php echo $stuNames[$i]['group']?></td>
            <td><?php echo $weaponsNames[$i]['w1']?></td>
            <td><?php echo $weaponsNames[$i]['w2']?></td>
            <td><?php echo $weaponsNames[$i]['w3']?></td>
            <td><?php echo $weaponsNames[$i]['d1']?></td>
            <td><?php echo $weaponsNames[$i]['usingTimesd1']?></td>
            <td><?php echo $weaponsNames[$i]['powerd1']?></td>
            <td><a href="?id=<?php echo $stuNames[$i]['id'] ?>">عرض</a></td>
        </tr>

   <?php endfor;
   ?>
</tbody>
</table>

<?php 
}

require_once "footer.php";?>