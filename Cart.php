<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: maxga
 * Date: 10.01.2019
 * Time: 22:31
 */
require_once('DBConnection.php');

function get(&$var, $default = null)
{
    return isset($var) ? $var : $default;
}

class Cart
{


    static function add($id, $ilosc)
    {
        $cart = &self::get_cart();

        $cart[$id] = get($cart[$id], 0) + $ilosc;
    }

    static function remove($id)
    {
        $cart = &self::get_cart();

        unset($cart[$id]);
    }


    static function &get_cart()
    {
        if (!array_key_exists("cart", $_SESSION)) {
            $_SESSION['cart'] = array();

        }
        return $_SESSION['cart'];
    }

    static function get_cart_detail()
    {
        $cart = self::get_cart();
        $ids = '';
        foreach ($cart as $id => $ilosc) {
            $ids .= $id . ',';
        }
        $ids = rtrim($ids, ",");

        $stid = oci_parse(DBConnection::get_connection(), 'SELECT * FROM Towary WHERE id_towaru IN(' . $ids . ')');
        oci_execute($stid);

        oci_fetch_all($stid, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        foreach ($res as &$item) {
            foreach ($cart as $id => $ilosc) {
                if ($item['ID_TOWARU'] == $id) {
                    $item['ILOSC'] = $ilosc;
                }
            }
        }

        return $res;
    }
}