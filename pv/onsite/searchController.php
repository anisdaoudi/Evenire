<?php

function invokeSearch($method, $function, $query) {
    if ($method === "GET") {
        if (count($function) === 0) {
            globalSearch($query);
        }
    } else {
        badMethod();
    }
}

function globalSearch($query) {
    $data = [
        "user" => [],
        "project" => [],
        "volume" => []
    ];

    $search = $query["v"] ?? null;
    $short = isset($query["short"]) && $query["short"] === '1';

    if (!$search) {
        success($data);
    }

    if ($search[0] === '#') {
        $data["project"] = projectSearch(substr($search, 1), $short);
    } elseif ($search[0] === '@') {
        $data["user"] = userSearch(substr($search, 1), $short);
    } elseif (!$short && substr($search, 0, 7) === 'author:') {
        $data['project'] = projetSearchByAuthor(substr($search, 7));
    } elseif (!$short && substr($search, 0, 7) === 'likeby:') {
        $data['volume'] = projectLikeByUser(substr($search, 7));
    } else {
        $data["user"] = userSearch($search, $short);
        $data["project"] = projectSearch($search, $short);
    }
    success($data);
}

function userSearch($v, $short): array {
    $req = getDB()->get_pdo()->prepare(
        'SELECT id, username, avatar FROM PAE_USER WHERE username LIKE :username ORDER BY LOCATE(:username_short, username) LIMIT ' . ($short ? '5' : '50')
    );
    $req->execute([
        "username" => '%' . $v . '%',
        "username_short" => $v
    ]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function projectSearch($v, $short): array {
    $req = getDB()->get_pdo()->prepare(
        'SELECT id, title' . ($short ? '' : ', picture') . ' FROM PAE_PROJECT WHERE title LIKE :title ORDER BY LOCATE(:title_short, title) LIMIT ' . ($short ? '5' : '50')
    );
    $req->execute([
        "title" => '%' . $v . '%',
        "title_short" => $v
    ]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function projetSearchByAuthor($v): array {
    if ($v === 'me' && getLogUser()->isConnected()) {
        $v = getLogUser()->getId();
    }
    return getDB()->select(TABLE_PROJECT, ['id', 'title', 'picture'], ['author' => $v]);
}

function projectLikeByUser($v): array {
    if ($v === 'me' && getLogUser()->isConnected()) {
        $v = getLogUser()->getId();
    }
    return getDB()->selectSetSettings("SELECT PV.project, PV.volume, title, picture FROM PAE_VOLUME_READING R LEFT JOIN PAE_VOLUME PV on R.fk_project = PV.project and R.fk_volume = PV.volume", ['user_id' => $v, 'is_negative' => '0']);
}
