<?php
$title = "صفحة الهجوم";
require_once "header.php";
?>
    
<form method="POST">
    <!--بدء اختيار الطالب الذي تريد الهجوم عليه -->
    <select name="victam">
        <option value="" disabled selected>اختر طالب</option>
        <?php
        $students = $conn->query("SELECT * from `user_psw`");
        while ($student = mysqli_fetch_array($students)) {
            if ($_SESSION['group'] !== $student['group']) { // skip the student whith in the same group
                $name = $student['name'];
                echo "<option value='$name'>$name (" . $student['group'] . ")</option>";
            }
        }
        ?>
    </select>
    <!--انتهاء اختيار الطالب الذي تريد الهجوم عليه -->
    <br>
    <br>
    <!--بدء اختيار السلاح  -->
    <select name="weapon">
        <option value="" disabled selected>اختر السلاح</option>
        <?php
        $weapons = $conn->query("SELECT * from `weapons` WHERE `name` = '" . $_SESSION['name'] . "'"); // عرض الاسلحة التي يمتلكها المهاجم
        while ($weapon = mysqli_fetch_array($weapons)) {
            $w1 = $weapon['w1']; // w1 first box for attaking
            $w2 = $weapon['w2']; // second
            $w3 = $weapon['w3'];// third
            if ($w1 !== NULL) { // echo only existing weapons
                echo "<option value='1'>$w1</option>";
            }
            if ($w2 !== NULL) {
                echo "<option value='2'>$w2</option>";
            }
            if ($w3 !== NULL) {
                echo "<option value='3'>$w3</option>";
            }
        }
        ?>
    </select>
        <!--نهاية اختيار السلاح  -->
    <br>
    <br>
    <input type="submit" name="submit" value="هجوم">
</form>


<?php
if (isset($_POST['submit'])) {

    if($_POST['weapon'] === '1'){ // to select which box has been selected 1 or 2 or 3
        $defend = $conn->query("SELECT s.product, s.power, u.name, u.lifeP, u.group, w.d1,w.usingTimesd1, w.powerd1 FROM weapons AS w INNER JOIN store AS s ON s.product = '$w1' AND w.name = '" . $_POST['victam'] . "' INNER JOIN user_psw AS u on u.name = '" . $_POST['victam'] . "'"); // 
    }else if($_POST['weapon'] === "2"){
        $defend = $conn->query("SELECT s.product, s.power, u.name, u.lifeP, u.group, w.d1,w.usingTimesd1, w.powerd1 FROM weapons AS w INNER JOIN store AS s ON s.product = '$w2' AND w.name = '" . $_POST['victam'] . "' INNER JOIN user_psw AS u on u.name = '" . $_POST['victam'] . "'"); // 
    }else if($_POST['weapon'] === "3"){
        $defend = $conn->query("SELECT s.product, s.power, u.name, u.lifeP, u.group, w.d1,w.usingTimesd1, w.powerd1 FROM weapons AS w INNER JOIN store AS s ON s.product = '$w3' AND w.name = '" . $_POST['victam'] . "' INNER JOIN user_psw AS u on u.name = '" . $_POST['victam'] . "'"); // 
    }

    while($d = mysqli_fetch_array($defend)){
        if($d['d1'] !== NULL){ // the victam has defend
                $conn->query("UPDATE weapons SET `usingTimesd1` = " . ($d['usingTimesd1']-1) . ", `powerd1` = ". ($d['powerd1']-$d['power'])." WHERE `name` = '" . $_POST['victam'] . "'"); // substract restitance power and reduce usingTimes--
                if(($d['power']-$d['powerd1']) > 0){
                    $conn->query("UPDATE user_psw SET `lifeP` = " . ($d['lifeP']-($d['power']-$d['powerd1'])) . " WHERE `name` = '" . $_POST['victam'] . "'"); // substract restitance power and reduce usingTimes--
                }
                if(($d['usingTimesd1']-1) <= 0 || ($d['powerd1']-$d['power']) <= 0){// defend dystroyed
                    $conn->query("UPDATE weapons SET d1 = NULL,`usingTimesd1` = 0 , `powerd1` = 0 WHERE `name` = '" . $_POST['victam'] . "'"); // reset defend
                    
                    
                }
                
            }else{ // doesn't have defend
                $conn->query("UPDATE user_psw SET `lifeP` = " . ($d['lifeP']-$d['power']) . " WHERE `name` = '" . $_POST['victam'] . "'"); // substract restitance power and reduce usingTimes--
            }
            $conn->query("UPDATE weapons SET `w" . $_POST['weapon'] . "` = NULL WHERE `name` = '" . $_SESSION['name'] . "'"); // delete attack weapon

            // for records page to calculate the current time
            $timestamp = strtotime(date("Y/m/d h:i:sa")) + 60*60; 
            $time = date('Y/m/d h:i:sa', $timestamp);
            $conn->query("INSERT INTO records VALUES ('هجم ".$_SESSION['name'] ." على ".$_POST['victam']."','$time')"); // records
            updateGroupPoints($conn);
        }
    }

?>
