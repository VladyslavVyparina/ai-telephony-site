<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#f0f3fc" />
  <title>Тестовий AI дзвінок — ai-agent.website</title>
  <meta name="description" content="Залиште номер телефону — AI-агент зателефонує вам протягом 60 секунд." />
  <link rel="icon" type="image/png" href="images/ai-mark.png" />
  <link rel="stylesheet" href="styles.css?v=20260806-2" />
  <style>
    body{min-height:100vh;display:flex;flex-direction:column}
    .demo-page-main{flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px}
    .demo-page-card{
      width:100%;max-width:560px;
      background:rgba(255,255,255,.82);
      border:1px solid rgba(255,255,255,.9);
      border-radius:24px;
      box-shadow:0 8px 60px rgba(0,0,0,.1);
      padding:52px 48px;
    }
    .dp-orb-wrap{display:flex;justify-content:center;margin-bottom:28px}
    .dp-orb{
      width:80px;height:80px;border-radius:50%;
      background:radial-gradient(circle at 35% 30%,#1a6ff5,#0044bb);
      border:2.5px solid rgba(100,210,255,.5);
      display:flex;align-items:center;justify-content:center;
      position:relative;
    }
    .dp-orb-glow{
      position:absolute;inset:-16px;border-radius:50%;
      background:radial-gradient(circle,rgba(0,113,227,.35),transparent 70%);
      animation:orb-pulse 2.4s ease-in-out infinite;pointer-events:none;
    }
    .dp-orb-ring{
      position:absolute;inset:-10px;border-radius:50%;
      border:1.5px solid rgba(100,210,255,.35);
      animation:orb-ring 2.8s ease-in-out infinite;
    }
    .dp-orb-icon{color:#fff;position:relative;z-index:1}
    .dp-badge{
      display:inline-flex;align-items:center;gap:6px;
      padding:5px 14px;border-radius:980px;
      background:rgba(0,113,227,.08);border:1px solid rgba(0,113,227,.2);
      color:var(--accent);font-size:13px;font-weight:700;
      letter-spacing:.03em;margin-bottom:16px;
    }
    .demo-page-card h1{font-size:clamp(22px,3vw,32px);margin-bottom:10px;text-align:center}
    .demo-page-card > .dp-sub{text-align:center;color:var(--text2);margin-bottom:28px;font-size:16px}
    .dp-features{list-style:none;display:flex;flex-direction:column;gap:10px;margin-bottom:28px}
    .dp-features li{display:flex;align-items:flex-start;gap:10px;font-size:15px;color:var(--text)}
    .dp-check{
      flex-shrink:0;width:20px;height:20px;border-radius:50%;
      background:rgba(0,113,227,.12);border:1px solid rgba(0,113,227,.3);
      color:var(--accent);display:flex;align-items:center;justify-content:center;
      margin-top:1px;
    }
    .dp-divider{border:none;border-top:1px solid rgba(0,0,0,.07);margin:0 0 24px}
    .dp-form-label{font-size:13px;font-weight:600;color:var(--text);display:block;margin-bottom:5px;padding-left:2px}
    .dp-form-input{
      width:100%;padding:12px 16px;border-radius:12px;
      border:1.5px solid rgba(0,0,0,.1);
      background:rgba(255,255,255,.85);
      font-family:inherit;font-size:16px;color:var(--text);
      margin-bottom:12px;
      transition:border-color .18s,box-shadow .18s;
      box-sizing:border-box;
    }
    .dp-form-input:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(0,113,227,.12)}
    .dp-form-input.is-error{border-color:#e74c3c}
    .dp-error{font-size:12px;color:#e74c3c;margin:-8px 0 10px 2px;display:none}
    .dp-error.show{display:block}
    .dp-submit{
      width:100%;padding:15px;border-radius:980px;border:none;
      background:var(--accent);color:#fff;
      font-family:inherit;font-size:16px;font-weight:700;
      cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;
      transition:filter .18s,transform .18s,box-shadow .18s;
      box-shadow:0 6px 28px rgba(0,113,227,.38);
      margin-top:4px;
    }
    .dp-submit:hover{filter:brightness(1.1);transform:translateY(-1px);box-shadow:0 8px 36px rgba(0,113,227,.5)}
    .dp-submit:disabled{opacity:.65;transform:none;cursor:default}
    .dp-submit.loading{animation:demo-call-pulse 1.2s ease-in-out infinite}
    .dp-disclaimer{text-align:center;font-size:12px;color:var(--text2);margin-top:14px}
    .dp-feedback{
      margin-top:12px;padding:12px 16px;border-radius:12px;
      font-size:14px;display:none;
    }
    .dp-feedback.success{background:rgba(0,113,227,.07);border:1px solid rgba(0,113,227,.2);color:var(--accent)}
    .dp-feedback.error{background:rgba(231,76,60,.07);border:1px solid rgba(231,76,60,.25);color:#c0392b}
    .dp-feedback.show{display:block}

    /* Success state */
    .dp-success{display:none;text-align:center}
    .dp-success.show{display:block}
    .dp-success-icon{
      width:80px;height:80px;border-radius:50%;
      background:linear-gradient(135deg,rgba(0,113,227,.1),rgba(100,210,255,.15));
      border:2px solid rgba(0,113,227,.3);
      display:flex;align-items:center;justify-content:center;
      margin:0 auto 20px;color:var(--accent);
      animation:success-pop .4s cubic-bezier(.22,1,.36,1) both;
    }
    .dp-countdown{
      display:flex;flex-direction:column;align-items:center;gap:8px;
      margin:20px 0 24px;
    }
    .dp-countdown-ring{position:relative;width:80px;height:80px}
    .dp-countdown-svg{width:80px;height:80px}
    .dp-countdown-num{
      position:absolute;inset:0;display:flex;align-items:center;justify-content:center;
      font-size:24px;font-weight:700;color:var(--accent);
    }
    .dp-countdown-label{font-size:13px;color:var(--text2)}
    .dp-back-link{
      display:inline-flex;align-items:center;gap:6px;
      color:var(--accent);font-size:14px;font-weight:600;
      margin-top:8px;cursor:pointer;background:none;border:none;
      transition:opacity .18s;
    }
    .dp-back-link:hover{opacity:.75}
    @media(max-width:600px){
      .demo-page-card{padding:32px 20px}
    }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="container hdr-inner">
      <div class="logo">ai-agent.website</div>
      <div class="hdr-actions">
        <a class="btn btn-outline hdr-cta" href="index.php">← На головну</a>
      </div>
    </div>
  </header>

  <main class="demo-page-main">
    <div class="demo-page-card">
      <div class="dp-orb-wrap">
        <div class="dp-orb">
          <span class="dp-orb-ring"></span>
          <span class="dp-orb-glow"></span>
          <svg class="dp-orb-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
        </div>
      </div>

      <!-- Form state -->
      <div id="dp-form-state">
        <div style="text-align:center;margin-bottom:24px">
          <div class="dp-badge">🤖 Live Demo</div>
          <h1>Відчуйте AI дзвінок прямо зараз</h1>
          <p class="dp-sub">Залиште номер — AI-агент зателефонує вам протягом 60 секунд. Це справжній дзвінок, не запис.</p>
        </div>

        <ul class="dp-features">
          <li>
            <span class="dp-check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span>
            Живий AI-голос, не запис
          </li>
          <li>
            <span class="dp-check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span>
            Відповідає на ваші питання в реальному часі
          </li>
          <li>
            <span class="dp-check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span>
            Дзвінок протягом 60 секунд
          </li>
        </ul>

        <hr class="dp-divider">

        <form id="dp-form" novalidate>
          <label class="dp-form-label" for="dp-name">Ім'я</label>
          <input id="dp-name" class="dp-form-input" type="text" name="name" autocomplete="name" placeholder="Введіть ваше ім'я" />

          <label class="dp-form-label" for="dp-phone">Телефон <span style="color:#e74c3c">*</span></label>
          <input id="dp-phone" class="dp-form-input" type="tel" name="phone" autocomplete="tel" inputmode="tel" placeholder="+380 50 123 45 67" required />
          <div class="dp-error" id="dp-phone-error">Введіть коректний номер телефону</div>

          <button type="submit" class="dp-submit" id="dp-submit">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            Зателефонуйте мені
          </button>
          <div class="dp-feedback" id="dp-feedback"></div>
        </form>
        <p class="dp-disclaimer">Демо-дзвінок безкоштовний. Без спаму та нав'язливих продажів.</p>
      </div>

      <!-- Success state -->
      <div class="dp-success" id="dp-success">
        <div class="dp-success-icon">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
        </div>
        <h1 style="font-size:26px;margin-bottom:10px">AI-агент дзвонить!</h1>
        <p style="color:var(--text2);margin-bottom:20px">Очікуйте дзвінок протягом 60 секунд. Підготуйтесь до справжньої демонстрації AI.</p>
        <div class="dp-countdown">
          <div class="dp-countdown-ring">
            <svg class="dp-countdown-svg" viewBox="0 0 36 36">
              <circle cx="18" cy="18" r="15.9" fill="none" stroke="rgba(0,113,227,.1)" stroke-width="2.5"/>
              <circle cx="18" cy="18" r="15.9" fill="none" stroke="#0071e3" stroke-width="2.5"
                stroke-dasharray="100 100" stroke-linecap="round"
                id="dp-countdown-ring" transform="rotate(-90 18 18)"/>
            </svg>
            <span class="dp-countdown-num" id="dp-countdown-num">60</span>
          </div>
          <p class="dp-countdown-label">секунд до дзвінка</p>
        </div>
        <a class="dp-back-link" href="index.php">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
          Повернутись на сайт
        </a>
      </div>
    </div>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p>© <span id="yr"></span> <a href="https://ai-agent.website/">ai-agent.website</a></p>
    </div>
  </footer>

  <script>
  document.getElementById('yr').textContent = new Date().getFullYear();

  (function(){
    var form     = document.getElementById('dp-form');
    var phoneInp = document.getElementById('dp-phone');
    var nameInp  = document.getElementById('dp-name');
    var submitBtn= document.getElementById('dp-submit');
    var feedback = document.getElementById('dp-feedback');
    var phoneErr = document.getElementById('dp-phone-error');
    var formState= document.getElementById('dp-form-state');
    var successEl= document.getElementById('dp-success');
    var countdownNum  = document.getElementById('dp-countdown-num');
    var countdownRing = document.getElementById('dp-countdown-ring');
    var countdownTimer;

    function validatePhone(v){return v.replace(/\D/g,'').length >= 10}
    function normalizePhone(v){
      var d = v.replace(/\D/g,'');
      if(d.startsWith('38') && d.length===12) return '+'+d;
      if(d.startsWith('8')  && d.length===11) return '+3'+d;
      if(d.length===10) return '+38'+d;
      return '+'+d;
    }

    phoneInp.addEventListener('input', function(){
      this.value = this.value.replace(/[^0-9+\-\s()]/g,'');
      this.classList.remove('is-error');
      phoneErr.classList.remove('show');
    });

    function startCountdown(){
      var secs = 60;
      countdownNum.textContent = secs;
      if(countdownTimer) clearInterval(countdownTimer);
      countdownTimer = setInterval(function(){
        secs--;
        countdownNum.textContent = secs;
        if(countdownRing){
          countdownRing.style.strokeDasharray = ((secs/60)*100) + ' 100';
        }
        if(secs <= 0){
          clearInterval(countdownTimer);
          countdownNum.textContent = '✓';
        }
      }, 1000);
    }

    form.addEventListener('submit', function(e){
      e.preventDefault();
      if(!validatePhone(phoneInp.value)){
        phoneInp.classList.add('is-error');
        phoneErr.classList.add('show');
        phoneInp.focus();
        return;
      }
      var phone = normalizePhone(phoneInp.value);
      var name  = (nameInp.value||'').trim();

      submitBtn.disabled = true;
      submitBtn.classList.add('loading');
      feedback.className = 'dp-feedback';
      feedback.textContent = '';

      fetch('demo-call.php', {
        method:'POST',
        headers:{'Content-Type':'application/json','Accept':'application/json'},
        body: JSON.stringify({phone: phone, name: name})
      })
      .then(function(r){return r.json()})
      .then(function(r){
        submitBtn.disabled = false;
        submitBtn.classList.remove('loading');
        if(r.ok){
          formState.style.display = 'none';
          successEl.classList.add('show');
          startCountdown();
        } else {
          var msg = 'Помилка. Спробуйте ще раз.';
          if(r.error === 'rate_limit'){
            msg = 'Демо-дзвінок вже замовлено. Очікуйте дзвінка протягом 30 хвилин.';
          } else if(r.error === 'invalid_phone'){
            msg = 'Некоректний формат телефону (+380XXXXXXXXX).';
          } else if(r.error === 'crm_not_configured' || r.error === 'crm_unreachable' || r.error === 'crm_error'){
            msg = 'Демо-дзвінки тимчасово недоступні. Спробуйте пізніше.';
          } else if(r.message && !/secrets\.php|CRM API|includes\//i.test(r.message)){
            msg = r.message;
          }
          feedback.textContent = msg;
          feedback.className = 'dp-feedback error show';
        }
      })
      .catch(function(){
        submitBtn.disabled = false;
        submitBtn.classList.remove('loading');
        feedback.textContent = 'Мережева помилка. Перевірте з\'єднання і спробуйте ще раз.';
        feedback.className = 'dp-feedback error show';
      });
    });
  })();
  </script>
</body>
</html>
