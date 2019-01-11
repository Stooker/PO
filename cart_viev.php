<?php
require_once('Cart.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>'Apteka - Rodzinna'</title>
</head>
<body>
<div>
    <?php

    var_dump(Cart::get_cart_detail());
    ?>


</div>
</body>
</html>