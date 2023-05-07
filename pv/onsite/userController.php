<?php
function invokeUser($method, $function, $query) {
    if ($method === "GET") {
        if (count($function) === 1) {
            if ($function[0] === 'all') {
                _admin_fetch_user($query);
            } else {
                _get_user($function[0], $query);
            }
        }
    } elseif ($method === "POST") {
        if (count($function) === 1) {
            switch ($function[0]) {
                case 'permission': 
                    _admin_change_permission(); 
                    break;
                case 'delete': 
                    _user_delete_self(); 
                    break;
                case 'forget-password': 
                    _forget_password(); 
                    break;
                default: 
                    break;
            }
        } elseif (count($function) === 2 && $function[0] === "edit") {
            switch ($function[1]) {
                case 'email': 
                    _change_user_email(); 
                    break;
                case 'username': 
                    _change_user_pseudo(); 
                    break;
                case 'birthday': 
                    _change_user_birthday(); 
                    break;
                case 'password': 
                    _change_user_password(); 
                    break;
                case 'avatar': 
                    _change_user_avatar(); 
                    break;
                default: 
                    break;
            }
        }
    } else {
        bad_method();
    }
}

/**
 * Récupère les utilisateurs publics
 * Permission : ALL
 * @version 1.0.0
 * @api GET /user/all
 * @param array $query Paramètres optionnels : 'limit', 'offset', 'order', 'reverse'
 * @throws BadRequestException si l'utilisateur n'est pas valide
 * @author Alice.B
 */
function _admin_fetch_user($query) {
    admin_fetch(TABLE_USER, ['id', 'username', 'email', 'birthday', 'status', 'permission', 'date_updated', 'date_inserted'], $query, 'id', ['username', 'email', 'permission']);
}

/**
 * recupere l'utilisateur public ou l'utilisateur connecté lui-même
 * Permission : ALL
 * @version 1.0.0
 * @api GET /user/{userID}
 * @param string $userid ID de l'utilisateur à récupérer ou "ME" pour l'utilisateur connecté lui-même
 * @param array $query Paramètres optionnels : 'pdf'
 * @throws BadRequestException si l'utilisateur n'est pas valide
 * @throws UnauthorizedException si l'utilisateur n'est pas autorisé à récupérer les données
 * @throws \Mpdf\MpdfException si l'objet Mpdf ne peut pas être créé
 * @throws \InvalidArgumentException si un argument est invalide
 * @throws \Throwable si une exception est levée
 * @throws \PDOException si une erreur SQL se produit
 * @throws \Exception si une exception générique est levée
 * @throws \Error si une erreur PHP est levée
 * @throws \TypeError si un type de variable est incorrect
 * @throws \LogicException si une erreur de logique se produit
 * @throws \LengthException si une chaîne est trop longue
 * @throws \RangeException si une valeur est hors de la plage autorisée
 * @throws \DomainException si une erreur de domaine se produit
 * @throws \OutOfBoundsException si une valeur est hors des limites autorisées
 * @throws \OverflowException si une valeur dépasse la taille maximale autorisée
 * @throws \UnderflowException si une valeur est inf
