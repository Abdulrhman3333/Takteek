<?php 
$title = "صفحة العدة";
require_once("header.php");
echo "الرصيد: " . $_SESSION['money']."</br>"; 
echo "نقاط الحياة: " . $_SESSION['lifeP']; 
?>

    <h1>العدة الحالية:</h1>
    <?php     
        $weapons = $conn->query("SELECT * FROM weapons WHERE `name` = '" . $_SESSION['name'] . "'");
        while ($weapon = mysqli_fetch_array($weapons)):
    ?>

    <fieldset>
        <legend>هجوم1</legend>
        <?php  echo ($weapon['w1'] == NULL) ? '<a href="store.php?p=w1">شراء</a>' :  $weapon['w1']; // show the weapon name, if not allow him to buy ?>
    </fieldset>

    <fieldset>
        <legend>هجوم2</legend>
        <?php echo ($weapon['w2'] == NULL) ? '<a href="store.php?p=w2">شراء</a>' :  $weapon['w2']; // p=w2 to put the weapon in the box where he clicked  ?>
    </fieldset>

    <fieldset>
        <legend>هجوم3</legend>
        <?php   echo ($weapon['w3'] == NULL) ? '<a href="store.php?p=w3">شراء</a>' :  $weapon['w3'];  ?>
    </fieldset>

    <fieldset>
        <legend>دفاع</legend>
        <?php   echo ($weapon['d1'] == NULL) ? '<a href="store.php?p=d1">شراء</a>' :  $weapon['d1'];  ?>
    </fieldset>
<?php endwhile;?>
<br>
<h1>شراء نقاط حياة</h1>
<p>10 نقاط = 100$</p>
<form method="POST" >
    <label>أدخل عدد النقاط</label>
    <input type="text" name="buyPoints">
    <input type="submit" name="submit" value="شراء نقاط حياة">
</form>
<?php 
if(isset($_POST['submit'])){
    $price = $_POST['buyPoints'] * 10; // if the user enter 10, the price will be 100$.    20 = 200 .... could be change
    if($_POST['buyPoints'] % 10 !== 0){
        echo "يجب ان تكون عدد النقاط من مضاعفات 10";
        die();
    }
    if($_SESSION['money'] < $price){
        echo "لا تمتلك رصيد كافي!";
        die();
    }
    // else
    $conn->query("UPDATE user_psw SET `money` = " .($_SESSION['money'] - $price). ", `lifeP` = ".($_SESSION['lifeP'] + $_POST['buyPoints'])." WHERE `name` = '" . $_SESSION['name'] . "'");
    updateGroupPoints($conn);
    header("Location: info.php");
    // echo "تم شراء النقاط"; need to fix.
    
}
require_once("footer.php");