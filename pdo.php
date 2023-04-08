<?php
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::MYSQL_ATTR_SSL_CA => './DigiCertGlobalRootCA.crt.pem',
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
);
$pdo = new PDO('mysql:host=eveniredbserver.mysql.database.azure.com:3306;dbname=eveniredb', 'evenireroot', 'Respons11!',$options);
