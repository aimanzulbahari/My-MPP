<?php

class SdgType {

    public static function ajaxclick($get = '') {
        $idform = 'SdgType';
        $divajax = 'divSdgType';
        $urlajax = Db::CFAjax('SdgType', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'ref_sdg_type';
            $semak = chkwajib($_POST, 'rst_desc,rst_status_ind');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "rst_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "rst_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewSdgType::form_SdgType(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'ref_sdg_type';
        $field = 'rst_id,rst_desc,rst_status_ind';
        $condition = "1=1";
            $order = 'rst_desc';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>