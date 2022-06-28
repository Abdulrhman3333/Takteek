<?php 
$title = "اضافة طالب جديد" ;
require_once "header.php";
$DEFUALT_MONEY = 1000;
$DEFUALT_POINTS = 1000;

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <?php $rand = uniqueStudenId($conn); ?>
    <label>اسم الطالب:</label>
    <input type="text" name="name"> </br>
    <label>اسم المستخدم</label>
    <input type="text" name="userId" value="<?php echo $rand; ?>"></br>
    <label>كلمة المرور</label>
     <input type="text" name="userP" value="<?php echo $rand; ?>"></br>
     <label>المجموعة</label>

        <select name="ops" >
                    <option value="" disabled selected>اختر مجموعة</option>
                    <?php 
                        $groupsNames = $conn->query("SELECT * from groups");
                        while($row = mysqli_fetch_array($groupsNames)){
                            $id = $row['id'];
                            $nameG = $row['groupNames'];
                            echo "<option value='$nameG'>$nameG</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="إضافة الطالب"></br>
</form>

<?php
    if(isset($_POST['name'])&&isset($_POST['userId'])&&isset($_POST['userP'])&&isset($_POST['ops'])){
        $name = $_POST['name'];
        $userId = $_POST['userId']; 
        $userP = $_POST['userP'];  
        $group = $_POST['ops'];  
        $money = $DEFUALT_MONEY;  
        $lifeP = $DEFUALT_POINTS;  

        $conn->query("INSERT INTO user_psw VALUES (NULL,'$name','$money','$lifeP','$userId','$userP','$group')"); // add the student in user_psw table
        $conn->query("INSERT INTO weapons VALUES (NULL,'$name', NULL,NULL ,NULL, NULL,0,0)"); // add the student in weapons table
    
        updateGroupPoints($conn); // refresh the total group points

        echo "تم اضافة " . $name . " في مجموعة " .$group . " بنجاح.";
    }else{
        echo "يجب ملئ جميع الحقول";
    }

    // this function is to generate unique students IDs, which is not in the database
    function uniqueStudenId($conn){
        while(true){
            $rand = rand(10000,99999);
            $unique = $conn->query("SELECT * FROM user_psw WHERE `user` = '$rand'");
            if($unique->num_rows > 0){
                continue;
             }else{
                return $rand;
             }
        }
}

?>

<?php require_once "footer.php";?>