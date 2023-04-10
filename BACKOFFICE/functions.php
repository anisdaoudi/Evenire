<?php

function isAdmin($role){
    if($role){
        return 'Admin';
    }else{
        return 'utilisateur';
    }
}