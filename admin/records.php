<?php
$title = "السجل" ;
require_once "header.php";

$records = $conn->query("SELECT * FROM records");
if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  
$results_per_page = 10;  
$page_first_result = ($page-1) * $results_per_page;
//determine the total number of pages available  
$number_of_page = ceil (mysqli_num_rows($records) / $results_per_page);
$records = $conn->query("SELECT * FROM records LIMIT " . $page_first_result . ',' . $results_per_page);
?>

<table>
    <tr>
        <th>الحدث</th><th>الوقت</th>
    </tr>
    <?php while($record = mysqli_fetch_array($records)): ?>
        <tr>
            <td><?php echo $record['event'] ?></td><td><?php echo $record['time'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- make pages -->
<ul>
    <?php 
    for ($i=1; $i <= $number_of_page ; $i++){
        echo "<li><a href='records.php?page=$i'>".$i."</li>";
    }
    ?>
        
</ul>
