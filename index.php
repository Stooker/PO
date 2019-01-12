<?php
require_once('Cart.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    Cart::add($_POST['id'], $_POST['ilosc']);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Apteka - Rodzinna</title>
</head>
<body>
<div class="header">
    <button>Zaloguj</button>
    <h1>Dostępny asortyment</h1>
    <a href="cart_viev.php">
        <button>Zobacz koszyk</button>
    </a>
</div>
<div>

    <?php
    require_once('Product.php');
    $product = new Product();
    $res = $product->get_list();

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
        echo " <form method=\"POST\" action=\"index.php\">";
        echo "<td><img src='img/" . $item['ZDJECIE'] . "'></td>";
        echo "<td>" . $item['NAZWA_TOWARU'] . "</td>";
        echo "<td>" . Product::calc_bruttto($item['CENA_NETTO'], $item['PROCENT_VAT']) . "</td>";
        echo "<td><input type='number' name='ilosc' value='1'><input type='hidden' name='id' value='" . $item['ID_TOWARU'] . "'></td>";
        echo "<td><button type='submit'>Dodaj do koszyka</button><a href='details.php?id=" . $item['ID_TOWARU'] . "'> <button type='button' >Zobacz szczegóły</button></a></td>";
        echo "</form>";
        echo "</tr>\n";
    }
    echo "</table>\n";

    ?>


</div>
</body>
</html>