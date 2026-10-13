<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';
$isThanks = !empty($_GET['thanks']);
?>
<!DOCTYPE html>
<html lang="uk">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="theme-color" content="#f0f3fc" />
    <title>Демо-дзвінок — ai-agent.website</title>
    <meta name="description" content="Залиште номер — AI-агент зателефонує вам протягом 60 секунд." />
    <link rel="icon" type="image/png" href="images/ai-mark.png" />
    <link rel="stylesheet" href="styles.css?v=20260812-2" />
    <?php require __DIR__ . '/includes/head-tracking.php'; ?>
  </head>
  <body>
    <a class="skip-link" href="#main">До основного вмісту</a>

    <header class="site-header">
      <div class="container hdr-inner">
        <a class="logo" href="index.php">Pulse AI</a>
        <div class="hdr-actions">
          <a class="btn btn-outline hdr-cta" href="index.php">На головний сайт</a>
          <button type="button" class="btn btn-primary hdr-cta js-open-demo-call-modal">Демо-дзвінок</button>
        </div>
      </div>
    </header>

    <main id="main">
      <section class="section" style="min-height:60vh;display:flex;align-items:center">
        <div class="container" style="max-width:520px">

          <?php if ($isThanks) : ?>
            <div class="glass-card" style="padding:56px 40px;text-align:center">
              <div style="
                width:64px;height:64px;
                background:var(--accent);
                border-radius:50%;
                display:flex;align-items:center;justify-content:center;
                margin:0 auto 24px;
              ">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                  stroke="#fff" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
              </div>
              <h1 style="font-size:26px;margin-bottom:12px">AI-агент дзвонить!</h1>
              <p style="color:var(--text2)">Очікуйте дзвінок протягом 60 секунд.</p>
            </div>
          <?php else : ?>
            <div class="final-form glass-card" style="text-align:center">
              <h1 style="font-size:26px;margin-bottom:8px">Замовте демо-дзвінок</h1>
              <p style="color:var(--text2);margin-bottom:24px">
                AI-агент зателефонує вам протягом 60 секунд — справжній дзвінок, не запис.
              </p>
              <button type="button" class="btn btn-primary btn-lg js-open-demo-call-modal">Зателефонуйте мені</button>
              <p class="dcm-disclaimer" style="margin-top:14px">Демо-дзвінок безкоштовний. Без спаму та нав'язливих продажів.</p>
            </div>
          <?php endif; ?>

        </div>
      </section>
    </main>

    <!-- DEMO CALL MODAL -->
    <div class="modal dcm-modal" id="demo-call-modal" hidden aria-hidden="true">
      <div class="modal-overlay js-close-demo-call-modal"></div>
      <div class="modal-card dcm-card" role="dialog" aria-modal="true" aria-labelledby="dcm-title">
        <button type="button" class="modal-close js-close-demo-call-modal" aria-label="Закрити">×</button>
        <div id="dcm-form-state">
          <div class="dcm-badge"><span class="dcm-rec-dot"></span><span>Live Demo</span></div>
          <h2 id="dcm-title">Відчуйте AI дзвінок прямо зараз</h2>
          <p class="dcm-sub">Залиште номер — AI-агент зателефонує вам протягом 60 секунд.</p>
          <form id="dcm-form" novalidate>
            <label class="dcm-label" for="dcm-name">Ім'я</label>
            <input id="dcm-name" class="dcm-input" type="text" name="name" autocomplete="name" placeholder="Введіть ваше ім'я" />
            <label class="dcm-label" for="dcm-phone">Телефон <span class="req">*</span></label>
            <input id="dcm-phone" class="dcm-input" type="tel" name="phone" autocomplete="tel" inputmode="tel" placeholder="+380 50 123 45 67" required />
            <div class="dcm-phone-err" id="dcm-phone-err">Введіть коректний номер телефону</div>
            <button type="submit" class="dcm-submit" id="dcm-submit">Зателефонуйте мені</button>
            <p class="dcm-feedback" id="dcm-feedback" role="status" aria-live="polite"></p>
          </form>
        </div>
        <div class="dcm-success" id="dcm-success" hidden>
          <h2>AI-агент дзвонить!</h2>
          <p>Очікуйте дзвінок протягом 60 секунд.</p>
          <button type="button" class="btn btn-outline js-close-demo-call-modal" style="margin-top:8px">Закрити</button>
        </div>
      </div>
    </div>

    <footer class="site-footer">
      <div class="container">
        <p>© <span id="yr"></span> <a href="https://ai-agent.website/">ai-agent.website</a></p>
      </div>
    </footer>
    <script>document.getElementById('yr').textContent=new Date().getFullYear()</script>
    <script src="app.js?v=20260812-2" defer></script>
  </body>
</html>
