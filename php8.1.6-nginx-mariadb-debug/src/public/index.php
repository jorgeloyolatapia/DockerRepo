<?php
    $servername = "mariadb";
    $username = "usertest";
    $password = "usertestpwd";
    $dbname = "dbtest";

    
    $myPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $attributes = array(
        "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
        "ORACLE_NULLS", "PERSISTENT", "SERVER_INFO", "SERVER_VERSION"
    );
    
    foreach ($attributes as $val) {
        echo "PDO::ATTR_$val: ";
        var_dump($myPDO->getAttribute(constant("PDO::ATTR_$val")));
        echo PHP_EOL;
    }

    