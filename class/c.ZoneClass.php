<?php

class ZoneClass {

    public static function ajaxclick($get = '') {
        $idform = 'ZoneClass';
        $divajax = 'divZoneClass';
        $urlajax = Db::CFAjax('ZoneClass', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'ref_zone_list';
            $semak = chkwajib($_POST, 'rzl_desc,rzl_status_ind');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "rzl_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "rzl_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewZoneClass::form_ZoneClass(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'ref_zone_list';
        $field = 'rzl_id,rzl_desc,rzl_status_ind';
        $condition = "1=1";
            $order = 'rzl_id';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>