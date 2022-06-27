<?php
$title = "الهجوم";
require_once "header.php";
// echo $_SESSION['name'] . "</br>";
echo "الرصيد الحالي:" . $_SESSION['money'] . "</br>";



if (isset($_GET['p']) && isset($_POST['submit'])) { // $_GET['p'] to get which box is selected, w1,w2,w3, or d1 for defend
    $timestamp = strtotime(date("Y/m/d h:i:sa")) + 60*60;
    $time = date('Y/m/d h:i:sa', $timestamp);
    $mixes = $conn->query("SELECT s.qty, s.price, s.product, s.power, s.usingTimes, u.money, u.name FROM store AS s INNER JOIN user_psw AS u ON u.name ='" . $_SESSION['name'] . "'AND s.product = '" . $_POST['ops'] . "'");
    while($mix = mysqli_fetch_array($mixes)){
            if($mix['money'] < $mix['price']){
                // $conn->query("INSERT INTO records VALUES ('حاول ".$_SESSION['name'] ." شراء سلاح ".$_POST['ops']." لكنه لا يملك رصيد كافي','$time')");
                die("لا تمتلك رصيد كافي");
            } 
            if($mix['qty'] <= 0){die("نفذ هذا السلاح");} 
            if($_GET["p"] == 'd1'){ //buying defend
                $conn->query("UPDATE `weapons` SET `usingTimesd1` = '" . $mix["usingTimes"] . "' , `powerd1` = '" . $mix["power"] . "' WHERE `name` = '" . $mix["name"] . "'"); // add usingTimes & power to weapons table
            }
            $conn->query("UPDATE `store` SET `qty` = " . ($mix['qty']-1) . " WHERE `product` = '" . $_POST['ops'] . "'"); // product quantity--
            $conn->query("UPDATE `weapons` SET " . $_GET["p"] . " = '" . $_POST['ops'] . "' WHERE `name` = '" . $mix["name"] . "'"); // add weapon attak to weapons table
            $conn->query("UPDATE `user_psw` SET `money` = " . ($mix['money']-=$mix['price']) . " WHERE `name` = '" . $mix["name"] . "'"); // reduce the money after buying
            $_SESSION['money'] = $mix['money'];
            $conn->query("INSERT INTO records VALUES ('اشترى ".$_SESSION['name'] ." سلاح ".$_POST['ops']."','$time')");

    }
    header("Location: info.php");
}
?>

    <?php
    $ws = $conn->query("SELECT product from store WHERE kind = 'هجوم'");
    $ds = $conn->query("SELECT product from store WHERE kind = 'دفاع'");
    
    ?>
<form action="" method="POST">
    <select name="ops">
        <option value="" disabled selected>اختر سلاح</option>
        <?php
        if ($_GET['p'] == 'w1' || $_GET['p'] == 'w2' || $_GET['p'] == 'w3') {
            $kind = $ws;
        }elseif ($_GET['p'] == 'd1') {
            $kind = $ds;
        }

        while ($row = mysqli_fetch_array($kind)) {
            echo "<option value='" . $row["product"] . "'>" . $row["product"] . "</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="شراء">

    <br>
    <br>

</form>
    <?php
if ($_GET['p'] == 'w1' || $_GET['p'] == 'w2' || $_GET['p'] == 'w3') {
    // echo "الهجوم:";
    $i = 1;
    $stores = $conn->query("SELECT * FROM store WHERE kind = 'هجوم'");
    echo "<table style=>";
    echo '<tr><td style="text-align:center" colspan= "5">الهجوم</td></tr>';
    echo '<tr> <th>الرقم</th> <th>الاسم</th> <th>السعر</th> <th>القوة</th> <th>الوفرة</th></tr>';
    while($store = mysqli_fetch_array($stores)){

        echo "<tr>"; 
        echo "<td>". $i . "</td>";
        echo "<td>". $store['product']. "</td>";
        echo "<td>". $store['price']. "$</td>"; 
        echo "<td>". $store['power']. "</td>"; 
        echo "<td>". $store['qty']. "</td>"; 
        echo "</tr>";
        $i++;
    }
    echo "</table></br>";
} elseif ($_GET['p'] == 'd1') {
    // echo "الدفاع:";
    echo "</table></br>";
    $i = 1;
    $stores = $conn->query("SELECT * FROM store WHERE kind = 'دفاع'");
    echo "<table>";
    echo '<tr><td style="text-align:center" colspan= "6">الدفاع</td></tr>';
    echo '<tr> <th>الرقم</th> <th>الاسم</th> <th>السعر</th> <th>القوة</th> <th>التحمّل</th> <th>الوفرة</th></tr>';
    while($store = mysqli_fetch_array($stores)){

        echo "<tr>"; 
        echo "<td>". $i . "</td>";
        echo "<td>". $store['product']. "</td>";
        echo "<td>". $store['price']. "$</td>"; 
        echo "<td>". $store['power']. "</td>"; 
        echo "<td>". $store['usingTimes']. "</td>"; 
        echo "<td>". $store['qty']. "</td>"; 
        echo "</tr>";
        $i++;
}
}
require_once ("footer.php");
    ?>


