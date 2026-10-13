<?php
require_once __DIR__ . '/includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="uk" data-lang="uk">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="theme-color" content="#f0f3fc" />
    <title>AI-менеджер для продажів — ai-agent.website</title>
    <meta name="description" content="AI-менеджер, який дзвонить, відповідає на заявки та доводить клієнтів до угоди. Підключення під ключ." />
    <link rel="icon" type="image/png" href="images/ai-mark.png" />
    <link rel="canonical" href="https://ai-agent.website/" />
    <link rel="stylesheet" href="styles.css?v=20260823" />
    <?php require __DIR__ . '/includes/head-tracking.php'; ?>
  </head>
  <body>
    <a class="skip-link" href="#main">До основного вмісту</a>

    <!-- HEADER -->
    <header class="site-header">
      <div class="container hdr-inner">
        <div class="logo">Pulse AI</div>
        <nav class="nav-links" aria-label="Навігація">
          <a href="#capabilities" data-i18n="nav_capabilities">Що вміє</a>
          <a href="#compare" data-i18n="nav_compare">AI vs Менеджер</a>
          <a href="#plans" data-i18n="nav_plans">Пакети</a>
          <a href="#steps" data-i18n="nav_steps">Запуск</a>
          <a href="#cases" data-i18n="nav_cases">Результати</a>
          <a href="#voices" data-i18n="nav_voices">Голоси</a>
        </nav>
        <div class="hdr-actions">
          <!-- Language dropdown -->
          <div class="lang-dropdown" id="lang-dropdown">
            <button type="button" class="lang-dropdown-btn js-lang-toggle" aria-haspopup="listbox" aria-expanded="false">
              <span class="lang-dd-flag js-lang-flag">🇺🇦</span>
              <span class="lang-dd-name js-lang-name">UA</span>
              <svg class="lang-dd-caret" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="lang-dd-menu" id="lang-dd-menu" role="listbox" hidden>
              <button type="button" class="lang-dd-opt js-lang-opt is-active" data-lang="uk" role="option" aria-selected="true">
                <span class="lang-dd-opt-flag">🇺🇦</span>
                <span class="lang-dd-opt-label">Українська</span>
                <svg class="lang-dd-check" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
              </button>
              <button type="button" class="lang-dd-opt js-lang-opt" data-lang="en" role="option" aria-selected="false">
                <span class="lang-dd-opt-flag">🇬🇧</span>
                <span class="lang-dd-opt-label">English</span>
                <svg class="lang-dd-check" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
              </button>
            </div>
          </div>
          <button type="button" class="btn btn-outline hdr-cta-demo js-open-demo-call-modal" data-i18n="btn_test_call">Тестовий AI дзвінок</button>
          <button type="button" class="btn btn-primary hdr-cta js-open-demo-call-modal" data-i18n="btn_get_demo">Отримати демо</button>
        </div>
      </div>
    </header>

    <main id="main">

      <!-- ① HERO -->
      <section id="hero" class="section hero-section" aria-labelledby="hero-h1">
        <div class="container hero-inner">

          <div class="hero-copy reveal-left">
            <h1 id="hero-h1">
              <span class="hi-blue" data-i18n="hero_h1_accent">AI-менеджер</span><span data-i18n="hero_h1_rest">, який дзвонить,
              відповідає на заявки і доводить клієнтів до угоди</span>
            </h1>
            <p class="hero-sub" data-i18n="hero_sub">Замініть відділ продажів або посильте його — без найму, навчання та людського фактора.</p>
            <p class="hero-price-pill" data-i18n="hero_price">Підключення — 40&nbsp;000&nbsp;грн&nbsp;&nbsp;·&nbsp;&nbsp;Ведення — від $100/міс</p>
            <div class="hero-btns">
              <button type="button" class="btn btn-primary btn-lg js-open-demo-call-modal" data-i18n="btn_get_demo">Отримати демо</button>
              <button type="button" class="btn btn-outline btn-lg js-open-demo-call-modal" data-i18n="btn_test_call">Тестовий AI дзвінок</button>
            </div>
          </div>

          <div class="hero-phone-wrap reveal-right" id="hero-stage">
            <!-- floating particles -->
            <div class="hero-particles" aria-hidden="true">
              <span class="particle p1"></span>
              <span class="particle p2"></span>
              <span class="particle p3"></span>
              <span class="particle p4"></span>
              <span class="particle p5"></span>
            </div>
            <!-- wave -->
            <div class="wave-track" aria-hidden="true">
              <div class="wave-scale">
                <div class="wave-layer wave-layer--b">
                  <svg class="wave-svg" viewBox="0 0 3200 160" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMid slice">
                    <defs>
                      <linearGradient id="wgB" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%"   stop-color="#5ac8fa" stop-opacity="0.08"/>
                        <stop offset="50%"  stop-color="#0071e3" stop-opacity="0.38"/>
                        <stop offset="100%" stop-color="#5ac8fa" stop-opacity="0.08"/>
                      </linearGradient>
                    </defs>
                    <g class="wave-tile">
                      <path stroke="url(#wgB)" stroke-width="3" stroke-linecap="round" fill="none"
                        d="M0 80 C140 56 260 104 400 80 S640 56 780 80 S840 76 900 80 S1100 104 1280 80 S1460 56 1600 80"/>
                      <path stroke="url(#wgB)" stroke-width="3" stroke-linecap="round" fill="none"
                        transform="translate(1600 0)"
                        d="M0 80 C140 56 260 104 400 80 S640 56 780 80 S840 76 900 80 S1100 104 1280 80 S1460 56 1600 80"/>
                    </g>
                  </svg>
                </div>
                <div class="wave-layer wave-layer--f">
                  <svg class="wave-svg" viewBox="0 0 3200 160" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMid slice">
                    <defs>
                      <linearGradient id="wgF" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%"   stop-color="#64d2ff" stop-opacity="0.14"/>
                        <stop offset="50%"  stop-color="#0071e3" stop-opacity="0.68"/>
                        <stop offset="100%" stop-color="#64d2ff" stop-opacity="0.14"/>
                      </linearGradient>
                    </defs>
                    <g class="wave-tile">
                      <path stroke="url(#wgF)" stroke-width="3.2" stroke-linecap="round" fill="none"
                        d="M0 80 C120 108 280 52 420 80 S660 108 800 80 S860 84 920 80 S1120 52 1300 80 S1480 108 1600 80"/>
                      <path stroke="url(#wgF)" stroke-width="3.2" stroke-linecap="round" fill="none"
                        transform="translate(1600 0)"
                        d="M0 80 C120 108 280 52 420 80 S660 108 800 80 S860 84 920 80 S1120 52 1300 80 S1480 108 1600 80"/>
                    </g>
                  </svg>
                </div>
              </div>
            </div>
            <!-- iPhone mock -->
            <div class="iphone-mock">
              <div class="iphone-frame">
                <div class="iphone-notch"></div>
                <div class="iphone-screen">
                  <!-- AI orb — click opens audio modal -->
                  <button type="button"
                    class="ai-orb js-open-audio-modal"
                    id="btn-hero-demo"
                    aria-label="Прослухати приклади дзвінків">
                    <span class="ai-orb-ring" aria-hidden="true"></span>
                    <span class="ai-orb-glow" aria-hidden="true"></span>
                    <span class="ai-orb-label">AI</span>
                    <span class="ai-orb-play" aria-hidden="true">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7L8 5z"/></svg>
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <audio id="hero-demo-audio" preload="metadata" playsinline></audio>
          </div>

        </div>
      </section>

      <!-- ② ЩО ВМІЄ -->
      <section id="capabilities" class="section bg-soft" aria-labelledby="cap-h2">
        <div class="container">
          <h2 id="cap-h2" class="reveal-up"><span data-i18n="cap_h2_pre">Що вміє наш </span><span class="hi-blue" data-i18n="cap_h2_accent">AI-менеджер</span></h2>
          <p class="sec-intro reveal-up" data-i18n="cap_intro">Подивіться AI-менеджера в дії: як він обробляє заявки і записує клієнтів 24/7</p>
          <div class="cap-layout">
            <div class="cap-features reveal-left">
              <div class="cap-feat is-open" data-feat="speed">
                <button class="cap-feat-head js-cap-feat" type="button">
                  <span class="cap-icon">⏱</span>
                  <span><span data-i18n="cap_speed_pre">Відповідає за </span><strong class="hi-blue" data-i18n="cap_speed_accent">2 секунди</strong></span>
                </button>
                <p class="cap-feat-body" data-i18n="cap_speed_body">Не пропускає гарячі заявки, стартує діалог миттєво і веде до запису.</p>
              </div>
              <div class="cap-feat" data-feat="close">
                <button class="cap-feat-head js-cap-feat" type="button">
                  <span class="cap-icon">🤝</span>
                  <span data-i18n="cap_close">Закриває до запису</span>
                </button>
                <p class="cap-feat-body" data-i18n="cap_close_body">Уточнює деталі, пропонує зручний час і фіксує бронювання в CRM.</p>
              </div>
              <div class="cap-feat" data-feat="nonstop">
                <button class="cap-feat-head js-cap-feat" type="button">
                  <span class="cap-icon">🕐</span>
                  <span><span data-i18n="cap_nonstop_pre">Працює </span><strong class="hi-blue" data-i18n="cap_nonstop_accent">24/7 без втоми</strong></span>
                </button>
                <p class="cap-feat-body" data-i18n="cap_nonstop_body">Стабільна якість у будь-який час — без хвороб, вигорання і людського фактора.</p>
              </div>
              <div class="cap-feat" data-feat="crm">
                <button class="cap-feat-head js-cap-feat" type="button">
                  <span class="cap-icon">📊</span>
                  <span data-i18n="cap_crm">Знаходиться в CRM</span>
                </button>
                <p class="cap-feat-body" data-i18n="cap_crm_body">Інтегрується з вашою системою, економить час і веде порядок у заявках.</p>
              </div>
            </div>
            <div class="cap-preview glass-card reveal-right">
              <div class="cap-preview-video">
                <div class="vid-mock">
                  <span class="vid-play-btn">▶</span>
                  <p class="vid-label" data-i18n="cap_vid_label">Demo AI-менеджера в роботі</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ③ AI VS МЕНЕДЖЕР -->
      <section id="compare" class="section" aria-labelledby="cmp-h2">
        <div class="container">
          <h2 id="cmp-h2" class="reveal-up"><span data-i18n="cmp_h2_pre">AI-agent vs </span><span class="hi-blue" data-i18n="cmp_h2_accent">Менеджер</span></h2>
          <p class="sec-intro reveal-up" data-i18n="cmp_intro">Натисніть на персонажа — побачите переваги чи недоліки.</p>
          <div class="cmp-wrap reveal-up">
            <div class="cmp-switcher">
              <button class="cmp-card is-active" type="button" data-cmp="ai" aria-pressed="true">
                <span class="cmp-card-title" data-i18n="cmp_ai_title">AI-агент</span>
                <span class="cmp-card-sub" data-i18n="cmp_ai_sub">(Бот)</span>
              </button>
              <button class="cmp-card" type="button" data-cmp="human" aria-pressed="false">
                <span class="cmp-card-title" data-i18n="cmp_human_title">Менеджер</span>
                <span class="cmp-card-sub" data-i18n="cmp_human_sub">(Людина)</span>
              </button>
            </div>
            <div class="cmp-detail glass-card" id="cmp-detail">
              <h3 class="js-cmp-title">AI-агент (Бот)</h3>
              <ul class="cmp-list js-cmp-list">
                <li>24/7/365. Завжди на зв'язку</li>
                <li>Стабільність. Якість незалежна від настрою</li>
                <li>Безліміт. Обробляє 1000 діалогів одночасно</li>
                <li>Безсмертний. Всі знання залишаються в системі</li>
              </ul>
              <button type="button" class="btn btn-primary js-open-demo-call-modal" data-i18n="btn_get_ai">Отримати AI</button>
            </div>
          </div>
        </div>
      </section>

      <!-- ④ ПРОБЛЕМИ (карусель) -->
      <section id="pain" class="section bg-soft" aria-labelledby="pain-h2">
        <div class="container">
          <h2 id="pain-h2" class="reveal-up"><span data-i18n="pain_h2_pre">Ви вже </span><span class="hi-blue" data-i18n="pain_h2_accent">втрачаєте гроші</span><span data-i18n="pain_h2_post">. Кожний день.</span></h2>
          <p class="sec-intro reveal-up" data-i18n="pain_intro">Не через рекламу. Не через ринок. А через дірки в процесах, які коштують вам клієнтів і виручки.</p>
          <div class="pain-layout">
            <div class="pain-left glass-card reveal-left">
              <p class="pain-left-note" data-i18n="pain_note">Схоже, у вас є ці проблеми — гроші йдуть до конкурентів.</p>
              <p><strong data-i18n="pain_solution">AI-менеджер закриє всі втрати.</strong><br><span data-i18n="pain_solution_sub">Перехопить заявки і примножить гроші.</span></p>
              <button type="button" class="btn btn-primary js-open-demo-call-modal" data-i18n="btn_demo_ai">Отримати демо AI-менеджера</button>
            </div>
            <div class="pain-carousel-wrap reveal-right">
              <div class="pain-carousel js-pain-carousel">
                <article class="pain-slide is-active">
                  <div class="pain-slide-icon">📞</div>
                  <h3 data-i18n="pain1_title">Пропущені дзвінки</h3>
                  <p data-i18n="pain1_text">Клієнт не чекає: він іде до конкурента.</p>
                  <strong class="pain-stat" data-i18n="pain1_stat">+15% грошей втрачається щодня</strong>
                </article>
                <article class="pain-slide">
                  <div class="pain-slide-icon">⏳</div>
                  <h3 data-i18n="pain2_title">Повільний зворотній зв'язок</h3>
                  <p data-i18n="pain2_text">Відповідь через 15 хвилин вже надто пізно.</p>
                  <strong class="pain-stat" data-i18n="pain2_stat">До 50% заявок залишаються без відповіді</strong>
                </article>
                <article class="pain-slide">
                  <div class="pain-slide-icon">💤</div>
                  <h3 data-i18n="pain3_title">Неактивна база</h3>
                  <p data-i18n="pain3_text">Контакти є, а продажів із бази немає.</p>
                  <strong class="pain-stat" data-i18n="pain3_stat">Тисячі сплячих клієнтів у базі</strong>
                </article>
              </div>
              <!-- Navigation: dots + arrows -->
              <div class="pain-nav">
                <button type="button" class="pain-arrow pain-arrow--prev js-pain-prev" aria-label="Попередній слайд">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <div class="pain-dots js-pain-dots">
                  <span class="pain-dot is-active"></span>
                  <span class="pain-dot"></span>
                  <span class="pain-dot"></span>
                </div>
                <button type="button" class="pain-arrow pain-arrow--next js-pain-next" aria-label="Наступний слайд">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ⑤ ПАКЕТИ -->
      <section id="plans" class="section" aria-labelledby="plans-h2">
        <div class="container">
          <h2 id="plans-h2" class="reveal-up"><span data-i18n="plans_h2_pre">Стартовий пакет </span><span class="hi-blue" data-i18n="plans_h2_accent">AI-менеджера</span></h2>
          <p class="sec-intro reveal-up" data-i18n="plans_intro">Миттєво відповідає і забирає «гарячих» клієнтів</p>
          <div class="plans-layout">
            <div class="plans-accordion js-accordion reveal-left">
              <div class="plan-item is-open">
                <button class="plan-head js-plan-head" type="button" data-i18n="plan1_head">AI відповідає за секунди</button>
                <div class="plan-body">
                  <ul>
                    <li data-i18n="plan1_li1">без очікування</li>
                    <li data-i18n="plan1_li2">без виправдань</li>
                    <li data-i18n="plan1_li3">одразу веде діалог і записи</li>
                  </ul>
                </div>
              </div>
              <div class="plan-item">
                <button class="plan-head js-plan-head" type="button" data-i18n="plan2_head">Доводить клієнта до запису, а не «передає далі»</button>
                <div class="plan-body">
                  <ul>
                    <li data-i18n="plan2_li1">уточнює зручний час</li>
                    <li data-i18n="plan2_li2">узгоджує деталі</li>
                    <li data-i18n="plan2_li3">записує клієнта в CRM</li>
                  </ul>
                </div>
              </div>
              <div class="plan-item">
                <button class="plan-head js-plan-head" type="button" data-i18n="plan3_head">Працює 24/7 без втоми</button>
                <div class="plan-body">
                  <ul>
                    <li data-i18n="plan3_li1">не помиляється і завжди на зв'язку</li>
                    <li data-i18n="plan3_li2">відповідає вночі та у вихідні</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="plan-cta glass-card reveal-right">
              <p class="plan-price"><span data-i18n="plan_price_label">Впровадження </span><strong>40&nbsp;000&nbsp;грн</strong></p>
              <p class="plan-price-sub" data-i18n="plan_price_sub">Окупається за рахунок миттєвих продажів вже за 1–2 тижні</p>
              <button type="button" class="btn btn-primary js-open-demo-call-modal" data-plan="start" data-i18n="btn_choose_plan">Вибрати план</button>
            </div>
          </div>

          <div class="plan-ext glass-card reveal-up">
            <h3><span data-i18n="plan_ext_h3_pre">Розширена версія: </span><span class="hi-blue" data-i18n="plan_ext_h3_accent">пам'ять + аналітика</span></h3>
            <div class="plan-ext-grid">
              <div>
                <h4 data-i18n="plan_ext1_h4">Запам'ятовує клієнтів і веде діалог на дистанції</h4>
                <p data-i18n="plan_ext1_p">Кожен дзвінок транскрибується. AI пам'ятає все і продовжує з того ж місця навіть через місяці.</p>
              </div>
              <div>
                <h4 data-i18n="plan_ext2_h4">Продає по-різному, а не за шаблоном</h4>
                <p data-i18n="plan_ext2_p">Аналізує профіль клієнта і підбирає підхід: комусь частіше, комусь — дорожчу послугу.</p>
              </div>
              <div>
                <h4 data-i18n="plan_ext3_h4">Сам повертає клієнтів</h4>
                <p data-i18n="plan_ext3_p">Відстежує дату останнього візиту та ініціює контакт — як живий менеджер, але масштабовано.</p>
              </div>
              <div>
                <h4 data-i18n="plan_ext4_h4">Масштабується на мережу без втрати якості</h4>
                <p data-i18n="plan_ext4_p">Єдиний стандарт на всіх точках. Без хаосу при зростанні.</p>
              </div>
            </div>
            <div class="plan-ext-footer">
              <p><span data-i18n="plan_ext_price_label">Ціна </span><strong>100&nbsp;000&nbsp;грн</strong></p>
              <button type="button" class="btn btn-primary js-open-demo-call-modal" data-plan="pro" data-i18n="btn_choose_plan">Вибрати план</button>
            </div>
          </div>
        </div>
      </section>

      <!-- ⑥ 5 КРОКІВ -->
      <section id="steps" class="section bg-soft" aria-labelledby="steps-h2">
        <div class="container">
          <h2 id="steps-h2" class="reveal-up"><span data-i18n="steps_h2_pre">Запуск за </span><span class="hi-blue" data-i18n="steps_h2_accent">5 кроків</span></h2>
          <p class="sec-intro reveal-up" data-i18n="steps_intro">Прозорий процес від першої зустрічі до перших угод.</p>
          <div class="steps-track reveal-up">
            <div class="steps-bar">
              <div class="steps-bar-fill js-steps-fill"></div>
            </div>
            <ol class="steps-list js-steps-list">
              <li class="step-li is-active" data-step="0"><span class="step-num-dot">1</span><span data-i18n="step1">Аналіз</span></li>
              <li class="step-li" data-step="1"><span class="step-num-dot">2</span><span data-i18n="step2">Сценарії</span></li>
              <li class="step-li" data-step="2"><span class="step-num-dot">3</span><span data-i18n="step3">CRM</span></li>
              <li class="step-li" data-step="3"><span class="step-num-dot">4</span><span data-i18n="step4">Навчання</span></li>
              <li class="step-li" data-step="4"><span class="step-num-dot">5</span><span data-i18n="step5">Запуск</span></li>
            </ol>
          </div>
          <div class="step-detail glass-card js-step-detail reveal-up">
            <h3>1. Аналізуємо ваш бізнес</h3>
            <p>Вивчаємо, як приходять клієнти і де втрачаються заявки.</p>
          </div>
          <p class="steps-outro reveal-up" data-i18n="steps_outro">Вам не потрібно розбиратися — ми робимо все під ключ.</p>
        </div>
      </section>

      <!-- ⑦ КЕЙСИ -->
      <section id="cases" class="section" aria-labelledby="cases-h2">
        <div class="container">
          <h2 id="cases-h2" class="reveal-up"><span data-i18n="cases_h2_pre">AI в продажах — це </span><span class="hi-blue" data-i18n="cases_h2_accent">вимірюваний результат</span><span data-i18n="cases_h2_post">, а не гіпотеза</span></h2>
          <p class="sec-intro reveal-up" data-i18n="cases_intro">Ми впроваджуємо AI-агентів у відділи продажів і фіксуємо зростання ключових метрик вже в перші тижні.</p>
          <h3 class="cases-sub reveal-up" data-i18n="cases_sub">Результати клієнтів</h3>
          <p class="sec-intro reveal-up" style="margin-top:-8px" data-i18n="cases_niches">Підтверджені кейси в нішах: нерухомість, інфобізнес, послуги.</p>
          <div class="cases-grid">
            <article class="case-card glass-card reveal-up" style="--reveal-delay:.05s">
              <p class="case-stat" data-i18n="case1_stat">+37% повторних продаж</p>
              <h4 data-i18n="case1_niche">Нерухомість</h4>
              <p>AI-агент активував базу з 4&nbsp;000 неактуалізованих контактів.</p>
              <ul class="case-ul">
                <li>2&nbsp;800 вихідних комунікацій за 7 днів</li>
                <li>Повторно залучено понад 600 клієнтів</li>
                <li>14 додаткових угод без розширення команди</li>
              </ul>
            </article>
            <article class="case-card glass-card reveal-up" style="--reveal-delay:.12s">
              <p class="case-stat" data-i18n="case2_stat">×2 зростання конверсії</p>
              <h4 data-i18n="case2_niche">Інфобізнес</h4>
              <p data-i18n="case2_text">AI обробляє вхідні заявки замість менеджерів. Відповідь клієнту до 5 секунд. Конверсія: 18% → 36%</p>
              <p class="case-what"><strong data-i18n="case_what">Що це дає бізнесу</strong></p>
              <ul class="case-ul">
                <li data-i18n="case2_li1">Швидке повернення «сплячих» клієнтів</li>
                <li data-i18n="case2_li2">Збільшення конверсії без зростання трафіку</li>
                <li data-i18n="case2_li3">Зниження навантаження на команду</li>
                <li data-i18n="case2_li4">Прогнозований зріст виручки</li>
              </ul>
            </article>
            <article class="case-card glass-card reveal-up" style="--reveal-delay:.19s">
              <p class="case-stat" data-i18n="case3_stat">−60% витрат на відділ продажів</p>
              <h4 data-i18n="case3_niche">Послуги</h4>
              <p data-i18n="case3_text">AI замінив частину функцій менеджерів без втрати виручки.</p>
              <ul class="case-ul">
                <li>Скорочення команди з 3 до 1 спеціаліста</li>
                <li>Збереження обсягу продажів</li>
                <li>Зниження розходів на 60%</li>
              </ul>
              <div class="case-cta">
                <p><strong data-i18n="case_cta_q">Готові впровадити AI у ваш відділ продажів?</strong></p>
                <div class="case-cta-btns">
                  <button type="button" class="btn btn-primary btn-sm js-open-demo-call-modal" data-plan="audit" data-i18n="btn_audit">Отримати аудит</button>
                  <button type="button" class="btn btn-outline btn-sm js-open-demo-call-modal" data-plan="demo" data-i18n="btn_book_demo">Записатись на демонстрацію</button>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>

      <!-- ⑧ ВИБІР ГОЛОСУ -->
      <section id="voices" class="section bg-soft" aria-labelledby="voices-h2">
        <div class="container">
          <h2 id="voices-h2" class="reveal-up"><span data-i18n="voices_h2_pre">Виберіть </span><span class="hi-blue" data-i18n="voices_h2_accent">AI-менеджера</span><span data-i18n="voices_h2_post"> під ваш бізнес</span></h2>
          <p class="sec-intro reveal-up" data-i18n="voices_intro">Різні голоси і стилі спілкування — під різні задачі.</p>
          <div class="voices-layout reveal-up">
            <div class="voices-tabs js-voices-tabs">
              <button type="button" class="voice-tab is-active" data-voice="anna">
                <span class="voice-tab-name" data-i18n="voice_anna">Поліна</span>
                <span class="voice-tab-badge" data-i18n="voice_anna_badge">Реанімація бази</span>
              </button>
              <button type="button" class="voice-tab" data-voice="maksym">
                <span class="voice-tab-name" data-i18n="voice_maksym">Мія</span>
                <span class="voice-tab-badge" data-i18n="voice_maksym_badge">Дожим угод</span>
              </button>
              <button type="button" class="voice-tab" data-voice="olena">
                <span class="voice-tab-name" data-i18n="voice_olena">Софія</span>
                <span class="voice-tab-badge" data-i18n="voice_olena_badge">Повторні продажі</span>
              </button>
            </div>
            <div class="voice-detail glass-card js-voice-detail">
              <div class="voice-player">
                <button type="button" class="voice-play-btn js-voice-play" data-audio="audio/demo-1.m4a" aria-label="Прослухати голос">
                  <span class="voice-play-icon js-vp-icon">
                    <svg class="ico-play" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7L8 5z"/></svg>
                    <svg class="ico-pause" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M6 5h4v14H6V5zm8 0h4v14h-4V5z"/></svg>
                  </span>
                  <span class="voice-play-label js-vp-label" data-i18n="voice_listen">Прослухати зразок</span>
                </button>
                <div class="voice-waveform js-voice-waveform" aria-hidden="true">
                  <span></span><span></span><span></span><span></span><span></span>
                  <span></span><span></span><span></span><span></span><span></span>
                </div>
              </div>
              <h3 class="js-voice-name">Поліна</h3>
              <p class="js-voice-text">Реанімувала мертву базу за 7 днів. AI за першу тиждень повернув 5 реальних угод із бази, яку вважали втраченою. +5 угод зі старої бази.</p>
              <button type="button" class="btn btn-primary js-select-voice" data-voice="anna" data-i18n="btn_select_voice">Вибрати персонажа і замовити демо-дзвінок</button>
            </div>
          </div>
          <audio id="voice-audio" preload="metadata" playsinline></audio>
        </div>
      </section>

      <!-- ⑨ ДЕМО-ДЗВІНОК -->
      <section id="demo" class="section" aria-labelledby="demo-h2">
        <div class="container">
          <div class="demo-choice reveal-up">
            <h2 id="demo-h2" class="demo-choice-h2" data-i18n="demo_h2_new">Спробуйте AI-менеджера прямо зараз</h2>
            <p class="demo-choice-sub" data-i18n="demo_sub_new">Оберіть зручний спосіб познайомитись з нашим AI</p>
            
            <div class="demo-cards">
              <!-- Вхідна лінія — дзвінок з браузера -->
              <div class="demo-card demo-card--call glass-card">
                <div class="demo-card-icon demo-card-icon--call">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                    <path d="M14.05 2a9 9 0 018 7.94"/>
                    <path d="M14.05 6A5 5 0 0119 10.95"/>
                  </svg>
                </div>
                <span class="demo-card-badge" data-i18n="demo_instant">Миттєво</span>
                <h3 data-i18n="demo_call_title">Поговорити з AI зараз</h3>
                <p data-i18n="demo_call_desc">Натисніть кнопку — AI-агент відповість прямо в браузері. Потрібен мікрофон.</p>
                <ul class="demo-card-features">
                  <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="demo_f1">Без реєстрації</span></li>
                  <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="demo_f2">Без очікування</span></li>
                  <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="demo_f3">Живий діалог</span></li>
                </ul>
                <button type="button" class="btn btn-primary btn-lg demo-card-btn js-start-ai-call" data-i18n="btn_talk_now">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  Почати розмову
                </button>
              </div>

              <!-- Вихідний дзвінок — AI телефонує -->
              <div class="demo-card demo-card--callback glass-card">
                <div class="demo-card-icon demo-card-icon--callback">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                    <path d="M14.5 4.5h5m0 0v5m0-5l-6.5 6.5"/>
                  </svg>
                </div>
                <span class="demo-card-badge demo-card-badge--alt" data-i18n="demo_60sec">60 секунд</span>
                <h3 data-i18n="demo_callback_title">AI зателефонує вам</h3>
                <p data-i18n="demo_callback_desc">Залиште номер — AI-агент зателефонує на ваш телефон протягом хвилини.</p>
                <ul class="demo-card-features">
                  <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="demo_f4">Справжній дзвінок</span></li>
                  <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="demo_f5">На ваш номер</span></li>
                  <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="demo_f6">Безкоштовно</span></li>
                </ul>
                <button type="button" class="btn btn-outline btn-lg demo-card-btn js-open-demo-call-modal" data-i18n="btn_call_me">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                  Зателефонуйте мені
                </button>
              </div>
            </div>

            <p class="demo-disclaimer" data-i18n="demo_disclaimer">Демо-дзвінок безкоштовний. Без спаму та нав'язливих продажів.</p>
          </div>
        </div>
      </section>

    </main>

    <!-- AUDIO SAMPLES MODAL (click on AI orb) -->
    <div class="audio-modal" id="audio-modal" hidden aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="am-title">
      <div class="audio-modal-overlay js-close-audio-modal"></div>
      <div class="audio-modal-card">
        <button type="button" class="modal-close js-close-audio-modal" aria-label="Закрити">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <h3 id="am-title" data-i18n="demo_modal_title">Приклади дзвінків AI</h3>
        <p data-i18n="demo_modal_sub">Натисніть, щоб прослухати реальні демо</p>
        <div class="am-list">
          <button type="button" class="am-item js-hero-demo-item" data-demo-src="audio/demo-1.m4a">
            <span class="am-item-icon js-di-icon">
              <svg class="ico-play" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7L8 5z"/></svg>
              <svg class="ico-pause" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6 5h4v14H6V5zm8 0h4v14h-4V5z"/></svg>
            </span>
            <div class="am-item-info">
              <strong data-i18n="demo_cold">Холодний дзвінок</strong>
              <span data-i18n="demo_cold_sub">Вихідний дзвінок по холодній базі</span>
            </div>
          </button>
          <button type="button" class="am-item js-hero-demo-item" data-demo-src="audio/demo-2.m4a">
            <span class="am-item-icon js-di-icon">
              <svg class="ico-play" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7L8 5z"/></svg>
              <svg class="ico-pause" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6 5h4v14H6V5zm8 0h4v14h-4V5z"/></svg>
            </span>
            <div class="am-item-info">
              <strong data-i18n="demo_confirm">Підтвердження заявки</strong>
              <span data-i18n="demo_confirm_sub">Обробка вхідного ліда</span>
            </div>
          </button>
          <button type="button" class="am-item js-hero-demo-item" data-demo-src="audio/demo-3.m4a">
            <span class="am-item-icon js-di-icon">
              <svg class="ico-play" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7L8 5z"/></svg>
              <svg class="ico-pause" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6 5h4v14H6V5zm8 0h4v14h-4V5z"/></svg>
            </span>
            <div class="am-item-info">
              <strong data-i18n="demo_close">Дожим до продажу</strong>
              <span data-i18n="demo_close_sub">Повернення відкладеного клієнта</span>
            </div>
          </button>
          <button type="button" class="am-item js-hero-demo-item" data-demo-src="audio/demo-holodnyj-dzvonyk.mp3">
            <span class="am-item-icon js-di-icon">
              <svg class="ico-play" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7L8 5z"/></svg>
              <svg class="ico-pause" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6 5h4v14H6V5zm8 0h4v14h-4V5z"/></svg>
            </span>
            <div class="am-item-info">
              <strong data-i18n="demo_real">Реальний холодний</strong>
              <span data-i18n="demo_real_sub">Запис справжнього дзвінка</span>
            </div>
          </button>
        </div>
      </div>
    </div>

    <!-- DEMO CALL MODAL -->
    <div class="modal dcm-modal" id="demo-call-modal" hidden aria-hidden="true">
      <div class="modal-overlay js-close-demo-call-modal"></div>
      <div class="modal-card dcm-card" role="dialog" aria-modal="true" aria-labelledby="dcm-title">
        <button type="button" class="modal-close js-close-demo-call-modal" aria-label="Закрити">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>

        <!-- Form state -->
        <div id="dcm-form-state">
          <div class="dcm-badge">
            <span class="dcm-rec-dot"></span>
            <span data-i18n="dcm_badge">Live Demo</span>
          </div>
          <h2 id="dcm-title" data-i18n="dcm_h2">Відчуйте AI дзвінок прямо зараз</h2>
          <p class="dcm-sub" data-i18n="dcm_p">Залиште номер — AI-агент зателефонує вам протягом 60 секунд.</p>
          <ul class="dcm-features">
            <li><span class="dcm-check"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span><span data-i18n="dcf1">Живий AI-голос, не запис</span></li>
            <li><span class="dcm-check"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span><span data-i18n="dcf2">Відповідає на ваші питання в реальному часі</span></li>
            <li><span class="dcm-check"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></span><span data-i18n="dcf3">Дзвінок протягом 60 секунд</span></li>
          </ul>
          <form id="dcm-form" novalidate>
            <label class="dcm-label" for="dcm-name" data-i18n="label_name">Ім'я</label>
            <input id="dcm-name" class="dcm-input" type="text" name="name" autocomplete="name"
              placeholder="Введіть ваше ім'я" data-i18n-placeholder="placeholder_name" />
            <label class="dcm-label" for="dcm-phone"><span data-i18n="label_phone">Телефон</span> <span class="req">*</span></label>
            <input id="dcm-phone" class="dcm-input" type="tel" name="phone" autocomplete="tel" inputmode="tel"
              placeholder="+380 50 123 45 67" required />
            <div class="dcm-phone-err" id="dcm-phone-err" data-i18n="dcm_phone_err">Введіть коректний номер телефону</div>
            <button type="submit" class="dcm-submit" id="dcm-submit">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
              <span data-i18n="btn_call_me">Зателефонуйте мені</span>
            </button>
            <p class="dcm-feedback" id="dcm-feedback" role="status" aria-live="polite"></p>
          </form>
          <p class="dcm-disclaimer" data-i18n="demo_disclaimer">Демо-дзвінок безкоштовний. Без спаму та нав'язливих продажів.</p>
        </div>

        <!-- Success state -->
        <div class="dcm-success" id="dcm-success" hidden>
          <div class="dcm-success-icon">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.82 8.41 19.79 19.79 0 01.77 3.81 2 2 0 012.73 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l.91-.91a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
          </div>
          <h2 data-i18n="success_h2">AI-агент дзвонить!</h2>
          <p data-i18n="success_p">Очікуйте дзвінок протягом 60 секунд. Підготуйтесь до справжньої демонстрації AI.</p>
          <div class="dcm-countdown">
            <div class="dcm-ring">
              <svg width="80" height="80" viewBox="0 0 36 36">
                <circle cx="18" cy="18" r="15.9" fill="none" stroke="rgba(0,113,227,.12)" stroke-width="2.5"/>
                <circle id="dcm-ring-circle" cx="18" cy="18" r="15.9" fill="none" stroke="#0071e3" stroke-width="2.5"
                  stroke-dasharray="100 100" stroke-linecap="round" transform="rotate(-90 18 18)"/>
              </svg>
              <span class="dcm-ring-num" id="dcm-ring-num">60</span>
            </div>
            <p class="dcm-countdown-label" data-i18n="countdown_label">секунд до дзвінка</p>
          </div>
          <button type="button" class="btn btn-outline js-close-demo-call-modal" style="margin-top:8px" data-i18n="btn_close">Закрити</button>
        </div>
      </div>
    </div>

    <!-- LEAD MODAL -->
    <div class="modal" id="lead-modal" hidden aria-hidden="true">
      <div class="modal-overlay js-close-lead"></div>
      <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="lm-title">
        <button type="button" class="modal-close js-close-lead" aria-label="Закрити">×</button>
        <h2 id="lm-title" data-i18n="form_h2">Залиште контакти</h2>
        <p data-i18n="form_p">Наш менеджер зв'яжеться з вами найближчим часом.</p>
        <form class="lf js-lf" action="send-lead.php" method="post" novalidate>
          <input type="hidden" name="page"           value="index-modal" />
          <input type="hidden" name="selected_voice" class="js-inp-voice" value="" />
          <input type="hidden" name="selected_plan"  class="js-inp-plan"  value="" />
          <?php foreach (['utm_source','utm_medium','utm_term','utm_content','utm_campaign'] as $k): ?>
            <input type="hidden" name="<?= htmlspecialchars($k,ENT_QUOTES,'UTF-8') ?>"
              value="<?= htmlspecialchars((string)($_SESSION['utms'][$k]??''),ENT_QUOTES,'UTF-8') ?>" />
          <?php endforeach; ?>
          <label for="lm-name" data-i18n="label_name">Ім'я</label>
          <input id="lm-name" type="text" name="name" autocomplete="name"
            placeholder="Введіть ваше ім'я" data-i18n-placeholder="placeholder_name" />
          <label for="lm-phone"><span data-i18n="label_phone">Телефон</span> <span class="req">*</span></label>
          <input id="lm-phone" type="tel" name="phone" autocomplete="tel" inputmode="tel" placeholder="+380 50 123 45 67" required />
          <button type="submit" class="btn btn-primary js-lead-submit" data-i18n="btn_send">Надіслати</button>
          <p class="form-fb" role="status" aria-live="polite" hidden></p>
        </form>
      </div>
    </div>

    <!-- CALC MODAL -->
    <div class="modal" id="calc-modal" hidden aria-hidden="true">
      <div class="modal-overlay js-close-calc"></div>
      <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="cm-title">
        <button type="button" class="modal-close js-close-calc" aria-label="Закрити">×</button>
        <h2 id="cm-title" data-i18n="calc_h2">Скільки ви заощадите?</h2>
        <p data-i18n="calc_p">Введіть дані про ваш відділ продажів.</p>
        <div class="calc-form">
          <label for="c-ops" data-i18n="calc_ops">Кількість операторів (1–10)</label>
          <input id="c-ops" type="number" min="1" max="10" value="3" />
          <label for="c-sal" data-i18n="calc_sal">Середня ЗП оператора, грн</label>
          <input id="c-sal" type="number" min="20000" max="100000" step="1000" value="30000" />
          <p class="calc-result"><span data-i18n="calc_save_label">Економія на місяць: </span><strong class="js-calc-out">85&nbsp;500 грн</strong></p>
        </div>
        <button type="button" class="btn btn-primary js-open-demo-call-modal js-close-calc" data-i18n="btn_get_demo">Отримати демо</button>
      </div>
    </div>

    <!-- SCROLL TOP -->
    <button type="button" class="to-top js-to-top" aria-label="Нагору">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 19V5"/><polyline points="6 11 12 5 18 11"/>
      </svg>
    </button>

    <footer class="site-footer">
      <div class="container">
        <p>© <span id="yr"></span> <a href="https://ai-agent.website/">ai-agent.website</a></p>
        <p>ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ</p>
        <p>Назва: "КА аштитипиес" · ЄДРПОУ 46054392</p>
      </div>
    </footer>

    <script>document.getElementById("yr").textContent = new Date().getFullYear();</script>
    <script src="app.js?v=20260823" defer></script>

    <!-- ElevenLabs Conversational AI Widget — вхідна лінія -->
    <script src="includes/open-ai-call.js?v=20261001"></script>
    <?php if (defined('ELEVENLABS_AGENT_ID') && ELEVENLABS_AGENT_ID): ?>
    <elevenlabs-convai agent-id="<?= htmlspecialchars(ELEVENLABS_AGENT_ID, ENT_QUOTES, 'UTF-8') ?>"></elevenlabs-convai>
    <script src="https://unpkg.com/@elevenlabs/convai-widget-embed@0.18.3/dist/index.js" async type="text/javascript"></script>
    <script>
      PulseInbound.bindStartButtons('.js-start-ai-call', false);
    </script>
    <?php else: ?>
    <script>
      PulseInbound.bindStartButtons('.js-start-ai-call', true);
    </script>
    <?php endif; ?>
  </body>
</html>
