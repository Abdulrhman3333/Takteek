<?php
require_once "../connection.php";
session_start();
if (!@$_SESSION['logged_member']){// prevent open all member pages unless joining from the login page
    die("عذراً، لا يمكنك الوصول الى هذه الصفحة");
}
updateSessions($conn); // to update the shown session information everytime, as it is in the database
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
</head>
<body dir="rtl">
    <!-- start top navigation bar -->
    <div class="topnav">
        <ul>
            <li><a class="active" href="home.php">الصفحة الرئيسة</a></li>
            <li class="logout"><a href="logout.php">تسجيل الخروج</a></li>     
            <?php
if($_SESSION['lifeP'] < 50){ // if the user has less than 50 life point, he can't do any thing, and only the main and logout pages are shown
    echo "<br>";
    echo "<br>";
    echo"</div>";
    echo "<h1>" . "أهلاً " . $_SESSION['name'] . "</h1>" . "</br>";
    echo "<h1>" ."نقودك: " . $_SESSION['money'] . "</h1>" . "</br>";
    echo "<h1>" ."نقاط الحياة: " . $_SESSION['lifeP'] . "</h1>" . "</br>";
    echo "<h1>" ."المجموعة: " . $_SESSION['group'] . "</h1>" . "</br>";
    echo "نقاطك لا تسمح بفعل شيء";
    echo "</br>";
    echo "يجب عليك شراء نقاط حياة بسعر 300$";
    echo "<form method='POST' >";
    echo '<input type="submit" name="submit" value="شراء">';
    echo '</form>';
    if(isset($_POST['submit'])){
        if($_SESSION['money'] >= 300){
            $conn->query("UPDATE user_psw SET `money` = " . ($_SESSION['money'] - 300) . " , `lifeP` = ".($_SESSION['lifeP'] + 300)." WHERE `name`= '" . $_SESSION['name'] . "'" );
            echo "<script>window.location.href='home.php'</script>";
        }else{
            echo "للأسف لا تمتلك رصيد كافي";
            die();
        }
    }
    die();
    
}
function updateSessions($conn){
    $members = $conn->query('SELECT * FROM `user_psw` WHERE `name` = "' . $_SESSION['name'] . '"');
    while($member = mysqli_fetch_array($members)){
        $_SESSION['money'] = $member['money'];
        $_SESSION['lifeP'] = $member['lifeP'];
    }
}

function updateGroupPoints($conn)
{
    $groupNames = $conn->query("SELECT * FROM groups")->fetch_all(MYSQLI_ASSOC);
    $member = $conn->query("SELECT * FROM user_psw")->fetch_all(MYSQLI_ASSOC);
    $sum = 0;
    for ($i=0; $i < count($groupNames); $i++) { 
        for ($j=0; $j < count($member); $j++) { 
            if($member[$j]['group'] === $groupNames[$i]['groupNames']){
                $sum += $member[$j]['lifeP'];
            }
        }
        $conn->query("UPDATE groups SET `points` = $sum WHERE `groupNames` = '". $groupNames[$i]['groupNames'] . "'");
        $sum = 0;
    }
}
?>
<!-- continue show other li if the life point > 50 -->
            <li><a href="info.php">المستودع</a></li>
            <li><a href="attack.php">الهجوم</a></li>
        </ul>
        <br>
        <br>
    </div>
    
