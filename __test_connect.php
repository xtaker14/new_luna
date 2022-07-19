<?php
    if($_GET['admin-key'] !== 'newluna'){
        return false;
    }
    $serverName = "NS544566\SQLEXPRESS"; //serverName\instanceName

    // Since UID and PWD are not specified in the $connectionInfo array,
    // The connection will be attempted using Windows Authentication.
    $connectionInfo = array( 
        "Database" => 'LUNA_MEMBERDB',
        "UID" => 'GameSrvZone', 
        "PWD" => '2GIcGb3lZaBRSQR32aOR9BDGEaGbD140PTdinhunehfKb8B3MurabtBSDgGbme', 
    );
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
        echo "Connection established.<br />";
    }else{
        echo "Connection could not be established.<br />";
        echo '<pre>';
        die( print_r( sqlsrv_errors(), true));
    }
    
    $sql = "SELECT 'test' as name";
    $stmt = sqlsrv_query($conn,$sql);
    if(sqlsrv_fetch($stmt) ===false)
    {
        echo "couldn't fetch data"; 
    }
    $name = sqlsrv_get_field($stmt,0);
    echo $name;
    sqlsrv_close( $conn );
?>