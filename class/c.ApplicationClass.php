<?php

class ApplicationClass
{

    public static function ajaxclick($get = '')
    {
        $idform = 'ApplicationClass';
        $divajax = 'divApplicationClass';
        $urlajax = Db::CFAjax('ApplicationClass', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data)
    {
        pr($data);
        if (is_array($data)) {
            extract($data);
            $currUser = $_SESSION[$GLOBALS['fw_sistem']]['username'];
            $table = 'application_data';

            // Validate form (only needed for non-drafts)
            $semak = chkwajib($_POST, 'ad_mpp_zone,ad_application_type,ad_file_no,ad_detail_application,ad_request_date,ad_total,ad_activitiy_date,ad_activity_type,ad_sdg_type,ad_detail_activity');

            // Handle Save as Draft (ad_status_process = 1)
            if (@$draft) {
                $data['ad_status_process'] = 1; // 1 = Draf
                $data['ad_insert_by'] = $currUser;
                $data['ad_insert_timestamp'] = date('Y-m-d h:i:sa');
                Db::insert_all($table, $data, 'Y');
                unset($data);
            }

            // Handle Save / Submit (ad_status_process = 3) or Update
            if (@$save || isset($data['update'])) {
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);
                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    $data['ad_status_process'] = 3; // 3 = Hantar

                    if (@$save) {
                        $data['ad_insert_by'] = $currUser;
                        $data['ad_insert_timestamp'] = date('Y-m-d h:i:sa');
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "ad_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            // Handle Delete
            if (isset($data['del'])) {
                $condition = "ad_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewApplicationClass::form_ApplicationClass(@$data);
    }

    public static function sql_datalist($request)
    {
        $table = 'application_data';
        $field = 'ad_id,ad_ref_no,ad_mpp_zone,ad_application_type,ad_file_no,ad_detail_application,ad_request_date,ad_total,ad_activitiy_date,ad_activity_type,ad_sdg_type,ad_detail_activity,ad_status_process';
        $condition = "1=1 ORDER BY ad_ref_no";;
        return Db::data_list($table, $field, $condition, 'Y');
    }
}
