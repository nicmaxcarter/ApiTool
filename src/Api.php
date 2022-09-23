<?php

namespace Nicmaxcarter\ApiTool;

class Api
{
    public static function getData()
    {
        return json_decode(
            file_get_contents('php://input')
        );
    }

    public static function testData()
    {
        return json_decode(
            file_get_contents('php://input')
        );
    }

    public static function respond200($response, $responseMessage)
    {
        $responseMessage = json_encode(
            ['success' => true, 'response' => $responseMessage]
        );

        $response->getBody()->write($responseMessage);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public static function respond400($response, $responseMessage)
    {
        $responseMessage = json_encode(
            ['success' => false, 'response' => $responseMessage]
        );

        $response->getBody()->write($responseMessage);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    }

    public static function respond422($response, $responseMessage)
    {
        $responseMessage = json_encode(
            ['success' => true, 'response' => $responseMessage]
        );

        $response->getBody()->write($responseMessage);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(422);
    }

    public static function error($response, $errorMessage)
    {
        return Api::respond400(
            $response,
            ['error' => $errorMessage]
        );
    }

    public static function success($response, $successMessage)
    {
        return Api::respond200(
            $response,
            ['message' => $successMessage]
        );
    }

    public static function basename()
    {
        $time = microtime(true);
        $str = str_replace('.', '', $time);
        $hex = bin2hex(random_bytes(8));

        return $str . $hex;
    }
}
