<?php
require_once './../../vendor/autoload.php';

use Firebase\JWT\JWT;

function token($userid)
{
  $issuedAt = time();
  $expirationTime = $issuedAt + 60; // jwt valid for 60 seconds from the issued time
  $payload = array(
    'userid' => $userid,
    'iat' => $issuedAt,
    'exp' => $expirationTime,
  );
  $key = SECRET_KEY;
  $alg = 'HS256';
  $jwt = JWT::encode($payload, $key, $alg);
  return $jwt;
}

function encrypt($value)
{
  $cad = strlen($value);
  $subcad = ceil($cad / 2);
  $prev_valor = substr(strrev($value), 0, $subcad);
  $next_valor = substr(strrev($value), $subcad, $cad);
  $pcad = $cad * 647667904564;
  $pass = $pcad . '|' . $prev_valor . '$' . $subcad . '|' . $next_valor . '$w3809245n0t9';
  return str_replace("'", "?", $pass);
}

function decrypt($value)
{
  $cad = strlen($value);
  $subcad = ceil($cad / 2);
  $new_valor = explode("|", $value);

  $pvalor = explode("$", $new_valor[1]);
  $prev_valor = $pvalor[0];

  $nvalor = explode("$", $new_valor[2]);
  $next_valor = $nvalor[0];

  $pass = strrev($prev_valor . $next_valor);
  return str_replace('?', "'", $pass);
}

function checkToken($receivedToken, $receivedData)
{

  $userID = 1;
  $userRole = "admin";

  // Concatenating data with TIME
  $data = time() . "_" . $userID . "-" . $userRole;

  $tokenGeneric = SECRET_KEY . $_SERVER["SERVER_NAME"];

  // We create a token which should match
  $token = hash('sha256', $tokenGeneric . $receivedData);

  // We check if token is ok !
  if ($receivedToken != $token) {
    echo 'wrong Token !';
    return false;
  }

  list($tokenDate, $userData) = explode("_", $receivedData);

  // here we compare tokenDate with current time using VALIDITY_TIME to check if the token is expired
  // if token expired we return false

  // if (VALIDITY_TIME_TOKEN <= $tokenDate) {
  //     return false;
  // }

  // otherwise it's ok and we return a new token
  return createToken(time() . "#" . $userData);
}
