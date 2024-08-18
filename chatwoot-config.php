<?php

global $features;
global $features_default;

$features = array(
    'inbound_emails' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar e-mails recebidos'
    ),
    'channel_email' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar canal de e-mail'
    ),
    'channel_facebook' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar canal do Facebook'
    ),
    'channel_twitter' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar canal do Twitter'
    ),
    'agent_bots' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar bots de agentes'
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
    'voice_recorder' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar gravador de voz'
    ),
    'channel_website' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar canal do site'
    ),
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
    'linear_integration' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar integração linear'
    ),
    'hide_all_chats_for_agent' => array(
        'Type' => 'yesno',
        'Description' => 'Ocultar todas as conversas para o agente'
    ),
    'hide_filters_for_agent' => array(
        'Type' => 'yesno',
        'Description' => 'Ocultar filtros para o agente'
    ),
    'send_agent_name_in_whatsapp_message' => array(
        'Type' => 'yesno',
        'Description' => 'Enviar nome do agente na mensagem do WhatsApp'
    ),
    'disable_whatsapp_messaging_window' => array(
        'Type' => 'yesno',
        'Description' => 'Desativar janela de mensagens do WhatsApp'
    ),
    'agent_conversation_viewed' => array(
        'Type' => 'yesno',
        'Description' => 'Habilitar visualização de conversa pelo agente'
    ),
    'hide_delete_message_for_agent' => array(
        'Type' => 'yesno',
        'Description' => 'Ocultar mensagem de exclusão para o agente'
    ),
    'agents_limit' => array(
        'Type' => 'text',
        'Description' => 'Limite de agentes'
    ),
);

$features_default = array(
    'ip_lookup' => array(
        'Default' => 'off',
        'Type' => 'yesno',
        'Description' => 'Habilitar consulta de IP'
    ),
    'email_continuity_on_api_channel' => array(
        'Default' => 'off',
        'Type' => 'yesno',
        'Description' => 'Habilitar continuidade de e-mail no canal da API'
    ),
    'help_center' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar central de ajuda'
    ),
    'macros' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar macros'
    ),
    'agent_management' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar gerenciamento de agentes'
    ),
    'team_management' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar gerenciamento de equipe'
    ),
    'inbox_management' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar gerenciamento de caixa de entrada'
    ),
    'labels' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar etiquetas'
    ),
    'custom_attributes' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar atributos personalizados'
    ),
    'mobile_v2' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar versão móvel v2'
    ),
    'custom_reply_email' => array(
        'Default' => 'off',
        'Type' => 'yesno',
        'Description' => 'Habilitar e-mail de resposta personalizado'
    ),
    'custom_reply_domain' => array(
        'Default' => 'off',
        'Type' => 'yesno',
        'Description' => 'Habilitar domínio de resposta personalizado'
    ),
    'message_reply_to' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar resposta a mensagem'
    ),
    'insert_article_in_reply' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar inserção de artigo na resposta'
    ),
    'inbox_view' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar visualização da caixa de entrada'
    ),
    'read_message' => array(
        'Default' => 'on',
        'Type' => 'yesno',
        'Description' => 'Habilitar leitura de mensagem'
    ),
	'hide_unassigned_for_agent' => array(
		'Default' => 'off',
        'Type' => 'yesno',
        'Description' => 'Ocultar não atribuídos para o agente'
    ),
    'hide_contacts_for_agent' => array(
		'Default' => 'off',
        'Type' => 'yesno',
        'Description' => 'Ocultar contatos para o agente'
    ),
);