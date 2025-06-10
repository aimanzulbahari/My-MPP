<?php
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
$today = date("Y-m-d H:i:s");

require_once "include.php";

$server = str_replace("www.", "", $_SERVER["SERVER_NAME"]);

if ($server == $url_local) {
    # localhost
    
    $dbpg1 = array(
        "dbtype" => "pgsql", //mysql , pgsql , oci
        "host" => "localhost",
        "user" => "aiman",
        "password" => "1234",
        "database" => "local_db", // SID atau Service Name u1ntuk Oracle
        "port" => "5432", // default port : Oracle=1521 ; Pg=5432 ; Mysql=3306
        "schema" => "mympp");

    $dbdata["dblatihan"] = $dbpg1;

    $url = $url_local;
} elseif ($server == $url_development) {
    # development
    $dbpg1 = array(
        "dbtype" => "pgsql", //mysql , pgsql , oci
        "host" => "172.16.240.17",
        "user" => "training",
        "password" => "xs2DBlatihan",
        "database" => "dblatihan", // SID atau Service Name u1ntuk Oracle
        "port" => "5432", // default port : Oracle=1521 ; Pg=5432 ; Mysql=3306
        "schema" => "public");

    $dbdata["dblatihan"] = $dbpg1;
    $url = $url_development;
} elseif ($server == $url_live) {
    # live
    $dbmysql1 = array(
        "dbtype" => "mysql", //mysql , pgsql , oci
        "host" => "localhost",
        "user" => "",
        "password" => "",
        "database" => "", // SID atau Service Name untuk Oracle
        "port" => "3306", // default port : Oracle=1521 ; Pg=5432 ; Mysql=3306
        "schema" => "");

    $dbdata["mydb"] = $dbmysql1;

    $url = $url_live;
} else {
    echo "Tiada nama server yang sah!";
}

require_once "framework/status.php";

if ($dbname != "") {
    Db::$dbconn = $dbname;
    $conn = Db::conn_db($dbdata);
    Db::$conn = $conn;
    Db::autocreate_fw($dbdata[$dbname]);
} else {
    echo "Sila semak pilihan pangkalan data";
}

$mainpage = "utama";
?>
        