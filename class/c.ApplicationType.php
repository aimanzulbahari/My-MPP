<?php

class ApplicationType {

    public static function ajaxclick($get = '') {
        $idform = 'ApplicationType';
        $divajax = 'divApplicationType';
        $urlajax = Db::CFAjax('ApplicationType', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'ref_application_type';
            $semak = chkwajib($_POST, 'rat_desc,rat_status_ind');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "rat_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "rat_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewApplicationType::form_ApplicationType(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'ref_application_type';
        $field = 'rat_id,rat_desc,rat_status_ind';
        $condition = "1=1";
            $order = 'rat_id';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>