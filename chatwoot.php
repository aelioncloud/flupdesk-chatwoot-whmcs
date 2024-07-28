<?php

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
    return array(
        'inbound_emails' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar e-mails recebidos'
        ),
//        'channel_email' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar canal de e-mail'
//        ),
        'channel_facebook' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar canal do Facebook'
        ),
        'channel_twitter' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar canal do Twitter'
        ),
//        'ip_lookup' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar consulta de IP'
//        ),
        'email_continuity_on_api_channel' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar continuidade de e-mail no canal da API'
        ),
//        'help_center' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar central de ajuda'
//        ),
        'agent_bots' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar bots de agentes'
        ),
//        'macros' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar macros'
//        ),
//        'agent_management' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar gerenciamento de agentes'
//        ),
//        'team_management' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar gerenciamento de equipe'
//        ),
//        'inbox_management' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar gerenciamento de caixa de entrada'
//        ),
//        'labels' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar etiquetas'
//        ),
        'custom_attributes' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar atributos personalizados'
        ),
        'automations' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar automações'
        ),
        'canned_responses' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar respostas prontas'
        ),
        'integrations' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar integrações'
        ),
//        'voice_recorder' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar gravador de voz'
//        ),
//        'mobile_v2' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar versão móvel 2'
//        ),
//        'channel_website' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar canal do site'
//        ),
        'campaigns' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar campanhas'
        ),
        'reports' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar relatórios'
        ),
        'crm' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar CRM'
        ),
        'auto_resolve_conversations' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar resolução automática de conversas'
        ),
//        'custom_reply_email' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar e-mail de resposta personalizado'
//        ),
//        'custom_reply_domain' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar domínio de resposta personalizado'
//        ),
        'message_reply_to' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar resposta a mensagem'
        ),
//        'insert_article_in_reply' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar inserção de artigo na resposta'
//        ),
        'inbox_view' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar visualização da caixa de entrada'
        ),
        'linear_integration' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar integração linear'
        ),
        'hide_all_chats_for_agent' => array(
            'Type' => 'yesno',
            'Description' => 'Ocultar todas as conversas para o agente'
        ),
        'hide_contacts_for_agent' => array(
            'Type' => 'yesno',
            'Description' => 'Ocultar contatos para o agente'
        ),
        'hide_filters_for_agent' => array(
            'Type' => 'yesno',
            'Description' => 'Ocultar filtros para o agente'
        ),
        'send_agent_name_in_whatsapp_message' => array(
            'Type' => 'yesno',
            'Description' => 'Enviar nome do agente na mensagem do WhatsApp'
        ),
//        'read_message' => array(
//            'Type' => 'yesno',
//            'Description' => 'Habilitar leitura de mensagem'
//        ),
        'disable_whatsapp_messaging_window' => array(
            'Type' => 'yesno',
            'Description' => 'Desativar janela de mensagens do WhatsApp'
        ),
        'agent_conversation_viewed' => array(
            'Type' => 'yesno',
            'Description' => 'Habilitar visualização de conversa pelo agente'
        ),
        'hide_unassigned_for_agent' => array(
            'Type' => 'yesno',
            'Description' => 'Ocultar não atribuídos para o agente'
        ),
        'hide_delete_message_for_agent' => array(
            'Type' => 'yesno',
            'Description' => 'Ocultar mensagem de exclusão para o agente'
        ),
    );
}

/*
 * 1. Gerenciamento do usuário
 */

function chatwoot_CreateAgent(array $params)
{
    $res = chatwoot_FetchConnection(array(
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

    if (isset($res['message'])) {
        return $res['message'];
    }

    $params['model']->serviceProperties->save(['user_id' => $res['id']]);
    $params['model']->serviceProperties->save(['username' => $params['clientsdetails']['email']]);

    return 'success';
}

function chatwoot_InviteAgent(array $params)
{
    $res = chatwoot_FetchConnection(array(
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

    if (isset($res['message'])) {
        return $res['message'];
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

    $res = chatwoot_FetchConnection(array(
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

    if (isset($res['message'])) {
        return $res['message'];
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
    $res = chatwoot_FetchConnection(array(
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

    if (isset($res['message'])) {
        return $res['message'];
    }

    return 'success';
}

function chatwoot_UnsuspendAccount(array $params)
{
    $res = chatwoot_FetchConnection(array(
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

    if (isset($res['message'])) {
        return $res['message'];
    }

    return 'success';
}

function chatwoot_TerminateAccount(array $params)
{
    $res = chatwoot_FetchConnection(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/accounts/' . $params['customfields']['account_id'],
        'key' => $params['serverpassword'],
        'data' => array(),
        'method' => 'DELETE',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    if (isset($res['message'])) {
        return $res['message'];
    }

    return 'success';
}

/*
 * 3. Atualizações
 */

function chatwoot_ChangePackage(array $params)
{
    $res = chatwoot_FetchConnection(array(
        'url' => 'https://' . $params['serverhostname'] . '/platform/api/v1/accounts/' . $params['customfields']['account_id'],
        'key' => $params['serverpassword'],
        'data' => array(
            'features' => array(
                'inbound_emails' => ($params['configoption1'] == 'on'),
                'channel_email' => true,
                'channel_facebook' => ($params['configoption2'] == 'on'),
                'channel_twitter' => ($params['configoption3'] == 'on'),
                'ip_lookup' => false,
                'email_continuity_on_api_channel' => ($params['configoption4'] == 'on'),
                'help_center' => true,
                'agent_bots' => ($params['configoption5'] == 'on'),
                'macros' => true,
                'agent_management' => true,
                'team_management' => true,
                'inbox_management' => true,
                'labels' => true,
                'custom_attributes' => ($params['configoption6'] == 'on'),
                'automations' => ($params['configoption7'] == 'on'),
                'canned_responses' => ($params['configoption8'] == 'on'),
                'integrations' => ($params['configoption9'] == 'on'),
                'voice_recorder' => true,
                'mobile_v2' => true,
                'channel_website' => true,
                'campaigns' => ($params['configoption10'] == 'on'),
                'reports' => ($params['configoption11'] == 'on'),
                'crm' => ($params['configoption12'] == 'on'),
                'auto_resolve_conversations' => ($params['configoption13'] == 'on'),
                'custom_reply_email' => false,
                'custom_reply_domain' => false,
                'message_reply_to' => ($params['configoption14'] == 'on'),
                'insert_article_in_reply' => true,
                'inbox_view' => ($params['configoption15'] == 'on'),
                'linear_integration' => ($params['configoption16'] == 'on'),
                'hide_all_chats_for_agent' => ($params['configoption17'] == 'on'),
                'hide_contacts_for_agent' => ($params['configoption18'] == 'on'),
                'hide_filters_for_agent' => ($params['configoption19'] == 'on'),
                'send_agent_name_in_whatsapp_message' => ($params['configoption20'] == 'on'),
                'read_message' => true,
                'disable_whatsapp_messaging_window' => ($params['configoption21'] == 'on'),
                'agent_conversation_viewed' => ($params['configoption22'] == 'on'),
                'hide_unassigned_for_agent' => ($params['configoption23'] == 'on'),
                'hide_delete_message_for_agent' => ($params['configoption24'] == 'on'),
            ),
        ),
        'method' => 'PATCH',
    ));

    if (isset($res['error'])) {
        return $res['error'];
    }

    if (isset($res['message'])) {
        return $res['message'];
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
        logModuleCall(
            'chatwoot',
            __FUNCTION__,
            $params,
            $e->getMessage(),
            $e->getTraceAsString()
        );

        $success = false;
        $message = $e->getMessage();
    }

    return array(
        'success' => $success,
        'error' => $message
    );
}

/*
 * Funções
 */

function chatwoot_FetchConnection(array $params)
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
    }

    curl_close($ch);
    return $response;
}