<?php
 include('accessDB.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Лабораторна 3</title>
    </head>
    <body>
        <h1>КІУКІ-19-9 Деонега О.В.</h1>
        <h2>Варіант 5</h2>
        <div>
            <form method="get" action="getVendorItem.php">
                <p><b>Оберіть постачальника, щоб переглянути доступні продукти</b></p>
                    <select name='vendor_name'>
                        <option>Постачальник</option>

                        <?php
                            $sql = "SELECT * FROM lb_pdo_goods.vendors";
                            foreach($dbh->query($sql) as $row)
                            {
                                $vendor_name = $row['v_name'];
                                echo "<option value = '$vendor_name'> $vendor_name</option>";
                            }
                        ?>

                    </select>
                <button type="submit" >Пошук</button>
            </form>

            <form method="get" action="getCategoryItem.php">
                <p><b>Оберіть категорію, щоб переглянути доступні продукти</b></p>
                    <select name='category_name'>
                        <option>Категорії</option>

                        <?php
                            $sql = "SELECT * FROM lb_pdo_goods.category";
                            foreach($dbh->query($sql) as $row)
                            {
                                $category_name = $row['c_name'];
                                echo "<option value = '$category_name'> $category_name</option>";
                            }
                        ?>
                    </select>
                <button type="submit" >Пошук</button>
            </form>

            <form method="get" action="getPriceRange.php">
                <p><b>Внесіть діапазон цін, щоб переглянути доступні товари</b></p>
                    <input name="min" type=number min = "0" value = "0">
                    <input name="max" type=number value = "1500">
                    <button type="submit" >Пошук</button>
            </form>

        </div>
    </body>
</html>