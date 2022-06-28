<?php
require_once "../connection.php";

session_start();
if (!@$_SESSION['logged_admin']){ // prevent open all admin pages unless joining from the login page
    die("عذراً، لا يمكنك الوصول الى هذه الصفحة");
}

function updateGroupPoints($conn)// update the total group points, called when add new student or when attack someone
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
    
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
    </head>
    <body dir="rtl">
        <div class="topnav">
            <ul>
                <li><a href="home.php">الصفحة الرئيسة</a></li>
                <li><a href="studentsData.php">بيانات الطلاب</a></li>
                <li><a href="groupsData.php">بيانات المجموعات</a></li>
                <li><a href="points.php">النقاط</a></li>
                <li><a href="records.php">السجل</a></li>
                <li><a href="store.php">المتجر</a></li>
                <li class="logout"><a href="logout.php">تسجيل الخروج</a></li>
            </ul>
            <br>
            <br>
        </div>