<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxga
 * Date: 10.01.2019
 * Time: 20:59
 */

class DbConncection
{
    static function get_connection()
    {
        $config = include('config.php');
        $conn = oci_connect($config['db_user'], $config['db_password'], $config['DbConncection']);

        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        return $conn;
    }
}

