<?php
$title = "اضافة سلاح" ;
require_once "header.php";
?>

    <form action="" method="POST">
        <label >اسم السلاح: </label>
        <input type="text" name="weaponName"> </br>
        <label >سعر السلاح: </label>
        <input type="text" name="weaponPrice"></br>
        <label >قوة السلاح: </label>
        <input type="text" name="weaponPower"></br>
        <label >مرات الاستخدام: </label>
        <input type="text" name="usingTimes"></br>
        <label >كمية السلاح: </label>
        <input type="text" name="weaponQty"></br>
        <label >نوع السلاح: </label>
        </br>
        <label >هجوم: </label>
        <input type="radio" name="weaponKind" value="هجوم"></br>
        <label >دفاع: </label>
        <input type="radio" name="weaponKind" value="دفاع"></br>
        <input type="submit" name="submit" value="اضافة السلاح">


    </form>

    <?php
        if(isset($_POST['weaponName']) && isset($_POST['weaponPrice']) && isset($_POST['weaponPower']) && isset($_POST['usingTimes']) && isset($_POST['weaponQty']) && isset($_POST['weaponKind']) && isset($_POST['submit'])){
            $name = $_POST['weaponName'];
            $price = $_POST['weaponPrice'];
            $power = $_POST['weaponPower'];
            $usingTimes = $_POST['usingTimes'];
            $qty = $_POST['weaponQty'];
            $kind = $_POST['weaponKind'];

            $conn->query("INSERT INTO store VALUES (NULL,'$name',$price,$power,$usingTimes,$qty,'$kind' ) ");
        }else{
            echo "يرجى ملئ جميع الحقول";
        }

    ?>
<?php require_once "footer.php";?>