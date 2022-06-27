<?php
$title = "الصفحة الرئيسة";
require_once "header.php";
echo "<h1>" . "أهلاً " . $_SESSION['name'] . "</h1>" . "</br>";
echo "<h1>" ."نقودك: " . $_SESSION['money'] . "</h1>" . "</br>";
echo "<h1>" ."نقاط الحياة: " . $_SESSION['lifeP'] . "</h1>" . "</br>";
echo "<h1>" ."المجموعة: " . $_SESSION['group'] . "</h1>" . "</br>";
?>

<br>
<br>

<?php
require_once "footer.php";
?>