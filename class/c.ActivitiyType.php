<?php

class ActivitiyType {

    public static function ajaxclick($get = '') {
        $idform = 'ActivitiyType';
        $divajax = 'divActivitiyType';
        $urlajax = Db::CFAjax('ActivitiyType', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'ref_activity_type';
            $semak = chkwajib($_POST, 'ract_desc,ract_status_ind');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "ract_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "ract_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewActivitiyType::form_ActivitiyType(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'ref_activity_type';
        $field = 'ract_id,ract_desc,ract_status_ind';
        $condition = "1=1";
            $order = 'ract_desc';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>