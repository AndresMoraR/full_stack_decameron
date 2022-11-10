<?php

use Firebase\JWT\Key;

function getJWTFromRequest($authenticationHeader)
{
    if(is_null($authenticationHeader)){
        $message = 'JWT Invalido en request';
        throw new Exception($message);
    }

    return explode(' ', $authenticationHeader)[1];
}

function validateJWTfromRequest(string $encodedToken)
{
    $key = \Config\Services::getSecretKey();
    $decodeToken = \Firebase\JWT\JWT::decode($encodedToken, new Key($key, 'HS256'));
}

function getSignedJWTForUser()
{
    $issuedAtTime = time();
    $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $issuedAtTime+$tokenTimeToLive;
    $payload = [
        'iat' => $issuedAtTime,
        'exo' => $tokenExpiration
    ];

    $jwt = \Firebase\JWT\JWT::encode($payload, \Config\Services::getSecretKey(), 'HS256');
    return $jwt;
}

