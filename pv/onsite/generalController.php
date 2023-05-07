<?php

/**
 * The ForumAPI class represents a RESTful API for a forum.
 */
class ForumAPI
{
    /**
     * Handles a HTTP request and sends a response.
     *
     * @param string $method The HTTP method used (e.g. GET, POST, DELETE).
     * @param string $resource The resource being accessed (e.g. forum/category).
     * @param array $params Any additional parameters for the request.
     * @return void
     */
    public function handleRequest(string $method, string $resource, array $params)
    {
        switch ($method) {
            case 'GET':
                switch ($resource) {
                    case 'forum/category/root':
                        $this->getRootCategory();
                        break;
                    case 'forum/category/all':
                        $this->getAllCategories();
                        break;
                    case preg_match('/^forum\/category\/(\d+)$/', $resource, $matches) ? true : false:
                        $this->getCategory($matches[1]);
                        break;
                    case preg_match('/^forum\/category\/(\d+)\/topics$/', $resource, $matches) ? true : false:
                        $this->getTopicsFromCategory($matches[1], $params);
                        break;
                    case preg_match('/^forum\/topic\/(\d+)$/', $resource, $matches) ? true : false:
                        $this->getTopic($matches[1]);
                        break;
                    case preg_match('/^forum\/message\/(\d+)$/', $resource, $matches) ? true : false:
                        $this->getMessage($matches[1], $params);
                        break;
                    case 'forum/messages':
                        $this->getMessages($params);
                        break;
                    case preg_match('/^forum\/message\/(\d+)\/reply$/', $resource, $matches) ? true : false:
                        $this->getReply($matches[1], $params);
                        break;
                    default:
                        $this->badRequest();
                        break;
                }
                break;
            case 'POST':
                switch ($resource) {
                    case 'forum/category':
                        $this->createCategory();
                        break;
                    case 'forum/topic':
                        $this->createTopic();
                        break;
                    case 'forum/message':
                        $this->createMessage();
                        break;
                    case 'forum/reply':
                        $this->createReply();
                        break;
                    case preg_match('/^forum\/edit\/message$/', $resource, $matches) ? true : false:
                        $this->editMessage(false);
                        break;
                    case preg_match('/^forum\/edit\/reply$/', $resource, $matches) ? true : false:
                        $this->editMessage(true);
                        break;
                    default:
                        $this->badRequest();
                        break;
                }
                break;
            case 'DELETE':
                switch ($resource) {
                    case preg_match('/^forum\/message\/(\d+)$/', $resource, $matches) ? true : false:
                        $this->deleteMessage($matches[1], false);
                        break;
                    case preg_match('/^forum\/reply\/(\d+)$/', $resource, $matches) ? true : false:
                        $this->deleteMessage($matches[1], true);
                        break;
                    default:
                        $this->badRequest();
                        break;
                }
                break;
            case 'PATCH':
                switch ($resource) {
                    case 'forum/message':
                        $this->editMessage(false);
                        break;
                    case 'forum/reply':
                    }
                       

                    function _get_messages($query) {
                        $user = get_log_user();
                        $perm = $user->get_permission_level();
                    
                        $limit = max(1, min(50, intval($query['limit'] ?? 10)));
                        $offset = max(0, intval($query['offset'] ?? 0));
                    
                        $topic = $query['topic'] ?? null;
                        $author = $query['author'] ?? null;
                    
                        if ($topic === null && $author === null) {
                            bad_request('no topic or author specified');
                        }
                    
                        $where = [];
                        if ($author !== null) {
                            $where['author_id'] = $author;
                        }
                        if ($topic !== null) {
                            $where['topic_id'] = $topic;
                        }
                        $where['category_permission_view <='] = $perm;
                    
                        $data = getDB()->select(VIEW_FULL_FORUM_MESSAGE, ['*'], $where, $limit, 'date_inserted ASC', $offset, true);
                    
                        $elements = [];
                        foreach ($data as $d) {
                            $elements[] = concatenate_array_by_prefix($d, ['replay', 'author', 'topic']);
                        }
                    
                        $final_data = [
                            'count' => getDB()->count(VIEW_FULL_FORUM_MESSAGE, 'id', $where),
                            'elements' => $elements,
                        ];
                    
                        if ($topic !== null) {
                            if (count($elements) > 0) {
                                $final_data['topic'] = $elements[0]['topic'];
                            } else {
                                $final_data['topic'] = getDB()->select(TABLE_FORUM_TOPIC, ['id', 'name', 'category', 'date_inserted', 'last_message'], ['id' => $topic], 1);
                            }
                        }
                    
                        success($final_data);
                    }
                    
                    function _get_reply(string $message, array $query) {
                        $user = get_log_user();
                        $perm = $user->get_permission_level();
                    
                        $limit = max(1, min(50, intval($query['limit'] ?? 10)));
                        $offset = max(0, intval($query['offset'] ?? 0));
                    
                        if ($message === '') {
                            bad_request('invalid message');
                        }
                    
                        $messageData = getDB()->select(VIEW_FULL_FORUM_MESSAGE, ['*'], ['id' => $message, 'category_permission_view <=' => $perm], 1);
                    
                        if (!$messageData) {
                            bad_request('invalid message');
                        }
                    
                        $reply = getDB()->select(VIEW_FORUM_REPLY_AUTHOR, ['*'], ['message' => $message], $limit, 'date_inserted ASC', $offset, true);
                    
                        $elements = [];
                        foreach ($reply as $d) {
                            $elements[] = concatenate_array_by_prefix($d, ['author']);
                        }
                    
                        $data = [
                            'total' => $messageData['reply_count'] ?? 0,
                            'message' => concatenate_array_by_prefix($messageData, ['replay', 'author', 'topic']),
                            'elements' => $elements,
                        ];
                    
                        $url = 'forum/message/' . $message . '/reply';
                        if ($data['total'] > $offset + $limit) {
                            $data['next'] = $url . '?offset=' . ($offset + $limit) . '&limit=' . $limit;
                        }
                        if ($offset > 0) {
                            $data['previous'] = $url . '?offset=' . ($offset - $limit) . '&limit=' . $limit;
                        }
                    
                        success($data)
                    

/**
 * Edits a message or reply.
 * 
 * @api {POST} forum/edit/message
 * @api {POST} forum/edit/reply
 * @version 1.0.0
 * @param bool $isReply Whether the edit is for a reply.
 * @return void
 */
function _edit_message(bool $isReply) {
    $user = get_log_user();
    if (!$user->is_connected()) {
        unauthorized();
    }
    
    $table = $isReply ? TABLE_FORUM_REPLY : TABLE_FORUM_MESSAGE;
    $content = $_POST["message"] ?? "";
    $ref = $_POST["ref"] ?? null;

    if ($ref === null) {
        bad_request('invalid ref');
    }

    $refData = getDB()->select($table, ['author', 'status'], ['id' => $ref], 1);

    if (!$refData) {
        bad_request('invalid ref');
    }

    if ($refData['author'] !== $user->getId()) {
        unauthorized();
    }

    if (strlen($content) < 1 || strlen($content) > 2000) {
        bad_request('Le message doit contenir au minimum 1 caractère et au maximum 2000 !');
    }

    $data = [
        "content" => $content, 
        "status" => (intval($refData['status']) | MESSAGE_STATUS_EDITED)
    ];
    getDB()->update($table, $data, ['id' => $ref]);
    success();
}

/**
 * Creates a new topic.
 * 
 * @api {POST} forum/topic
 * @version 1.0.0
 * @return void
 */
function _create_topic() {
    $user = get_log_user();

    if (!$user->is_connected()) {
        unauthorized();
    }

    $errors = [];
    $category = $_POST["category"] ?? "";
    $title = trim($_POST["title"] ?? "");
    $message = $_POST["message"] ?? "";

    if (empty($category)) {
        bad_request('invalid category');
    }

    $cat = get_category($category);

    if (!$cat || $cat['permission_create'] > $user->get_permission_level()) {
        bad_request('invalid category');
    }

    if (strlen($title) < 5 || strlen($title) > 100) {
        $errors["title"] = 'Le titre doit contenir au minimum 5 caractères et au maximum 100 !';
    }

    if (strlen($message) < 10 || strlen($message) > 2000) {
        $errors["$message"] = 'Le $message doit contenir au minimum 10 caractères et au maximum 2000 !';
    }

    if (count($errors) !== 0) {
        bad_request($errors);
    }

    getDB()->insert(TABLE_FORUM_TOPIC, ["name" => $title, "category" => $cat["id"]]);
    $id = getDB()->select(TABLE_FORUM_TOPIC, ['id'], ["name" => $title], 1, 'date_inserted DESC')['id'];
    getDB()->insert(TABLE_FORUM_MESSAGE, ["author" => $user->getId(), "topic" => $id, "content" => $message]);
    success();
}

/**
 * Creates a new category.
 * 
 * @api {POST} forum/category
 * @version 1.0.0
 * @return void
 */
function _create_category() {
    $user = get_log_user();

    if ($user->get_permission_level() < PERMISSION_CREATE)}
