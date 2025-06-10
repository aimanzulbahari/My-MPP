<?php

class ViewApplicationClass
{

    public static function form_ApplicationClass($request)
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
            /* Custom styling for the form */
            .form-section-header h5 {
                font-weight: 600;
                margin-bottom: 5px;
            }

            .form-divider {
                margin-top: 5px;
                margin-bottom: 20px;
                border-color: #e0e0e0;
            }

            .control-label {
                font-weight: 500;
                color: #555;
            }

            .control-label i {
                margin-right: 5px;
                width: 14px;
                text-align: center;
            }

            .input-group-addon {
                background-color: #f8f9fa;
                border-color: #ddd;
                color: #666;
            }

            .form-control:focus {
                border-color: #66afe9;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
            }

            .help-block small {
                font-style: italic;
            }

            .panel-inverse .panel-heading {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-color: #667eea;
            }

            .panel-inverse .panel-title {
                color: white;
                font-weight: 500;
            }

            .panel-inverse .panel-title i {
                margin-right: 8px;
            }

            textarea.form-control {
                resize: vertical;
                min-height: 80px;
            }

            .btn-lg {
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .text-primary {
                color: #337ab7 !important;
            }

            .text-success {
                color: #5cb85c !important;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .form-horizontal .control-label {
                    text-align: left;
                    margin-bottom: 5px;
                }

                .form-horizontal .form-group {
                    margin-left: 0;
                    margin-right: 0;
                }

                .btn-lg {
                    width: 100%;
                    margin-bottom: 10px !important;
                }
            }
        </style>

        <div class="container-fluid">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <!-- Panel Heading Start -->
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a onclick="<?php echo ApplicationClass::ajaxclick() ?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        </div>
                        <h4 class="panel-title">
                            <i class="fa fa-file-text-o"></i>
                            <?php echo lbl('Borang Permohonan Program Aktiviti') ?>
                        </h4>
                    </div>
                    <!-- Panel Heading End -->

                    <div class="panel-body">
                        <!-- Header Start -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-section-header">
                                    <h5 class="text-primary"><i class="fa fa-info-circle"></i><?php echo lbl("MAKLUMAT PERMOHONAN") ?></h5>
                                    <hr class="form-divider">
                                </div>
                            </div>
                        </div>
                        <!-- Header End -->

                        <!-- Form Group First - Start -->
                        <div class="form-group">
                            <!-- No.Permohonan -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-hashtag text-muted"></i>
                                <?php echo lbl('No.Permohonan') ?>
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                                    <input name="ad_ref_no" value="<?php echo @$ad_ref_no ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <!-- No.Permohonan -->

                            <!-- No.Fail -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-folder-o text-muted"></i>
                                <?php echo lbl('No Fail :') ?>
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-folder"></i></span>
                                    <input name="ad_file_no" value="<?php echo @$ad_file_no ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_ad_file_no) ?>">
                                </div>
                            </div>
                            <!-- No.Fail -->
                        </div>
                        <!-- Form Group First - Start -->

                        <!-- Form Group Second - Start -->
                        <div class="form-group">
                            <!-- Senarai MPP -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-map-marker text-muted"></i>
                                <?php echo lbl('MPP Zone : ') ?>
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                                    <?php
                                    $sql = "SELECT rzl_id, rzl_desc FROM mympp.ref_zone_list where rzl_status_ind = 1 order by rzl_id";
                                    Db::droplist($sql, 'ad_mpp_zone', 'rzl_id', 'rzl_desc', @$ad_mpp_zone, $class = 'form-control ' . FwSemak::alert_semak(@$chk_ad_mpp_zone), $others = '', $null = 'Sila Pilih Zon MPP');
                                    ?>
                                </div>
                            </div>
                            <!-- Senarai MPP -->

                            <!-- Jenis Permohonan -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-list text-muted"></i>
                                <?php echo lbl('Jenis Permohonan : ') ?>
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                    <?php
                                    $sql = "SELECT rat_id, rat_desc FROM mympp.ref_application_type where rat_status_ind = 1 order by rat_id";
                                    Db::droplist($sql, 'ad_application_type', 'rat_id', 'rat_desc', @$ad_application_type, $class = 'form-control ' . FwSemak::alert_semak(@$chk_ad_application_type), $others = '', $null = 'Sila Pilih Jenis Permohonan');
                                    ?>
                                </div>
                            </div>
                            <!-- Jenis Permohonan -->
                        </div>
                        <!-- Form Group Second - End -->

                        <!-- Form Group Third - Start -->
                        <div class="form-group">
                            <!-- Butiran Permohonan -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-align-left text-muted"></i>
                                <?php echo lbl('Butiran Permohonan : ') ?>
                            </label>
                            <div class="col-md-10">
                                <textarea name="ad_detail_application" rows="4" class="form-control <?php echo FwSemak::alert_semak(@$chk_ad_detail_application) ?>" placeholder="Sila nyatakan butiran permohonan anda..."><?php echo @$ad_detail_application ?></textarea>
                                <span class="help-block"><small class="text-muted">Terangkan dengan jelas tujuan dan keperluan permohonan anda</small></span>
                            </div>
                            <!-- Butiran Permohonan -->
                        </div>
                        <!-- Form Group Third - End -->

                        <!-- Form Group Fourth - Start -->
                        <div class="form-group">
                            <!-- Tarikh Permohonan -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-calendar text-muted"></i>
                                <?php echo lbl('Tarikh Permohonan : ') ?>
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input type="date" name="ad_request_date" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker <?php echo FwSemak::alert_semak(@$chk_ad_request_date) ?>">
                                </div>
                            </div>
                            <!-- Tarikh Permohonan -->

                            <!-- Jumlah RM -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-money text-muted"></i>
                                <?php echo lbl('Jumlah RM :') ?>
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">RM</span>
                                    <input type="number" name="ad_total" value="<?php echo @$ad_total ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_ad_total) ?>" placeholder="0.00" step="0.01">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                            <!-- Jumlah RM -->
                        </div>
                        <!-- Form Group Fourth - End -->

                        <!-- Activity Information Section - Start -->
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-12">
                                <div class="form-section-header">
                                    <h5 class="text-success"><i class="fa fa-calendar-check-o"></i><?php echo lbl('MAKLUMAT AKTIVITI') ?></h5>
                                    <hr class="form-divider">
                                </div>
                            </div>
                        </div>
                        <!-- Activity Information Section - End -->

                        <!-- Form Group Fifth - Start -->
                        <div class="form-group">
                            <!-- Tarikh Aktiviti -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-calendar text-muted"></i>
                                <?php echo lbl('Tarikh Aktiviti :') ?>
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>
                                    <input type="date" name="ad_activitiy_date" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker <?php echo FwSemak::alert_semak(@$chk_ad_activitiy_date) ?>">
                                </div>
                            </div>
                            <!-- Tarikh Aktiviti -->

                            <!-- Jenis Aktiviti -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-tags text-muted"></i>
                                <?php echo lbl('Jenis Aktiviti : ') ?>
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <?php
                                    $sql = "SELECT ract_id, ract_desc FROM mympp.ref_activity_type WHERE ract_status_ind = 1";
                                    Db::droplist($sql, 'ad_activity_type', 'ract_id', 'ract_desc', @$ad_activity_type, $class = 'form-control ' . FwSemak::alert_semak(@$chk_ad_activity_type), $others = '', $null = 'Sila Pilih Jenis Aktiviti');
                                    ?>
                                </div>
                            </div>
                            <!-- Jenis Aktiviti -->
                        </div>
                        <!-- Form Group Fifth - Start -->

                        <!-- Form Group Sixth - Start -->
                        <div class="form-group">
                            <!-- SDG -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-globe text-muted"></i>
                                <?php echo lbl('SDG : ') ?>
                            </label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-leaf"></i></span>
                                    <?php
                                    $sql = "SELECT rst_id, rst_desc FROM mympp.ref_sdg_type WHERE rst_status_ind = 1";
                                    Db::droplist($sql, 'ad_sdg_type', 'rst_id', 'rst_desc', @$ad_sdg_type, $class = 'form-control ' . FwSemak::alert_semak(@$chk_ad_sdg_type), $others = '', $null = 'Sila Pilih Jenis SDG');
                                    ?>
                                </div>
                                <span class="help-block"><small class="text-muted">Sustainable Development Goals - Pilih matlamat pembangunan lestari yang berkaitan</small></span>
                            </div>
                            <!-- SDG -->
                        </div>
                        <!-- Form Group Sixth - End -->

                        <!-- Form Group Seventh - Start -->
                        <div class="form-group">
                            <!-- Butiran Aktiviti -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-list-alt text-muted"></i>
                                <?php echo lbl('Butiran Aktiviti : ') ?>
                            </label>
                            <div class="col-md-10">
                                <textarea name="ad_detail_activity" rows="4" class="form-control <?php echo FwSemak::alert_semak(@$chk_ad_detail_activity) ?>" placeholder="Terangkan aktiviti yang akan dijalankan..."><?php echo @$ad_detail_activity ?></textarea>
                                <span class="help-block"><small class="text-muted">Nyatakan objektif, sasaran peserta, dan cara pelaksanaan aktiviti</small></span>
                            </div>
                            <!-- Butiran Aktiviti -->
                        </div>
                        <!-- Form Group Seventh - End -->

                        <!-- Form Group Eight - Start -->
                        <div class="form-group">
                            <!-- Butiran Gambar -->
                            <label class="col-md-2 control-label">
                                <i class="fa fa-camera text-muted"></i>
                                <?php echo lbl('Gambar Aktiviti : ') ?>
                            </label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-upload"></i></span>
                                    <input type="file" name="ad_ref_no" value="<?php echo @$ad_ref_no ?>" class="form-control" accept="image/*">
                                </div>
                                <span class="help-block"><small class="text-muted">Format yang diterima: JPG, PNG, GIF (Max: 5MB)</small></span>
                            </div>
                        </div>
                        <!-- Form Group Eight - End -->

                        <div class="form-group">
                            <div class="col-md-12">
                                <center>
                                    <?php
                                    if (@$edit != '') {
                                        $btn_act = '&update=' . $edit;
                                        $lbl_act = 'Update';
                                    } else {
                                        $btn_act = '&save=1';
                                        $lbl_act = 'Simpan Permohonan';
                                    }
                                    ?>
                                    <a onclick="<?php echo ApplicationClass::ajaxclick($btn_act) ?>;" class="btn btn-primary">
                                        <i class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?>
                                    </a>
                                    <a onclick="<?php echo ApplicationClass::ajaxclick('&draft=1') ?>;" class="btn btn-info">
                                        <i class="fa fa-pencil-square-o bigger-120"></i> Simpan Draf
                                    </a>
                                    <a onclick="<?php echo ApplicationClass::ajaxclick() ?>;" class="btn btn-warning">
                                        <i class="fa fa-times bigger-120"></i> Batal Permohonan
                                    </a>
                                </center>
                            </div>
                        </div>
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
