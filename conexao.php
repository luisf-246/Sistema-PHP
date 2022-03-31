<?php

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'login';

    $conexao = mysqli_connect($host, $user, $password, $dbname);

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
?>