<?php
require_once('Cart.php');
require_once('DBConnection.php');

class Order
{
    static function place($data)
    {
        $cart = Cart::get_cart();
        $empty = empty($data) || empty($cart);
        $success = false;

        if (!$empty) {
            $conn = DBConnection::get_connection();
            $zamowienie_sql = "INSERT INTO zamowienia (adres_do_wysylki, sposob_platnosci, status, data_utworzenia) " .
                "values ('" . $data['adres_do_wysylki'] . "','" . $data['sposob_platnosci'] . "', 'Zlozone', SYSDATE) " .
                "RETURNING id_zamowienia INTO :zam";
            $stid = oci_parse($conn, $zamowienie_sql);
            oci_bind_by_name($stid, ":zam", $id_zamowienia);
            $success = oci_execute($stid);

            $towary_sql = "INSERT ALL \n";

            foreach ($cart as $id => $ilosc) {
                $towary_sql .= "INTO zamowienia_towary VALUES (".$id_zamowienia.",".$id.",".$ilosc.") \n";
            }

            $towary_sql .= "SELECT * FROM dual";

            $stid = oci_parse($conn, $towary_sql);
            $success = $success && oci_execute($stid);
        }

        if ($empty || $success) {
            Cart::clear();
            header('Location: index.php');
        }
    }
}