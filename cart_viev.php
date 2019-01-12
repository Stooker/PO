<?php
require_once('Cart.php');
require_once('Product.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    Cart::remove($_POST['id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Apteka - Rodzinna</title>
</head>
<div class="header">
    <button>Zaloguj</button>
    <h1>Twój koszyk</h1>
    <a href="index.php">
        <button>Wróć do przeglądania</button>
    </a>
</div>
<div>

    <?php
    $res = Cart::get_cart_detail();

    echo "<table class='list' border='1'>\n";
    echo "<tr>
<th>Podgląd</th>
<th>Nazwa</th>
<th>Cena</th>
<th>Ilość</th>
<th>Akcje</th>
</tr>";
    foreach ($res as $item) {

        echo "<tr>\n";
        echo " <form method=\"POST\" action=\"cart_viev.php\">";
        echo "<td><img src='img/" . $item['ZDJECIE'] . "'></td>";
        echo "<td>" . $item['NAZWA_TOWARU'] . "</td>";
        echo "<td>" . Product::calc_bruttto($item['CENA_NETTO'], $item['PROCENT_VAT']) . "</td>";
        echo "<td>" . $item['ILOSC'] . "<input type='hidden' name='id' value='" . $item['ID_TOWARU'] . "'></td>";
        echo "<td><button type='submit' class='warning'>Usuń z koszyka</button><a href='details.php?id=" . $item['ID_TOWARU'] . "'> <button type='button' >Zobacz szczegóły</button></a></td>";
        echo "</form>";
        echo "</tr>\n";
    }
    echo "</table>\n";

    ?>

    <a href="summary.php" class="to-right">
        <button>Zamawiam i płacę</button>
    </a>
</div>
</body>
</html>