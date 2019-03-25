<?php
require_once _model_ . "Rest.php";
require_once _utils_ . "headers.php";

require_once './../../vendor/autoload.php';

use \Firebase\JWT\ExpiredException;
use \Firebase\JWT\JWT;
use \Firebase\JWT\SignatureInvalidException;

class Token extends Rest
{
    private $_token;
    public function __constructor()
    {
        parent::__constructor();
    }

    public function validToken()
    {
        $tokenCurrent = get_auth_token();
        if (!empty($tokenCurrent)) {
            $this->validExceptionToken($tokenCurrent);
        }
    }

    public function refreshToken($tokenOld)
    {
        $time = time();
        JWT::$leeway = 720000;
        $decoded = (array) JWT::decode($tokenOld, JWT_SECRET, ['HS256']);

        $decoded['iat'] = $time;
        $decoded['exp'] = $time + EXPIRATION_HOUR_JWT_TOKEN;

        $token = JWT::encode($decoded, JWT_SECRET, 'HS256');
        $this->response(
            $this->json(array(
                'data' => array(
                    'token' => $token,
                    'status' => 401,
                ),
            ))
            , 401);
    }

    public function validExceptionToken($token)
    {
        try {
            $decoded = JWT::decode($token, JWT_SECRET, ['HS256']);
        } catch (ExpiredException $e) {
            $this->refreshToken($token);
        } catch (SignatureInvalidException $e) {
            $this->response(
                $this->json(array('token', $token))
                , 401);
        }
    }

    public function createToken($data)
    {
        $time = time();
        $payload = array(
            'data' => $data,
            'iat' => $time,
            'exp' => $time + EXPIRATION_HOUR_JWT_TOKEN,
        );
        $payload[] = $data;
        $this->_token = JWT::encode($payload, JWT_SECRET, 'HS256');
    }

    public function getToken()
    {
        return $this->_token;
    }
}
