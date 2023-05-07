<?php

/**
 * @throws Exception
 */
function invokeAdmin($method, $function, $query) {
    if (!is_moderator()) {
        forbidden();
    }

    if ($method === "GET") {
        if ($function[0] === "stats") _admin_stats();
        elseif ($function[0] === "log-root") _admin_log_root($query);
        elseif ($function[0] === "picture") _admin_picture($query);
        elseif ($function[0] === "carousel") _admin_carousel($query);
    } elseif ($method === "POST") {
	    if (count($function) === 1 && $function[0] === "carousel") _admin_create_carousel();
	    elseif (count($function) === 3 && $function[0] === "edit" && $function[1] === "carousel") __admin_edit_carousel($function[2], $query);
    }
}

function __admin_edit_carousel($id, $query) {
	if (!$id) bad_request('invalid id');
	if (isset($query['enable']) && $query['enable'] === '1') {
		getDB()->update(TABLE_INDEX_CAROUSEL, ['disable' => 0], ['picture' => $id]);
	} elseif (isset($query['disable']) && $query['disable'] === '1') {
		getDB()->update(TABLE_INDEX_CAROUSEL, ['disable' => 1], ['picture' => $id]);
	}
	if (isset($query['priority'])) {
		$priority = max(-127, min(127, intval($query['priority']?? '0')));
		getDB()->update(TABLE_INDEX_CAROUSEL, ['priority' => $priority], ['picture' => $id]);
	}
	if (isset($query['href'])) {
		$href = urldecode($query['href']);
		if ($href === "") $href = null;
		getDB()->update(TABLE_INDEX_CAROUSEL, ['href' => $href], ['picture' => $id]);
	}
	if (isset($query['title'])) {
		$title = urldecode($query['title']);
		if ($title === "") $href = null;
		getDB()->update(TABLE_INDEX_CAROUSEL, ['title' => $title], ['picture' => $id]);
	}
	success();
}

/**
 * @throws Exception
 */
function _admin_create_carousel() {

	$priority = max(-127, min(127, intval($_POST['priority']?? '0')));
	$href = $_POST['href']??null;
	if ($href === "") $href = null;
	$title = $_POST['title']??null;
	if ($title === "") $title = null;
	$errors = [];
	if ($href !== null && strlen($href) > 255) $errors[] = 'Href trop long max 255';
	if ($title !== null && strlen($title) > 255) $errors[] = 'Titre trop long max 255';
	$img = download_image_from_post('picture', [PICTURE_FORMAT_JPG, PICTURE_FORMAT_PNG, PICTURE_FORMAT_WEBP], 1e7);
	if (empty($errors)) {
		if (is_numeric($img)) {
			switch ($img) {
				case -1:
					$errors[] = "Pas de vignette";
					break;
				case -2:
					$errors[] = "Vignette trop lourde max. 10Mo";
					break;
				default:
					json_exit(500, "Uploading error", "unknown");
					break;
			}
		} else {
			$img->resize(1920, 1080);
			$img->set_author(get_log_user()->getId());
			$img->add_logo(80);
			$img->set_title('Carousel image');
			$img->save();
			getDB()->insert(TABLE_INDEX_CAROUSEL, ['picture' => $img->get_id(), 'title' => $title, 'href' => $href, 'priority' => $priority, 'disable' => true]);
		}
	}

	if (count($errors) > 0) {
		bad_request($errors);
	}
	success();

}

function _admin_log_root($query) {
    admin_fetch(TABLE_LOG_ROOT, ['root', 'visited', 'last'], $query, 'root', ['root']);
}

function _admin_picture($query) {
	admin_fetch(TABLE_PICTURE, ['id', 'author', 'title', 'date_inserted'], $query, 'id', ['id', 'author', 'title']);
}

function _admin_carousel($query) {
	admin_fetch(TABLE_INDEX_CAROUSEL, ['picture', 'href', 'title', 'priority', 'disable', 'date_inserted'], $query, 'picture', ['picture', 'title', 'href']);
}

function _admin_stats() {
    success([
        "project" => getDB()->count(TABLE_PROJECT, "id"),
        "picture" => getDB()->count(TABLE_PICTURE, "id"),
        "user" => getDB()->count(TABLE_USER, "id"),
        "volume" => getDB()->count(TABLE_VOLUME, "data"),
        "log-root" => getDB()->count(TABLE_LOG_ROOT, "root"),
        "carousel" => getDB()->count(TABLE_INDEX_CAROUSEL, "picture"),
        "events" => getDB()->count(TABLE_EVENT, "id")
    ]);
}