<?php

function writeLogLine($success, $email){
    $log = fopen('log.txt', 'a+');
    $line = date('Y/m/d - H:i:s') . ' - Tentative de connexion' . ($success?'réussie':'échouée') . 'de : ' . $email . "\n";
    fputs($log, $line);
    fclose($log);
}