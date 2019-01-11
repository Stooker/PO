<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxga
 * Date: 10.01.2019
 * Time: 20:57
 */
require_once('DbConncection.php');
class Product
{
    private $con;

    /**
     * Product constructor.
     */
    public function __construct()
    {

        $this->con = DbConncection::get_connection();
    }


    function get_list(){
        $stid = oci_parse($this->con, 'SELECT zdjecie, nazwa_towaru, cena_netto, ilosc_na_stanie, procent_vat,  id_towaru   FROM Towary');
        oci_execute($stid);

        oci_fetch_all($stid, $res, 0, -1,OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        return $res;
    }

    static function calc_bruttto($netto, $vat){
        $brutto = $netto*$vat/100+$netto;
        return $brutto;
    }

    function get_details($id){

        $stid = oci_parse($this->con, 'SELECT zdjecie, nazwa_towaru, opis, cena_netto, procent_vat  FROM Towary WHERE id_towaru ='.$id);
        oci_execute($stid);

        oci_fetch_all($stid, $res, 0, -1,OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        return $res[0];
    }
}


