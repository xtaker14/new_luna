<?php

    if($_GET['admin-key'] !== 'newluna'){

        return false;

    }

    $serverName = "15.235.160.135,3306"; //serverName\instanceName



    // Since UID and PWD are not specified in the $connectionInfo array,

    // The connection will be attempted using Windows Authentication.

    $connectionInfo = array( 

        "Database" => 'LUNA_MEMBERDB',

        "UID" => 'ASGameSrv', 

        "PWD" => 'GD58762BC5C60G495C869F567769F87G49B3D5G98G36FF07B844FCE372B49E49', 

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