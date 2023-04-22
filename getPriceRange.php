<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ціновий діапазон</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Quality</th>
            <th>FID_Vendor</th>
            <th>FID_Category</th>
        </tr>
        <?php
        include('accessDB.php');
        if(isset($_GET["min"])&&isset($_GET["max"]))
        {
            $min = $_GET["min"];
            $max = $_GET["max"];
           
            try{
                $sqlGetRange = "SELECT * FROM lb_pdo_goods.items WHERE price BETWEEN :min AND :max";
                $stm = $dbh->prepare($sqlGetRange);
                $stm->bindParam(':min', $min, PDO::PARAM_INT);
                $stm->bindParam(':max', $max, PDO::PARAM_INT);
                $stm->execute();
                
                $cursor = $stm->fetchAll();
                foreach($cursor as $row)
                {
                    $itemId = $row['ID_Items'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $quality = $row['quality'];
                    $fidVendor = $row['FID_Vendor'];
                    $fidCategory = $row['FID_Category'];

                    print "<tr> <td>$itemId</td> <td>$name</td>
                    <td>$price</td> <td>$quantity</td><td>$quality</td>
                    <td>$fidVendor</td><td>$fidCategory</td></tr>";

                }

            }
            catch(PDOException $e)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        ?>
    </table>
</body>
</html>