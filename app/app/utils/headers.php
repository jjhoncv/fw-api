<?php
function get_auth_token()
{
    $auth_token = null;
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $auth_token = $_SERVER['HTTP_AUTHORIZATION'];
    } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
        $auth_token = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    }
    if ($auth_token != null) {
        if (strpos(strtolower($auth_token), 'basic') === 0) {
            list($username, $password) = explode(':', base64_decode(substr($auth_token, 6)));
        }
    }
    return $auth_token;
}
