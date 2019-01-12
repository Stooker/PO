<?php
require_once('Cart.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    Cart::add($_POST['id'], 1);
    header('Location: cart_view.php');
}
?>
<!DOCTYPE html>
<html lang="en" xmlns:text-align="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="details.css">
    <title>'Apteka - Rodzinna'</title>
</head>
<body>
<div>
    <?php
    require_once('Product.php');

    $product = new Product();
    $res = $product->get_details($_GET['id']);

    ?>


    <div id="header">
        <table id="table_top">
            <tr>
                <td>
                    <button>Zaloguj</button>
                </td>
                <td style="width:80% ">
                    <?php
                    echo "<h1>" . $res['NAZWA_TOWARU'] . "</h1>";

                    ?></td>
                <td>
                    <a href="index.php">
                        <button>Wróć do przeglądania</button>
                    </a>
                </td>
            </tr>
        </table>


    </div>
    <div id="back">

        <div id="product">
            <div id="img">
                <?php
                echo "<img src='img/" . $res['ZDJECIE'] . "'>"
                ?>
            </div>
            <div id="text">
                <?php
                echo $res['OPIS'];
                ?>
            </div>
            <div id="prize">
                <table>
                    <tr>
                        <td style="width:80% ">
                            <h2>Cena: <?= Product::calc_bruttto($res['CENA_NETTO'], $res['PROCENT_VAT']) ?></h2>
                        </td>
                        <td>
                            <button>Zobacz ulotkę</button>
                        </td>
                        <td>
                            <form action="details.php" method="post">
                                <input type="hidden" name="id" value="<?= $res['ID_TOWARU']?>">
                                <button type="submit">Dodaj do koszyka</button>
                            </form>
                        </td>
                    </tr>
                </table>

            </div>
        </div>


    </div>


</body>
</html>