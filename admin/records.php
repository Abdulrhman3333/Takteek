<?php
$title = "السجل" ;
require_once "header.php";

$records = $conn->query("SELECT * FROM records");
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
