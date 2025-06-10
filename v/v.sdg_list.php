<?php

class ViewSdgType {

    public static function form_SdgType($request) {
        global $today;

        $semak = FwSemak::semak(@$request['semak'], @$request['save'], @$request['update']);
        if (is_array($semak)){
            $request = array_merge($request,$semak);
            extract($request);
            extract($semak);
        }
        ?>
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a onclick="<?php echo SdgType::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('Senarai SDG') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <?php
                            $dataall = SdgType::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], SdgType::ajaxclick(), array(4, 6, 2));
                            ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th><?php echo lbl('#') ?></th>
                            <th><?php echo lbl('Description') ?></th>
                            <th><?php echo lbl('Status') ?></th>
                            <th width="10%">
                                <?php if (!@$request['edit']){ ?>
                                <button type="button" class="btn btn-xs btn-success" onclick="<?php echo SdgType::ajaxclick("&add=1")?>">
                                    <i class="fa fa-plus-circle"></i> <?php echo lbl('TAMBAH') ?>
                                </button> 
                                <?php } ?>
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                if (@$request['add'] == 1) {
                                    ?>
                                    <tr>
                                        <?php ViewSdgType::form_add_edit(@$request); ?>
                                         <td>
                                            <a onclick="<?php echo SdgType::ajaxclick("&save=1")?>;" class="btn btn-xs btn-primary"><i class="fa fa-save bigger-120"></i></a>
                                            <a onclick="<?php echo SdgType::ajaxclick()?>;" class="btn btn-xs btn-warning"><i class="fa fa-times bigger-120"></i></a>
                                        </td>
                                    </tr>    
                                <?php
                                }
                                $count = 1;
                                if (is_array($dataall['fw_senarai'])) {
                                    foreach ($dataall['fw_senarai'] AS $row => $value) {
                                        extract($value);
                                        if (!is_array(@$semak)){ 
                                            if(is_array($request)){
                                            $request = array_merge($request, $value);
                                            }
                                        }
                                        ?>    
                                        <tr <?php if (@$request['edit'] == @$rst_id) { echo 'class="active"'; } ?>>
                                                <?php
                                                if (@$request['edit'] == @$rst_id) {
                                                    ViewSdgType::form_add_edit(@$request); 
                                                    $cls_icon = 'fa-save';
                                                    $cls_btn = 'btn-primary';
                                                    $btn_act = 'update';
                                                } else {
                                                    ?>
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $rst_desc ?></td>
                                                    <td><?php echo Db::chkval('mympp.ref_status', 'rs_ind_desc', "rs_id='$rst_status_ind'") ?></td>
                                                            
                                                    <?php
                                                    $cls_icon = 'fa-pencil';
                                                    $cls_btn = 'btn-info';
                                                    $btn_act = 'edit';
                                                    $count++;
                                                }
                                                ?>
                                            <td>
                                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo SdgType::ajaxclick("&$btn_act=$rst_id")?>">
                                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                </button>
                                                <?php
                                                if (@$request['edit'] == @$rst_id) {
                                                    ?>
                                                    <button type="button" class="btn btn-xs btn-warning" onclick="<?php echo SdgType::ajaxclick() ?>">
                                                        <i class="fa fa-close bigger-120"></i>
                                                    </button>
                                                    <?php
                                                } else { ?>
                                                <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo SdgType::ajaxclick("&del=$rst_id")?>">
                                                    <i class="fa fa-trash bigger-120"></i>
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
                            </tbody> </table> 
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    public static function form_add_edit($data) {
        if (is_array($data)) {
            extract($data);
        }
        if (is_array(@$semak)){
            $data = array_merge($data,$semak);
            extract($data);
            extract($semak);
        }
        ?>
        <td><?php echo  $count ?></td>
        <td><input name="rst_desc" value="<?php echo @$rst_desc ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_rst_desc) ?>"></td>
        <td>
            <?php
            $sql = "SELECT rs_id, rs_ind_desc FROM mympp.ref_status";
            Db::droplist($sql, 'rst_status_ind', 'rs_id', 'rs_ind_desc', @$rst_status_ind, $class = 'form-control ' . FwSemak::alert_semak(@$chk_rst_status_ind), $others = '', $null = '');
            ?>
        </td>
        
        <?php
    }

}
