<?php

declare(strict_types=1);

/** Скопіюйте як secrets.php і вставте свої значення. Не комітьте secrets.php у git. */
define('TELEGRAM_BOT_TOKEN', 'YOUR_BOT_TOKEN');
define('TELEGRAM_CHAT_ID', '-1000000000000');

// CRM API для демо-дзвінків з сайту (необов'язково)
// Вкажіть адресу вашого CRM-сервера та токен адміна
define('CRM_API_URL',   'https://bot-telegram.ai-agent.website');
define('CRM_API_TOKEN', 'change_this_token');

// ElevenLabs Conversational AI — widget для вхідних дзвінків з сайту
// Отримайте agent_id у ElevenLabs Dashboard → ElevenAgents
define('ELEVENLABS_AGENT_ID', '');
