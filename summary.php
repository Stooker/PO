<?php
require_once('Cart.php');
require_once('Product.php');
require_once('Order.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    Order::place($_POST);
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
    <h1>Zamówienie</h1>
    <a href="cart_viev.php">
        <button>Wróć do koszyka</button>
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
</tr>";
    foreach ($res as $item) {

        echo "<tr>\n";
        echo "<td><img src='img/" . $item['ZDJECIE'] . "'></td>";
        echo "<td>" . $item['NAZWA_TOWARU'] . "</td>";
        echo "<td>" . Product::calc_bruttto($item['CENA_NETTO'], $item['PROCENT_VAT']) . "</td>";
        echo "<td>" . $item['ILOSC'] . "</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";

    ?>

    <form action="summary.php" method="post" class="full-width">
        <div class="form-row">
            <label for="adres_do_wysylki">Wprowadź adres do wysyłki</label>
            <input type="text" name="adres_do_wysylki" id="adres_do_wysylki" required>
        </div>
        <div class="form-row">
            <label for="sposob_platnosci">Wybierz sposób płatności</label>
            <select name="sposob_platnosci" id="sposob_platnosci" required>
                <option value="Przelew" selected>Przelew</option>
                <option value="Karta">Karta</option>
                <option value="Gotówka przy odbiorze">Gotówka przy odbiorze</option>
            </select>
        </div>
        <div class="form-row">
            <label for="rabat">Wybierz rabat</label>
            <select name="rabat" id="rabat"></select>
        </div>

        <div class="form-row right">
            <button type="submit" class="to-right">Potwierdzam wprowadzone dane</button>
        </div>
    </form>
</div>
</body>
</html>