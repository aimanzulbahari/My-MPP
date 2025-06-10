<?php

class ApplicationList {

    public static function ajaxclick($get = '') {
        $idform = 'ApplicationList';
        $divajax = 'divApplicationList';
        $urlajax = Db::CFAjax('ApplicationList', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'application_data';
            

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "ad_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "ad_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewApplicationList::form_ApplicationList(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'application_data';
        $field = 'ad_id,ad_ref_no,ad_mpp_zone,ad_application_type,ad_file_no,ad_detail_application,ad_request_date,ad_total,ad_activitiy_date,ad_activity_type,ad_sdg_type,ad_detail_activity,ad_status_process';
        $condition = "1=1";
            $order = 'ad_ref_no';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

    public static function StatusProcess() {
        $table = 'ref_process';
        $field = 'rp_id,rp_desc';
        $condition = "1=1 ORDER BY rp_id";
        return Db::data_list($table, $field, $condition, 'Y');
    }

}
?>