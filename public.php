<?php
require_once 'setting.php';
pr($_REQUEST);
if ($_GET['do'] != '') {
    $public = 1;
    ?>
    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en">
        <!--<![endif]-->
        <head>
            <meta charset="utf-8" />
            <title>iDEC | SEAShell 4.0 </title>
            <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
            <meta content="" name="description" />
            <meta content="" name="author" />

            <!-- ================== BEGIN TEMPLATE CSS ================== -->
    <?php require_once 'allcss.php'; ?>
            <!-- ================== END TEMPLATE CSS ================== -->

            <!-- ================== BEGIN JQUERY JS ================== -->
            <script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="framework/plugin/tableExportMaster/xls.core.min.js"></script>
            <script type="text/javascript" src="framework/plugin/tableExportMaster/Blob.min.js"></script>
            <script type="text/javascript" src="framework/plugin/tableExportMaster/FileSaver.min.js"></script>
            <script type="text/javascript" src="framework/plugin/tableExportMaster/tableexport.min.js"></script>
            <!-- ================== END JQUERY JS ================== -->

            <!-- ================== BEGIN SEAShell JS ================== -->
            <script src="framework/js/fw.js"></script>
            <!-- ================== END SEAShell JS ================== -->

            <!-- ================== BEGIN Angular JS ================== -->
            <script src="assets/js/angular.min.js"></script>
            <!-- ================== END Angular JS ================== -->

            <!-- ===================== BEGIN loading for ajax process =========================== -->
            <style>
                #fade_loading {
                    display: none;
                    position:absolute;
                    top: 0%;
                    left: 0%;
                    width: 100%;
                    height: 100%;
                    background-color: #ababab;
                    z-index: 1001;
                    -moz-opacity: 0.8;
                    opacity: .70;
                    filter: alpha(opacity=80);
                }

                #modal_loading {
                    display: none;
                    position: absolute;
                    top: 40%;
                    left: 30%;
                    width: 350px;
                    height: 150px;
                    border-radius:20px;
                    z-index: 1002;
                    text-align:center;
                    overflow: auto;
                }
            </style>
            <!-- ===================== END loading for ajax process =========================== -->

        </head>
        <body>    
            <?php
            //$do = dmenu(123, strrev($_GET['do']));
            $do = $_GET['do'];

            $fail = "$do.php";

            if (file_exists($fail)) {
                include("$fail");
            } else {
                alert("Refresh & back button is not allowed for security reason.");
                gopage('index.php');
            }
            ?>
        </body>
    </html>
    <?php
}
?>