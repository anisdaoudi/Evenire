<?php

const CAPTCHA_WIDTH = 300;
const CAPTCHA_HEIGHT = 200;
const CAPTCHA_PIECE_SIZE = 40;
const CAPTCHA_CELL_SIZE = 10;
const CAPTCHA_CODE_ERROR = 3;
const CAPTCHA_NUMBER_PIECE = 3;
const CAPTCHA_CODE_FALSE = 2;
const CAPTCHA_CODE_GOOD = 1;

function get_captcha_status(): int {
    if (!isset($_POST["captcha-id"]) || !isset($_POST["captcha"]) || !isset($_SESSION["captcha"][$_POST["captcha-id"]])) {
        return CAPTCHA_CODE_ERROR;
    }

    $id = $_POST["captcha-id"];
    $user_input = $_POST["captcha"];
    $captcha_code = $_SESSION["captcha"][$id];

    if ($captcha_code === $user_input) {
        return CAPTCHA_CODE_GOOD;
    } else {
        return CAPTCHA_CODE_FALSE;
    }
}

function _get_captcha_settings() {
    success([
        "width" => CAPTCHA_WIDTH,
        "height" => CAPTCHA_HEIGHT,
        "number_piece" => CAPTCHA_NUMBER_PIECE,
        "piece_size" => CAPTCHA_PIECE_SIZE,
        "cell_size" => CAPTCHA_CELL_SIZE,
        "code_length" => CAPTCHA_NUMBER_PIECE * 2,
    ]);
}
