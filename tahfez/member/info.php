<?php 
$title = "صفحة العدة";
require_once("header.php");
// echo $_SESSION['name'] . "</br>"; 
echo "الرصيد: " . $_SESSION['money']; 
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
<?php 
require_once("footer.php");