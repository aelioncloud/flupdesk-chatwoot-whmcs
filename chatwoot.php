<?php

include_once('chatwoot-config.php');
include_once('chatwoot-utils.php');

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/*
 * Configuração do módulo
 */

function chatwoot_MetaData()
{
    return array(
        'DisplayName' => 'Chatwoot',
        'APIVersion' => '1.1',
        'RequiresServer' => true,
    );
}

function chatwoot_ConfigOptions()
{
    global $features;
    return $features;
}

/*
 * 1. Gerenciamento do usuário
 */

function chatwoot_CreateAgent(array $params)
{
    $res = execute(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/users',
        'key' => $params['serverpassword'],
        'data' => array(
            'name' => $params['clientsdetails']['firstname'],
            'email' => $params['clientsdetails']['email'],
            'password' => $params['password'],
        ),
        'method' => 'POST',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    $params['model']->serviceProperties->save(['user_id' => $res['id']]);
    $params['model']->serviceProperties->save(['username' => $params['clientsdetails']['email']]);

    return 'success';
}

function chatwoot_InviteAgent(array $params)
{
    $res = execute(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/accounts/' . $params['customfields']['account_id'] . '/account_users',
        'key' => $params['serverpassword'],
        'data' => array(
            'user_id' => $params['customfields']['user_id'],
            'role' => 'administrator'
        ),
        'method' => 'POST',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    return 'success';
}

/*
 * 2. Gerenciamento da plataforma
 */

function chatwoot_CreateAccount(array $params)
{
    $agent = chatwoot_CreateAgent($params);

    if ($agent != 'success') {
        return $agent;
    }

    $params['customfields']['user_id'] = $params['model']->serviceProperties->get('user_id');

    $res = execute(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/accounts',
        'key' => $params['serverpassword'],
        'data' => array(
            'name' => $params['domain'],
            'status' => 'active',
            'locale' => 'pt_BR'
        ),
        'method' => 'POST',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    $params['customfields']['account_id'] = $res['id'];
    $params['model']->serviceProperties->save(['account_id' => $res['id']]);

    $invite = chatwoot_InviteAgent($params);

    if ($invite != 'success') {
        return $invite;
    }

    return chatwoot_ChangePackage($params);
}

function chatwoot_SuspendAccount(array $params)
{
    $res = execute(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/accounts/' . $params['customfields']['account_id'],
        'key' => $params['serverpassword'],
        'data' => array(
            'status' => 'suspended'
        ),
        'method' => 'PATCH',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    return 'success';
}

function chatwoot_UnsuspendAccount(array $params)
{
    $res = execute(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/accounts/' . $params['customfields']['account_id'],
        'key' => $params['serverpassword'],
        'data' => array(
            'status' => 'active'
        ),
        'method' => 'PATCH',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    return 'success';
}

function chatwoot_TerminateAccount(array $params)
{
    $res = execute(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/accounts/' . $params['customfields']['account_id'],
        'key' => $params['serverpassword'],
        'data' => array(),
        'method' => 'DELETE',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    return 'success';
}

/*
 * 3. Atualizações
 */

function chatwoot_ChangePackage(array $params)
{
    global $features, $features_default;

    $mergedFeatures = array();

    foreach ($features as $index => $item) {
        if ($index === 'agents_limit') continue;

        $mergedFeatures[$index] = ($params['configoptions'][$index] ?? $params['configoption' . (array_search($index, array_keys($features)) + 1)]) == 'on';
    }

    foreach ($features_default as $index => $item) {
        $mergedFeatures[$index] = ($params['configoptions'][$index] ?? $item['Default']) == 'on';
    }

    $res = execute(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/accounts/' . $params['customfields']['account_id'],
        'key' => $params['serverpassword'],
        'data' => array(
            'features' => $mergedFeatures,
            'limits' => array(
                'agents' => $params['configoptions']['agents_limit'] ?? $params['configoption' . array_search('agents_limit', array_keys($features))],
            ),
        ),
        'method' => 'PATCH',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    return 'success';
}

/*
 * Testes
 */

function chatwoot_TestConnection(array $params)
{
    try {
        $ch = curl_init('https://' . $params['serverhostname'] . '/platform/api/v1/agent_bots');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'api_access_token: ' . $params['serverpassword'],
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        $res = json_decode(curl_exec($ch), true);

        if (curl_errno($ch)) {
            $success = false;
            $message = curl_error($ch);
        } else if (isset($res['error'])) {
            $success = false;
            $message = $res['error'];
        } else {
            $success = true;
            $message = '';
        }

        curl_close($ch);
    } catch (Exception $e) {
        $success = false;
        $message = $e->getMessage();
    }

    return array(
        'success' => $success,
        'error' => $message
    );
}