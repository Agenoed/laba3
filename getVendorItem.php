<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Постачальник</title>
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
        if(isset($_GET["vendor_name"]))
        {
            $vendorName = $_GET["vendor_name"];
            try{
              
              $sqlGetVendors = "SELECT * FROM lb_pdo_goods.vendors";
              
              foreach($dbh->query($sqlGetVendors) as $row)
              {
                if ($vendorName==$row['v_name'])
                {
                  $vendorId=$row['ID_Vendors'];
                }
              }
              
                $sqlGetVendorFid = "SELECT * FROM lb_pdo_goods.items WHERE FID_Vendor= :id";
                $stm = $dbh->prepare($sqlGetVendorFid);
                $stm->bindParam(':id', $vendorId, PDO::PARAM_INT);
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