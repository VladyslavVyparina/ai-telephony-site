<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

$agentId = defined('ELEVENLABS_AGENT_ID') ? ELEVENLABS_AGENT_ID : '';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta name="theme-color" content="#f0f3fc" />
  <title>Поговорити з AI — ai-agent.website</title>
  <meta name="description" content="Поговоріть з AI-менеджером прямо зараз — без реєстрації та очікування." />
  <link rel="icon" type="image/png" href="images/ai-mark.png" />
  <link rel="stylesheet" href="styles.css?v=20260823" />
  <style>
    body{min-height:100vh;display:flex;flex-direction:column}
    .call-page-main{flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px}
    .call-page-card{
      width:100%;max-width:520px;
      background:rgba(255,255,255,.82);
      border:1px solid rgba(255,255,255,.9);
      border-radius:24px;
      box-shadow:0 8px 60px rgba(0,0,0,.1);
      padding:48px 40px;
      text-align:center;
    }
    .cp-orb{
      width:100px;height:100px;border-radius:50%;
      background:radial-gradient(circle at 35% 30%,#1a6ff5,#0044bb);
      border:3px solid rgba(100,210,255,.5);
      display:flex;align-items:center;justify-content:center;
      margin:0 auto 24px;
      position:relative;
      cursor:pointer;
      transition:transform .2s,box-shadow .2s;
    }
    .cp-orb:hover{transform:scale(1.05);box-shadow:0 12px 40px rgba(0,113,227,.35)}
    .cp-orb-glow{
      position:absolute;inset:-20px;border-radius:50%;
      background:radial-gradient(circle,rgba(0,113,227,.4),transparent 70%);
      animation:orb-pulse 2.4s ease-in-out infinite;pointer-events:none;
    }
    .cp-orb-ring{
      position:absolute;inset:-12px;border-radius:50%;
      border:2px solid rgba(100,210,255,.4);
      animation:orb-ring 2.8s ease-in-out infinite;
    }
    .cp-orb-icon{color:#fff;position:relative;z-index:1}
    .cp-badge{
      display:inline-flex;align-items:center;gap:6px;
      padding:6px 16px;border-radius:980px;
      background:rgba(0,113,227,.08);border:1px solid rgba(0,113,227,.2);
      color:var(--accent);font-size:13px;font-weight:700;
      letter-spacing:.03em;margin-bottom:16px;
    }
    .cp-badge-dot{width:8px;height:8px;border-radius:50%;background:#10b981;animation:pulse-dot 1.5s ease-in-out infinite}
    @keyframes pulse-dot{0%,100%{opacity:1}50%{opacity:.4}}
    .call-page-card h1{font-size:clamp(24px,3.5vw,32px);margin-bottom:12px}
    .call-page-card .cp-sub{color:var(--text2);font-size:16px;margin-bottom:28px;line-height:1.55}
    .cp-features{
      list-style:none;display:flex;flex-direction:column;gap:10px;
      text-align:left;margin-bottom:28px;
      background:rgba(0,113,227,.03);border-radius:16px;padding:20px 24px;
    }
    .cp-features li{display:flex;align-items:center;gap:10px;font-size:14px;color:var(--text)}
    .cp-check{
      flex-shrink:0;width:22px;height:22px;border-radius:50%;
      background:rgba(0,113,227,.1);border:1px solid rgba(0,113,227,.25);
      color:var(--accent);display:flex;align-items:center;justify-content:center;
    }
    .cp-start-btn{
      width:100%;padding:16px 24px;border-radius:980px;border:none;
      background:var(--accent);color:#fff;
      font-family:inherit;font-size:17px;font-weight:700;
      cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;
      transition:filter .18s,transform .18s,box-shadow .18s;
      box-shadow:0 8px 32px rgba(0,113,227,.4);
    }
    .cp-start-btn:hover{filter:brightness(1.1);transform:translateY(-2px);box-shadow:0 12px 44px rgba(0,113,227,.5)}
    .cp-start-btn:disabled{opacity:.6;cursor:default;transform:none}
    .cp-alt{margin-top:20px;font-size:13px;color:var(--text2)}
    .cp-alt a{color:var(--accent);font-weight:600}
    .cp-error{
      margin-top:20px;padding:16px;border-radius:12px;
      background:rgba(231,76,60,.08);border:1px solid rgba(231,76,60,.2);
      color:#c0392b;font-size:14px;
    }
    @media(max-width:500px){
      .call-page-card{padding:32px 20px}
      .cp-features{padding:16px 18px}
    }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="container hdr-inner">
      <a href="index.php" class="logo">Pulse AI</a>
      <div class="hdr-actions">
        <a class="btn btn-outline hdr-cta" href="index.php">← На головну</a>
      </div>
    </div>
  </header>

  <main class="call-page-main">
    <div class="call-page-card">
      <?php if ($agentId): ?>
      <div class="cp-orb js-start-call" tabindex="0" role="button" aria-label="Почати розмову з AI">
        <span class="cp-orb-ring"></span>
        <span class="cp-orb-glow"></span>
        <svg class="cp-orb-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/>
          <path d="M19 10v2a7 7 0 01-14 0v-2"/>
          <line x1="12" y1="19" x2="12" y2="23"/>
          <line x1="8" y1="23" x2="16" y2="23"/>
        </svg>
      </div>

      <div class="cp-badge">
        <span class="cp-badge-dot"></span>
        AI Online
      </div>

      <h1>Поговоріть з AI-менеджером</h1>
      <p class="cp-sub">Натисніть на кнопку нижче — AI-агент відповість прямо в браузері. Дозвольте доступ до мікрофона.</p>

      <ul class="cp-features">
        <li>
          <span class="cp-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span>
          Без реєстрації та номера телефону
        </li>
        <li>
          <span class="cp-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span>
          Живий AI-голос в реальному часі
        </li>
        <li>
          <span class="cp-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span>
          Ставте будь-які питання
        </li>
      </ul>

      <button type="button" class="cp-start-btn js-start-call">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/>
          <path d="M19 10v2a7 7 0 01-14 0v-2"/>
          <line x1="12" y1="19" x2="12" y2="23"/>
        </svg>
        Почати розмову
      </button>

      <p class="cp-alt">Або <a href="index.php#demo">замовте зворотний дзвінок</a> на ваш телефон</p>

      <!-- ElevenLabs Widget — вхідна лінія -->
      <elevenlabs-convai agent-id="<?= htmlspecialchars($agentId, ENT_QUOTES, 'UTF-8') ?>"></elevenlabs-convai>
      <script src="https://unpkg.com/@elevenlabs/convai-widget-embed@0.18.3/dist/index.js" async type="text/javascript"></script>
      <script src="includes/open-ai-call.js?v=20261001"></script>
      <script>
        PulseInbound.bindStartButtons('.js-start-call', false);
      </script>

      <?php else: ?>
      <div class="cp-orb" style="opacity:.5;cursor:default">
        <span class="cp-orb-icon" style="opacity:.6">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/>
            <path d="M19 10v2a7 7 0 01-14 0v-2"/>
            <line x1="12" y1="19" x2="12" y2="23"/>
          </svg>
        </span>
      </div>

      <h1>Вхідна лінія тимчасово недоступна</h1>
      <p class="cp-sub">Зараз ви можете замовити зворотний дзвінок — AI-агент зателефонує вам протягом хвилини.</p>

      <a href="index.php#demo" class="cp-start-btn" style="text-decoration:none">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
        </svg>
        Замовити зворотний дзвінок
      </a>
      <?php endif; ?>
    </div>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p>© <span id="yr"></span> <a href="https://ai-agent.website/">ai-agent.website</a></p>
    </div>
  </footer>
  <script>document.getElementById('yr').textContent = new Date().getFullYear();</script>
</body>
</html>
