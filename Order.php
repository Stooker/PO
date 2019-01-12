<?php
require_once('Cart.php');
require_once('DBConnection.php');

class Order
{
    static function place($data)
    {
        $conn = DBConnection::get_connection();
        $zamowienie_sql = "INSERT INTO zamowienia (adres_do_wysylki, sposob_platnosci, status, data_utworzenia) " .
            "values ('" . $data['adres_do_wysylki'] . "','" . $data['sposob_platnosci'] . "', 'Zlozone', SYSDATE) " .
            "RETURNING id_zamowienia INTO :zam";
        $stid = oci_parse($conn, $zamowienie_sql);
        oci_bind_by_name($stid, ":zam", $id_zamowienia);
        oci_execute($stid);

        $cart = Cart::get_cart();
        $towary_sql = "INSERT ALL \n";

        foreach ($cart as $id => $ilosc) {
            $towary_sql .= "INTO zamowienia_towary VALUES (".$id_zamowienia.",".$id.",".$ilosc.") \n";
        }

        $towary_sql .= "SELECT * FROM dual";

        $stid = oci_parse($conn, $towary_sql);
        oci_execute($stid);
    }
}