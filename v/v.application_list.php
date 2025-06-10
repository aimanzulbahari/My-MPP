<?php

class ViewApplicationList
{

    public static function form_ApplicationList($request)
    {
        global $today;

        $semak = FwSemak::semak(@$request['semak'], @$request['save'], @$request['update']);
        if (is_array($semak)) {
            $request = array_merge($request, $semak);
            extract($request);
            extract($semak);
        }
?>
        <style>

        </style>

        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a onclick="<?php echo ApplicationList::ajaxclick() ?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('Senarai Permohonan') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $dataall = ApplicationList::sql_listgrid($request);
                        Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], ApplicationList::ajaxclick(), array(4, 6, 2));
                        ?>
                        <table class="table table-hover">
                            <thead class="title">
                                <tr>
                                    <th style="text-transform: uppercase;"><?php echo lbl('#') ?></th>
                                    <th style="text-transform: uppercase;"><?php echo lbl('No. Permohonan') ?></th>
                                    <th style="text-transform: uppercase;"><?php echo lbl('No. Fail') ?></th>
                                    <th style="text-transform: uppercase;"><?php echo lbl('Jenis Permohonan') ?></th>
                                    <th style="text-transform: uppercase;"><?php echo lbl('MPP Zon') ?></th>
                                    <th style="text-transform: uppercase;"><?php echo lbl('Tarikh Permohonan') ?></th>
                                    <th style="text-transform: uppercase;"><?php echo lbl('Tarikh Aktiviti') ?></th>
                                    <th style="text-transform: uppercase;"><?php echo lbl('Status Permohonan') ?></th>
                                    <th width="10%" style="text-transform: uppercase;"><?php echo lbl('Tindakan') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (@$request['add'] == 1) {
                                ?>
                                    <tr>
                                        <?php ViewApplicationList::form_add_edit(@$request); ?>
                                        <td>
                                            <a onclick="<?php echo ApplicationList::ajaxclick("&save=1") ?>;" class="btn btn-xs btn-primary"><i class="fa fa-save bigger-120"></i></a>
                                            <a onclick="<?php echo ApplicationList::ajaxclick() ?>;" class="btn btn-xs btn-warning"><i class="fa fa-times bigger-120"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                $count = 1;
                                if (is_array($dataall['fw_senarai'])) {
                                    foreach ($dataall['fw_senarai'] as $row => $value) {
                                        extract($value);
                                        if (!is_array(@$semak)) {
                                            if (is_array($request)) {
                                                $request = array_merge($request, $value);
                                            }
                                        }
                                    ?>
                                        <tr <?php if (@$request['edit'] == @$ad_id) {
                                                echo 'class="active"';
                                            } ?>>
                                            <?php
                                            if (@$request['edit'] == @$ad_id) {
                                                ViewApplicationList::form_add_edit(@$request);
                                                $cls_icon = 'fa-save';
                                                $cls_btn = 'btn-primary';
                                                $btn_act = 'update';
                                            } else {
                                            ?>
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $ad_ref_no ?></td>
                                                <td><?php echo $ad_file_no ?></td>
                                                <td>
                                                    <?php
                                                    $type_desc = Db::chkval('mympp.ref_application_type', 'rat_desc', "rat_id='$ad_application_type'");

                                                    // Default color
                                                    $badge_style = 'background-color: #adb5bd;'; // Lain-Lain

                                                    switch ((int)$ad_application_type) {
                                                        case 1: // Wang Pendahuluan
                                                            $badge_style = 'background-color: #20c997;';
                                                            break;
                                                        case 2: // Sumbangan
                                                            $badge_style = 'background-color: #6f42c1;';
                                                            break;
                                                        case 3: // Tuntutan Bayaran Balik
                                                            $badge_style = 'background-color: #fd7e14;';
                                                            break;
                                                        case 4: // Lain-Lain
                                                            $badge_style = 'background-color: #adb5bd;';
                                                            break;
                                                        default:
                                                            $badge_style = 'background-color: #adb5bd;';
                                                            break;
                                                    }

                                                    echo "<span class='badge' style='$badge_style; color: white;'>$type_desc</span>";
                                                    ?>
                                                </td>

                                                <td><?php echo Db::chkval('mympp.ref_zone_list', 'rzl_desc', "rzl_id='$ad_mpp_zone'") ?></td>
                                                <td><?php echo $ad_request_date ?></td>
                                                <td><?php echo $ad_activitiy_date ?></td>
                                                <td>
                                                    <?php
                                                    $status_desc = Db::chkval('mympp.ref_process', 'rp_desc', "rp_id='$ad_status_process'");

                                                    // Define custom colors for each status
                                                    $badge_style = 'background-color: #6c757d;'; // Default: Draf

                                                    switch ($ad_status_process) {
                                                        case 1: // Draf
                                                            $badge_style = 'background-color: #6c757d;';
                                                            break;
                                                        case 2: // Dalam Proses Semakan
                                                            $badge_style = 'background-color: #007bff;';
                                                            break;
                                                        case 3: // Hantar
                                                            $badge_style = 'background-color: #fd7e14;';
                                                            break;
                                                        case 4: // Lulus
                                                            $badge_style = 'background-color: #28a745;';
                                                            break;
                                                        case 5: // Batal
                                                            $badge_style = 'background-color: #dc3545;';
                                                            break;
                                                    }

                                                    echo "<span class='badge' style='$badge_style; color: white;'>$status_desc</span>";
                                                    ?>
                                                </td>

                                            <?php
                                                $cls_icon = 'fa-pencil';
                                                $cls_btn = 'btn-info';
                                                $btn_act = 'edit';
                                                $count++;
                                            }
                                            ?>
                                            <td>
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Kemaskini Permohonan" class="btn btn-xs  <?php echo $cls_btn ?>" onclick="<?php echo ApplicationList::ajaxclick("&$btn_act=$ad_id") ?>">
                                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                </button>
                                                <?php
                                                if (@$request['edit'] == @$ad_id) {
                                                ?>
                                                    <button type="button" class="btn btn-xs btn-warning" onclick="<?php echo ApplicationList::ajaxclick() ?>">
                                                        <i class="fa fa-close bigger-120"></i>
                                                    </button>
                                                <?php
                                                } else { ?>
                                                    <button type="button" data-toggle="tooltip" data-placement="top" title="Papar Permohonan" class="btn btn-xs btn-warning" onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo ApplicationList::ajaxclick("&del=$ad_id") ?>">
                                                        <i class="fa fa-eye bigger-120"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    public static function form_add_edit($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        if (is_array(@$semak)) {
            $data = array_merge($data, $semak);
            extract($data);
            extract($semak);
        }
    ?>
<?php
    }
}
