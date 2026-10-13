<?php

declare(strict_types=1);

/**
 * Fill these on the server. Do not commit a live bot token.
 */
define('TELEGRAM_BOT_TOKEN', getenv('TELEGRAM_BOT_TOKEN') ?: '');
define('TELEGRAM_CHAT_ID', getenv('TELEGRAM_CHAT_ID') ?: '');

// Demo calls from the site are posted into Pulse CRM.
define('CRM_API_URL', getenv('CRM_API_URL') ?: 'https://bot-telegram.ai-agent.website');
define('CRM_API_TOKEN', getenv('CRM_API_TOKEN') ?: '');

// ElevenLabs Conversational AI widget for inbound calls from the site.
define('ELEVENLABS_AGENT_ID', getenv('ELEVENLABS_AGENT_ID') ?: '');
