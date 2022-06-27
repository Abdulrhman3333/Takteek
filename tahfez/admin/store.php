<?php
$title = "المتجر" ;
require_once "header.php";
?>

<form method="POST">
    
    <?php
    $i = 1; // to numbering the items
    $stores = $conn->query("SELECT * FROM store WHERE kind = 'هجوم'"); // select only this kind and make it in one box
    echo "<table>";
    echo '<tr><td colspan= "6">الهجوم</td></tr>';
    echo '<tr> <th>الرقم</th> <th>الاسم</th> <th>السعر</th> <th>القوة</th> <th>الكمية</th> <th>النوع</th></tr>';
    while($store = mysqli_fetch_array($stores)){

        echo "<tr>"; 
        echo "<td>". $i . "</td>"; // numbering the items
        echo '<td> <input size="6" type="text" value="' . $store['product'] . '" name="product' . $store['id'] . '"> </td>'; // make it in text box to edit it.
        echo '<td> <input size="4" type="text" value="' . $store['price'] . '" name="price' . $store['id'] . '"> </td>';
        echo '<td> <input size="4" type="text" value="' . $store['power'] . '" name="power' . $store['id'] . '"> </td>';
        echo '<td> <input size="4" type="text" value="' . $store['qty'] . '" name="qty' . $store['id'] . '"> </td>';
        echo '<td> <input size="4" type="text" value="' . $store['kind'] . '" name="kind' . $store['id'] . '"> </td>';
        echo "</tr>";
        $i++;
    }
    echo "</table></br>";

    $i = 1;
    $stores = $conn->query("SELECT * FROM store WHERE kind = 'دفاع'");
    echo "<table>";
    echo '<tr><td colspan= "6">الدفاع</td></tr>';
    echo '<tr> <th>الرقم</th> <th>الاسم</th> <th>السعر</th> <th>القوة</th> <th>الكمية</th> <th>النوع</th></tr>';
    while($store = mysqli_fetch_array($stores)){

        echo "<tr>"; 
        echo "<td>". $i . "</td>";
        echo '<td> <input size="6" type="text" value="' . $store['product'] . '" name="product' . $store['id'] . '"> </td>';
        echo '<td> <input size="4" type="text" value="' . $store['price'] . '" name="price' . $store['id'] . '"> </td>';
        echo '<td> <input size="4" type="text" value="' . $store['power'] . '" name="power' . $store['id'] . '"> </td>';
        echo '<td> <input size="4" type="text" value="' . $store['qty'] . '" name="qty' . $store['id'] . '"> </td>';
        echo '<td> <input size="4" type="text" value="' . $store['kind'] . '" name="kind' . $store['id'] . '"> </td>';
        echo "</tr>";
        $i++;
    }
    echo "</table></br>";

    $message = "";
    if(isset($_POST['submit'])){ // update the data base as entered above
        $stores = $conn->query("SELECT * FROM store");
        while($store = mysqli_fetch_array($stores)){
            $conn->query('UPDATE store SET 
            `product` = "' . $_POST['product'. $store['id']]  . '",
            `price` = ' . $_POST['price'. $store['id']]  . ',
            `power` = ' . $_POST['power'. $store['id']]  . ',
            `qty` = ' . $_POST['qty'. $store['id']]  . ',
            `kind` = "' . $_POST['kind'. $store['id']]  . '"
             WHERE `id` = ' . $store["id"]);
        }
        header("Location: store.php");
    }
    if($message) echo $message; // is not woring
?>
    <input type="submit" name="submit">
</form>

<a href="addWeapon.php">اضافة سلاح</a>
<?php require_once "footer.php";?>

