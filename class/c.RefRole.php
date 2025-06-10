<?php

class RefRole {

    public static function ajaxclick($get = '') {
        $idform = 'RefRole';
        $divajax = 'divRefRole';
        $urlajax = Db::CFAjax('RefRole', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'ref_role';
            $semak = chkwajib($_POST, 'rr_acronym,rr_description,rr_status_ind');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "rr_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "rr_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewRefRole::form_RefRole(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'ref_role';
        $field = 'rr_id,rr_acronym,rr_description,rr_status_ind';
        $condition = "1=1";
            $order = 'rr_id';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>