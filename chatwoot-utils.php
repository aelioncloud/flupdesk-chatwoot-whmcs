<?php

function execute(array $params)
{
    $ch = curl_init($params['url']);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'api_access_token: ' . $params['key'],
        'Content-Type: application/json'
    ]);

    switch (strtoupper($params['method'])) {
        case 'POST':
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params['data']));
            break;
        case 'PATCH':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params['data']));
            break;
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params['data']));
            break;
        default:
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            break;
    }

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $response = ['error' => curl_error($ch)];
    } else {
        $response = json_decode($response, true);

        if (isset($response['error'])) {
            $response = ['error' => $response['error']];
        } else if (isset($response['message'])) {
            $response = ['error' => $response['message']];
        }
    }

    curl_close($ch);
    return $response;
}