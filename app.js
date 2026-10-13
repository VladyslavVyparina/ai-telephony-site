/* ===== ai-agent.website app.js 2026-08 ===== */
"use strict";

/* ──────────── utilities ──────────── */
function $(sel, ctx){return (ctx||document).querySelector(sel)}
function $$(sel, ctx){return [...(ctx||document).querySelectorAll(sel)]}

/* ──────────── scroll lock (for modals) ──────────── */
var _scrollY = 0;
function lockScroll(){
  _scrollY = window.scrollY;
  document.body.style.position   = 'fixed';
  document.body.style.top        = -_scrollY + 'px';
  document.body.style.left       = '0';
  document.body.style.right      = '0';
  document.body.style.overflowY  = 'scroll';
}
function unlockScroll(){
  if(document.body.style.position !== 'fixed') return;
  document.body.style.position   = '';
  document.body.style.top        = '';
  document.body.style.left       = '';
  document.body.style.right      = '';
  document.body.style.overflowY  = '';
  window.scrollTo(0, _scrollY);
}

/* ──────────── lead modal ──────────── */
function openLeadModal(){
  var m = $('#lead-modal');
  if(!m) return;
  m.removeAttribute('hidden');
  m.setAttribute('aria-hidden','false');
  lockScroll();
}
function closeLeadModal(){
  var m = $('#lead-modal');
  if(!m) return;
  m.setAttribute('hidden','');
  m.setAttribute('aria-hidden','true');
  unlockScroll();
}
document.addEventListener('click', function(e){
  if(e.target.closest('.js-open-lead')){
    e.preventDefault();
    syncSelections();
    openDemoCallModal();
  }
});
document.addEventListener('click', function(e){
  if(e.target.closest('.js-close-lead')) closeLeadModal();
});
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape'){
    closeLeadModal();
    closeCalcModal();
    closeDemoMenu();
    closeAudioModal();
    closeDemoCallModal();
    closeDemoSuccessModal();
  }
});
window.addEventListener('pageshow', function(){
  var m = $('#lead-modal');
  if(!m || m.hasAttribute('hidden')) unlockScroll();
});

/* ──────────── calc modal ──────────── */
function openCalcModal(){
  var m = $('#calc-modal');
  if(!m) return;
  m.removeAttribute('hidden');
  m.setAttribute('aria-hidden','false');
  lockScroll();
  renderCalc();
}
function closeCalcModal(){
  var m = $('#calc-modal');
  if(!m) return;
  m.setAttribute('hidden','');
  m.setAttribute('aria-hidden','true');
  unlockScroll();
}
document.addEventListener('click', function(e){
  if(e.target.closest('.js-open-calc') && !e.target.closest('.js-close-lead')){
    e.preventDefault(); openCalcModal();
  }
});
document.addEventListener('click', function(e){
  if(e.target.closest('.js-close-calc')) closeCalcModal();
});
function renderCalc(){
  var ops = parseInt($('#c-ops').value)||3;
  var sal = parseInt($('#c-sal').value)||30000;
  var save = (ops * sal * 0.95).toFixed(0);
  var el = $('.js-calc-out');
  if(el) el.textContent = Number(save).toLocaleString('uk-UA') + ' грн';
}
document.addEventListener('input', function(e){
  if(e.target.id==='c-ops'||e.target.id==='c-sal') renderCalc();
});

/* ──────────── audio samples modal (orb click) ──────────── */
var demoAudio  = null;
var activeItem = null;

function openAudioModal(){
  var m = $('#audio-modal');
  if(!m) return;
  m.removeAttribute('hidden');
  m.setAttribute('aria-hidden','false');
  lockScroll();
}
function closeAudioModal(){
  var m = $('#audio-modal');
  if(!m) return;
  m.setAttribute('hidden','');
  m.setAttribute('aria-hidden','true');
  unlockScroll();
  if(demoAudio){ demoAudio.pause(); }
  if(activeItem){ activeItem.classList.remove('is-playing'); activeItem = null; }
}
function closeDemoMenu(){}  /* legacy no-op */

/* ──────────── demo call modal ──────────── */
var dcmCountdownTimer = null;

function openDemoCallModal(){
  var m = $('#demo-call-modal');
  if(!m) return;
  /* reset to form state */
  var fs = $('#dcm-form-state');
  var ss = $('#dcm-success');
  if(fs) fs.style.display = '';
  if(ss) ss.setAttribute('hidden','');
  var fb = $('#dcm-feedback');
  if(fb){ fb.textContent = ''; fb.className = 'dcm-feedback'; }
  var phoneInp = $('#dcm-phone');
  var nameInp  = $('#dcm-name');
  if(phoneInp){ phoneInp.value=''; phoneInp.classList.remove('is-error'); }
  if(nameInp)  nameInp.value = '';
  var err = $('#dcm-phone-err');
  if(err) err.classList.remove('show');
  if(dcmCountdownTimer){ clearInterval(dcmCountdownTimer); dcmCountdownTimer=null; }
  m.removeAttribute('hidden');
  m.setAttribute('aria-hidden','false');
  lockScroll();
}
function closeDemoCallModal(){
  var m = $('#demo-call-modal');
  if(!m) return;
  m.setAttribute('hidden','');
  m.setAttribute('aria-hidden','true');
  unlockScroll();
  if(dcmCountdownTimer){ clearInterval(dcmCountdownTimer); dcmCountdownTimer=null; }
}
function startDcmCountdown(){
  var num  = $('#dcm-ring-num');
  var ring = $('#dcm-ring-circle');
  var secs = 60;
  if(num) num.textContent = secs;
  dcmCountdownTimer = setInterval(function(){
    secs--;
    if(num) num.textContent = secs <= 0 ? '✓' : secs;
    if(ring) ring.style.strokeDasharray = ((Math.max(secs,0)/60)*100) + ' 100';
    if(secs <= 0) clearInterval(dcmCountdownTimer);
  }, 1000);
}

document.addEventListener('click', function(e){
  if(e.target.closest('.js-open-demo-call-modal')){
    e.preventDefault();
    openDemoCallModal();
  }
});
document.addEventListener('click', function(e){
  if(e.target.closest('.js-close-demo-call-modal')){
    closeDemoCallModal();
  }
});

/* Demo call form submission */
function demoCallErrorMessage(r){
  var isEn = document.documentElement.dataset.lang === 'en';
  if(!r) return isEn ? 'Error. Please try again.' : 'Помилка. Спробуйте ще раз.';
  if(r.error === 'rate_limit'){
    return isEn
      ? 'Demo call already requested. Please wait 30 minutes.'
      : 'Демо-дзвінок вже замовлено. Очікуйте або повторіть через 30 хвилин.';
  }
  if(r.error === 'invalid_phone'){
    return isEn
      ? 'Invalid phone format (+380XXXXXXXXX).'
      : 'Некоректний формат (+380XXXXXXXXX).';
  }
  if(r.error === 'crm_not_configured' || r.error === 'crm_unreachable' || r.error === 'crm_error'){
    return isEn
      ? 'Demo calls are temporarily unavailable. Please try again later.'
      : 'Демо-дзвінки тимчасово недоступні. Спробуйте пізніше.';
  }
  if(r.message && !/secrets\.php|CRM API|includes\//i.test(r.message)){
    return r.message;
  }
  return isEn ? 'Error. Please try again.' : 'Помилка. Спробуйте ще раз.';
}

document.addEventListener('submit', function(e){
  if(e.target.id !== 'dcm-form') return;
  e.preventDefault();
  var phoneInp = $('#dcm-phone');
  var nameInp  = $('#dcm-name');
  var submitBtn= $('#dcm-submit');
  var feedback = $('#dcm-feedback');
  var phoneErr = $('#dcm-phone-err');
  if(!phoneInp) return;
  var phone = phoneInp.value.trim();
  var name  = nameInp ? nameInp.value.trim() : '';
  if(!phone || phone.replace(/\D/g,'').length < 10){
    phoneInp.classList.add('is-error');
    if(phoneErr) phoneErr.classList.add('show');
    phoneInp.focus();
    return;
  }
  /* normalise */
  phone = normalizePhone(phone);

  submitBtn.disabled = true;
  submitBtn.classList.add('is-loading');
  if(feedback){ feedback.textContent=''; feedback.className='dcm-feedback'; }

  fetch('demo-call.php',{
    method:'POST',
    headers:{'Content-Type':'application/json','Accept':'application/json'},
    body:JSON.stringify({phone:phone, name:name})
  })
  .then(function(r){return r.json()})
  .then(function(r){
    submitBtn.disabled=false;
    submitBtn.classList.remove('is-loading');
    if(r.ok){
      var fs=$('#dcm-form-state');
      var ss=$('#dcm-success');
      if(fs) fs.style.display='none';
      if(ss){ ss.removeAttribute('hidden'); }
      startDcmCountdown();
    } else {
      var msg = demoCallErrorMessage(r);
      if(feedback){ feedback.textContent=msg; feedback.className='dcm-feedback error'; }
    }
  })
  .catch(function(){
    submitBtn.disabled=false;
    submitBtn.classList.remove('is-loading');
    var msg = document.documentElement.dataset.lang==='en'
      ? 'Network error. Check your connection.' : 'Мережева помилка. Перевірте з\'єднання.';
    if(feedback){ feedback.textContent=msg; feedback.className='dcm-feedback error'; }
  });
});

document.addEventListener('click', function(e){
  if(e.target.closest('.js-open-audio-modal')){
    e.preventDefault();
    openAudioModal();
  }
});
document.addEventListener('click', function(e){
  if(e.target.closest('.js-close-audio-modal')){
    closeAudioModal();
  }
});

document.addEventListener('click', function(e){
  var item = e.target.closest('.js-hero-demo-item');
  if(!item) return;
  var src = item.dataset.demoSrc;
  if(!src) return;
  if(!demoAudio){
    demoAudio = $('#hero-demo-audio');
    if(!demoAudio) return;
  }
  if(activeItem && activeItem !== item){
    activeItem.classList.remove('is-playing');
    demoAudio.pause();
  }
  if(item.classList.contains('is-playing')){
    demoAudio.pause();
    item.classList.remove('is-playing');
    activeItem = null;
  } else {
    demoAudio.src = src;
    demoAudio.play().catch(function(){});
    item.classList.add('is-playing');
    activeItem = item;
  }
});

if($('#hero-demo-audio')){
  $('#hero-demo-audio').addEventListener('ended', function(){
    if(activeItem) activeItem.classList.remove('is-playing');
    activeItem = null;
  });
}

/* ──────────── capabilities accordion ──────────── */
document.addEventListener('click', function(e){
  var head = e.target.closest('.js-cap-feat');
  if(!head) return;
  var item = head.closest('.cap-feat');
  if(!item) return;
  var isOpen = item.classList.contains('is-open');
  $$('.cap-feat').forEach(function(f){f.classList.remove('is-open')});
  if(!isOpen) item.classList.add('is-open');
});

/* ──────────── compare ──────────── */
var compareData = {
  ai: {
    title_uk:'AI-агент (Бот)',
    title_en:'AI Agent (Bot)',
    list_uk:[
      '24/7/365. Завжди на зв\'язку',
      'Стабільність. Якість незалежна від настрою',
      'Безліміт. Обробляє 1000 діалогів одночасно',
      'Безсмертний. Всі знання залишаються в системі'
    ],
    list_en:[
      '24/7/365. Always available',
      'Consistency. Quality independent of mood',
      'Unlimited. Handles 1000 conversations simultaneously',
      'Knowledge stays in the system forever'
    ]
  },
  human: {
    title_uk:'Менеджер (Людина)',
    title_en:'Sales Manager (Human)',
    list_uk:[
      'Мотивується настроєм і зарплатою',
      'Максимум 3–5 паралельних діалогів',
      'Потребує навчання і контролю',
      'При звільненні — втрата знань'
    ],
    list_en:[
      'Motivated by mood and salary',
      'Max 3–5 parallel conversations',
      'Requires training and supervision',
      'Knowledge lost when they leave'
    ]
  }
};
var currentCmpKey = 'ai';

function renderCompare(key){
  currentCmpKey = key;
  var lang = document.documentElement.dataset.lang || 'uk';
  var data = compareData[key];
  if(!data) return;
  var detail = $('#cmp-detail');
  if(!detail) return;
  var title = detail.querySelector('.js-cmp-title');
  var list  = detail.querySelector('.js-cmp-list');
  if(title) title.textContent = data['title_' + lang] || data.title_uk;
  if(list){
    var items = data['list_' + lang] || data.list_uk;
    list.innerHTML = items.map(function(t){ return '<li>' + t + '</li>'; }).join('');
  }
  $$('.cmp-card').forEach(function(c){
    var isActive = c.dataset.cmp === key;
    c.classList.toggle('is-active', isActive);
    c.setAttribute('aria-pressed', isActive ? 'true' : 'false');
  });
}

document.addEventListener('click', function(e){
  var card = e.target.closest('.cmp-card');
  if(card && card.dataset.cmp) renderCompare(card.dataset.cmp);
});

/* ──────────── pain carousel ──────────── */
var painSlides = $$('.pain-slide');
var painDots   = $$('.pain-dot');
var painIdx    = 0;
var painTimer;

function showPain(idx){
  painSlides.forEach(function(s,i){s.classList.toggle('is-active',i===idx)});
  painDots.forEach(function(d,i){d.classList.toggle('is-active',i===idx)});
  painIdx = idx;
}
function startPain(){
  clearInterval(painTimer);
  painTimer = setInterval(function(){
    showPain((painIdx+1) % painSlides.length);
  }, 3500);
}
if(painSlides.length) startPain();

document.addEventListener('click', function(e){
  var dot = e.target.closest('.pain-dot');
  if(!dot) return;
  var idx = painDots.indexOf(dot);
  if(idx !== -1){showPain(idx);startPain();}
});

document.addEventListener('click', function(e){
  if(e.target.closest('.js-pain-prev')){
    showPain((painIdx - 1 + painSlides.length) % painSlides.length);
    startPain();
  }
  if(e.target.closest('.js-pain-next')){
    showPain((painIdx + 1) % painSlides.length);
    startPain();
  }
});

/* ──────────── plans accordion ──────────── */
document.addEventListener('click', function(e){
  var head = e.target.closest('.js-plan-head');
  if(!head) return;
  var item = head.closest('.plan-item');
  if(!item) return;
  var isOpen = item.classList.contains('is-open');
  $$('.plan-item').forEach(function(p){p.classList.remove('is-open')});
  if(!isOpen) item.classList.add('is-open');
});

/* plan selection */
var selectedPlan = '';
document.addEventListener('click', function(e){
  var btn = e.target.closest('[data-plan]');
  if(btn && btn.dataset.plan) selectedPlan = btn.dataset.plan;
});

/* ──────────── steps progress ──────────── */
var stepsData_uk = [
  {title:'1. Аналізуємо ваш бізнес', body:'Вивчаємо, як приходять клієнти і де втрачаються заявки.'},
  {title:'2. Пишемо сценарії', body:'Розробляємо скрипти під ваш продукт і ЦА.'},
  {title:'3. Інтегруємо з CRM', body:'Підключаємо AI до вашої CRM або телефонії.'},
  {title:'4. Навчаємо AI', body:'Тонке налаштування під ваш тон і заперечення клієнтів.'},
  {title:'5. Запуск і перші угоди', body:'Перші реальні результати вже за 1–2 тижні.'}
];
var stepsData_en = [
  {title:'1. Analyze your business', body:'We study how clients arrive and where leads are lost.'},
  {title:'2. Write call scripts', body:'We develop scripts for your product and target audience.'},
  {title:'3. Integrate with CRM', body:'We connect AI to your CRM or telephony system.'},
  {title:'4. Train the AI', body:'Fine-tuning for your tone and client objections.'},
  {title:'5. Launch & first deals', body:'First real results within 1–2 weeks.'}
];
var stepIdx = 0;

function getStepsData(){
  var lang = document.documentElement.dataset.lang || 'uk';
  return lang === 'en' ? stepsData_en : stepsData_uk;
}

function setStep(idx){
  stepIdx = idx;
  var stepsData = getStepsData();
  var fill = $('.js-steps-fill');
  if(fill) fill.style.width = (idx / (stepsData.length-1) * 100) + '%';
  $$('.step-li').forEach(function(li,i){li.classList.toggle('is-active',i===idx)});
  var det = $('.js-step-detail');
  if(det){
    det.querySelector('h3').textContent = stepsData[idx].title;
    det.querySelector('p').textContent  = stepsData[idx].body;
  }
}
document.addEventListener('click', function(e){
  var li = e.target.closest('.step-li');
  if(!li) return;
  setStep(parseInt(li.dataset.step)||0);
});

/* scroll-driven steps progress */
(function(){
  var track = $('.steps-track');
  if(!track) return;
  function onScroll(){
    var rect = track.getBoundingClientRect();
    var vh = window.innerHeight;
    if(rect.top > vh || rect.bottom < 0) return;
    var ratio = 1 - (rect.top / vh);
    ratio = Math.max(0, Math.min(1, ratio));
    var stepsData = getStepsData();
    var idx = Math.round(ratio * (stepsData.length-1));
    if(idx !== stepIdx) setStep(idx);
  }
  window.addEventListener('scroll', onScroll, {passive:true});
  onScroll();
})();

/* ──────────── voices ──────────── */
var voiceData = {
  anna:{
    name_uk:'Поліна',name_en:'Polina',
    text_uk:'Реанімувала мертву базу за 7 днів. AI за першу тиждень повернув 5 реальних угод із бази, яку вважали втраченою. +5 угод зі старої бази.',
    text_en:'Revived a dead database in 7 days. The AI returned 5 real deals in the first week from a base thought to be lost. +5 deals from old contacts.',
    audio:'audio/demo-1.m4a'
  },
  maksym:{
    name_uk:'Мія',name_en:'Mia',
    text_uk:'Дожала відкладені угоди. Мія повернула клієнтів, які «думали» — конверсія у підтвердження +28% за 2 тижні.',
    text_en:'Closed postponed deals. Mia brought back clients who were "thinking" — confirmation conversion +28% in 2 weeks.',
    audio:'audio/demo-2.m4a'
  },
  olena:{
    name_uk:'Софія',name_en:'Sofia',
    text_uk:'Збільшила повторні продажі на 41%. Софія самостійно інформувала базу про нові послуги і закривала угоди.',
    text_en:'Increased repeat sales by 41%. Sofia independently informed the base about new services and closed deals.',
    audio:'audio/demo-3.m4a'
  }
};
var selectedVoice = 'anna';
var voiceAudioEl = null;
var voiceAudioPlaying = false;

function renderVoice(key){
  selectedVoice = key;
  var lang = document.documentElement.dataset.lang || 'uk';
  var data = voiceData[key];
  if(!data) return;
  var nameEl = $('.js-voice-name');
  var textEl = $('.js-voice-text');
  var btnEl  = $('.js-select-voice');
  var playBtn = $('.js-voice-play');
  if(nameEl) nameEl.textContent = data['name_' + lang] || data.name_uk;
  if(textEl) textEl.textContent = data['text_' + lang] || data.text_uk;
  if(btnEl)  btnEl.dataset.voice = key;
  if(playBtn) playBtn.dataset.audio = data.audio;
  $$('.voice-tab').forEach(function(t){
    t.classList.toggle('is-active', t.dataset.voice===key);
  });
  stopVoiceAudio();
}

function stopVoiceAudio(){
  if(voiceAudioEl){
    voiceAudioEl.pause();
    voiceAudioEl.currentTime = 0;
  }
  var btn = $('.js-voice-play');
  var wf  = $('.js-voice-waveform');
  var lbl = $('.js-vp-label');
  if(btn){btn.classList.remove('is-playing')}
  if(wf) {wf.classList.remove('is-animating')}
  if(lbl){lbl.dataset.i18n && applyTranslation(lbl, lbl.dataset.i18n)}
  voiceAudioPlaying = false;
}

document.addEventListener('click', function(e){
  var tab = e.target.closest('.voice-tab');
  if(tab && tab.dataset.voice) renderVoice(tab.dataset.voice);
});

document.addEventListener('click', function(e){
  var btn = e.target.closest('.js-voice-play');
  if(!btn) return;
  if(!voiceAudioEl) voiceAudioEl = $('#voice-audio');
  if(!voiceAudioEl) return;
  var wf  = $('.js-voice-waveform');
  var lbl = $('.js-vp-label');
  if(voiceAudioPlaying){
    voiceAudioEl.pause();
    btn.classList.remove('is-playing');
    if(wf) wf.classList.remove('is-animating');
    if(lbl) lbl.textContent = (document.documentElement.dataset.lang==='en') ? 'Listen sample' : 'Прослухати зразок';
    voiceAudioPlaying = false;
  } else {
    var src = btn.dataset.audio;
    if(src) voiceAudioEl.src = src;
    voiceAudioEl.play().catch(function(){});
    btn.classList.add('is-playing');
    if(wf) wf.classList.add('is-animating');
    if(lbl) lbl.textContent = (document.documentElement.dataset.lang==='en') ? 'Stop' : 'Зупинити';
    voiceAudioPlaying = true;
  }
});

if($('#voice-audio')){
  $('#voice-audio').addEventListener('ended', function(){
    stopVoiceAudio();
  });
}

document.addEventListener('click', function(e){
  var btn = e.target.closest('.js-select-voice');
  if(btn){
    selectedVoice = btn.dataset.voice || selectedVoice;
    syncSelections();
    openDemoCallModal();
  }
});

/* ──────────── sync selections → hidden inputs ──────────── */
function syncSelections(){
  $$('.js-inp-voice').forEach(function(i){i.value=selectedVoice});
  $$('.js-inp-plan').forEach(function(i){i.value=selectedPlan});
}

/* ──────────── form submission ──────────── */
function validatePhone(val){
  var digits = val.replace(/\D/g,'');
  return digits.length >= 10;
}
function normalizePhone(val){
  var d = val.replace(/\D/g,'');
  if(d.startsWith('38') && d.length===12) return '+' + d;
  if(d.startsWith('8')  && d.length===11) return '+3' + d;
  if(d.length===10) return '+38' + d;
  return '+' + d;
}

function initForm(form){
  var phoneInp = form.querySelector('input[type=tel]');
  var errMsg   = document.createElement('p');
  errMsg.className = 'form-error-msg';
  errMsg.textContent = 'Введіть коректний номер телефону';
  if(phoneInp) phoneInp.after(errMsg);

  if(phoneInp){
    phoneInp.addEventListener('input', function(){
      this.value = this.value.replace(/[^0-9+\-\s()]/g,'');
      this.classList.remove('is-error');
      errMsg.classList.remove('visible');
    });
  }

  form.addEventListener('submit', function(e){
    e.preventDefault();
    syncSelections();
    if(phoneInp && !validatePhone(phoneInp.value)){
      phoneInp.classList.add('is-error');
      errMsg.classList.add('visible');
      phoneInp.focus();
      return;
    }
    if(phoneInp) phoneInp.value = normalizePhone(phoneInp.value);

    var fb  = form.querySelector('.form-fb');
    var btn = form.querySelector('[type=submit]');
    var isUk = (document.documentElement.dataset.lang || 'uk') !== 'en';
    if(btn){btn.disabled=true;btn.textContent=isUk?'Надсилаємо…':'Sending…'}

    var data = new FormData(form);
    fetch(form.action, {method:'POST',body:data,headers:{'Accept':'application/json'}})
      .then(function(r){return r.json()})
      .then(function(r){
        if(r.ok){
          if(typeof fbq === 'function') fbq('track','Lead');
          if(typeof gtag === 'function') gtag('event','conversion',{send_to:'AW-10800835497/LEAD'});
          window.location.href = 'lead.php?thanks=1&lead=1';
        } else {
          if(fb){fb.textContent=r.error||'Помилка. Спробуйте ще.';fb.removeAttribute('hidden')}
          if(btn){btn.disabled=false;btn.textContent=isUk?'Надіслати':'Send'}
        }
      })
      .catch(function(){
        if(fb){fb.textContent=isUk?'Мережева помилка. Спробуйте ще раз.':'Network error. Please try again.';fb.removeAttribute('hidden')}
        if(btn){btn.disabled=false;btn.textContent=isUk?'Надіслати':'Send'}
      });
  });
}

$$('.js-lf').forEach(initForm);

/* ──────────── demo call form ──────────── */
var countdownTimer = null;

function openDemoSuccessModal(){
  var m = $('#demo-success-modal');
  if(!m) return;
  m.removeAttribute('hidden');
  m.setAttribute('aria-hidden','false');
  lockScroll();
  startCountdown();
}

function closeDemoSuccessModal(){
  var m = $('#demo-success-modal');
  if(!m) return;
  m.setAttribute('hidden','');
  m.setAttribute('aria-hidden','true');
  unlockScroll();
  if(countdownTimer) clearInterval(countdownTimer);
}

document.addEventListener('click', function(e){
  if(e.target.closest('.js-close-demo-success')) closeDemoSuccessModal();
});

function startCountdown(){
  var numEl  = $('.js-countdown-num');
  var ringEl = $('.js-countdown-ring');
  if(!numEl) return;
  var secs = 60;
  numEl.textContent = secs;
  if(ringEl) ringEl.style.strokeDasharray = '100 100';
  if(countdownTimer) clearInterval(countdownTimer);
  countdownTimer = setInterval(function(){
    secs--;
    numEl.textContent = secs;
    if(ringEl){
      var pct = (secs / 60) * 100;
      ringEl.style.strokeDasharray = pct + ' 100';
    }
    if(secs <= 0){
      clearInterval(countdownTimer);
      numEl.textContent = '✓';
    }
  }, 1000);
}

(function(){
  var form = $('#demo-call-form');
  if(!form) return;

  var phoneInp = form.querySelector('input[type=tel]');
  var errMsg   = document.createElement('p');
  errMsg.className = 'form-error-msg';
  errMsg.textContent = 'Введіть коректний номер телефону';
  if(phoneInp) phoneInp.insertAdjacentElement('afterend', errMsg);

  if(phoneInp){
    phoneInp.addEventListener('input', function(){
      this.value = this.value.replace(/[^0-9+\-\s()]/g,'');
      this.classList.remove('is-error');
      errMsg.classList.remove('visible');
    });
  }

  form.addEventListener('submit', function(e){
    e.preventDefault();
    var isUk = (document.documentElement.dataset.lang || 'uk') !== 'en';
    if(phoneInp && !validatePhone(phoneInp.value)){
      phoneInp.classList.add('is-error');
      errMsg.classList.add('visible');
      phoneInp.focus();
      return;
    }
    var phone = phoneInp ? normalizePhone(phoneInp.value) : '';
    var name  = (form.querySelector('input[name=name]') || {}).value || '';
    var btn   = form.querySelector('.js-demo-call-submit');
    var fb    = form.querySelector('.form-fb');
    if(btn){btn.disabled=true;btn.classList.add('is-loading')}
    if(fb){fb.setAttribute('hidden','');fb.textContent=''}

    fetch('demo-call.php', {
      method:'POST',
      headers:{'Content-Type':'application/json','Accept':'application/json'},
      body:JSON.stringify({phone:phone,name:name})
    })
    .then(function(r){return r.json()})
    .then(function(r){
      if(btn){btn.disabled=false;btn.classList.remove('is-loading')}
      if(r.ok){
        form.reset();
        closeDemoMenu();
        openDemoSuccessModal();
      } else {
        var msg = demoCallErrorMessage(r);
        if(fb){fb.textContent=msg;fb.removeAttribute('hidden')}
      }
    })
    .catch(function(){
      if(btn){btn.disabled=false;btn.classList.remove('is-loading')}
      if(fb){
        fb.textContent = isUk ? 'Мережева помилка. Спробуйте ще раз.' : 'Network error. Please try again.';
        fb.removeAttribute('hidden');
      }
    });
  });
})();

/* ──────────── scroll to top ──────────── */
var toTopBtn = $('.js-to-top');
if(toTopBtn){
  toTopBtn.addEventListener('click', function(){window.scrollTo({top:0,behavior:'smooth'})});
  window.addEventListener('scroll', function(){
    toTopBtn.classList.toggle('is-visible', window.scrollY > 400);
  }, {passive:true});
}

/* ──────────── scroll-reveal (IntersectionObserver) ──────────── */
(function(){
  var elements = $$('.reveal-up, .reveal-left, .reveal-right');
  if(!elements.length) return;
  if(!window.IntersectionObserver){
    elements.forEach(function(el){el.classList.add('is-revealed')});
    return;
  }
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        entry.target.classList.add('is-revealed');
        io.unobserve(entry.target);
      }
    });
  }, {rootMargin:'0px 0px -60px 0px', threshold:.08});
  elements.forEach(function(el){io.observe(el)});
})();

/* ──────────── language switcher ──────────── */
var translations = {
  uk: {
    nav_capabilities:'Що вміє',
    nav_compare:'AI vs Менеджер',
    nav_plans:'Пакети',
    nav_steps:'Запуск',
    nav_cases:'Результати',
    nav_voices:'Голоси',
    nav_ai_demo:'🤖 Демо',
    btn_get_demo:'Отримати демо',
    btn_calc:'Розрахувати результат',
    hero_h1_accent:'AI-менеджер',
    hero_h1_rest:', який дзвонить, відповідає на заявки і доводить клієнтів до угоди',
    hero_sub:'Замініть відділ продажів або посильте його — без найму, навчання та людського фактора.',
    hero_price:'Підключення — 40\u00a0000\u00a0грн\u00a0\u00a0·\u00a0\u00a0Ведення — від $100/міс',
    demo_examples:'Приклади дзвінків',
    demo_cold:'Холодний дзвінок',
    demo_confirm:'Підтвердження заявки',
    demo_close:'Дожим до продажу',
    demo_real:'Реальний холодний',
    cap_h2_pre:'Що вміє наш ',
    cap_h2_accent:'AI-менеджер',
    cap_intro:'Подивіться AI-менеджера в дії: як він обробляє заявки і записує клієнтів 24/7',
    cap_speed_pre:'Відповідає за ',
    cap_speed_accent:'2 секунди',
    cap_speed_body:'Не пропускає гарячі заявки, стартує діалог миттєво і веде до запису.',
    cap_close:'Закриває до запису',
    cap_close_body:'Уточнює деталі, пропонує зручний час і фіксує бронювання в CRM.',
    cap_nonstop_pre:'Працює ',
    cap_nonstop_accent:'24/7 без втоми',
    cap_nonstop_body:'Стабільна якість у будь-який час — без хвороб, вигорання і людського фактора.',
    cap_crm:'Знаходиться в CRM',
    cap_crm_body:'Інтегрується з вашою системою, економить час і веде порядок у заявках.',
    cap_vid_label:'Demo AI-менеджера в роботі',
    cmp_h2_pre:'AI-agent vs ',
    cmp_h2_accent:'Менеджер',
    cmp_intro:'Натисніть на персонажа — побачите переваги чи недоліки.',
    cmp_ai_title:'AI-агент',
    cmp_ai_sub:'(Бот)',
    cmp_human_title:'Менеджер',
    cmp_human_sub:'(Людина)',
    btn_get_ai:'Отримати AI',
    pain_h2_pre:'Ви вже ',
    pain_h2_accent:'втрачаєте гроші',
    pain_h2_post:'. Кожний день.',
    pain_intro:'Не через рекламу. Не через ринок. А через дірки в процесах, які коштують вам клієнтів і виручки.',
    pain_note:'Схоже, у вас є ці проблеми — гроші йдуть до конкурентів.',
    pain_solution:'AI-менеджер закриє всі втрати.',
    pain_solution_sub:'Перехопить заявки і примножить гроші.',
    btn_demo_ai:'Отримати демо AI-менеджера',
    pain1_title:'Пропущені дзвінки',
    pain1_text:'Клієнт не чекає: він іде до конкурента.',
    pain1_stat:'+15% грошей втрачається щодня',
    pain2_title:'Повільний зворотній зв\'язок',
    pain2_text:'Відповідь через 15 хвилин вже надто пізно.',
    pain2_stat:'До 50% заявок залишаються без відповіді',
    pain3_title:'Неактивна база',
    pain3_text:'Контакти є, а продажів із бази немає.',
    pain3_stat:'Тисячі сплячих клієнтів у базі',
    plans_h2_pre:'Стартовий пакет ',
    plans_h2_accent:'AI-менеджера',
    plans_intro:'Миттєво відповідає і забирає «гарячих» клієнтів',
    plan1_head:'AI відповідає за секунди',
    plan1_li1:'без очікування',
    plan1_li2:'без виправдань',
    plan1_li3:'одразу веде діалог і записи',
    plan2_head:'Доводить клієнта до запису, а не «передає далі»',
    plan2_li1:'уточнює зручний час',
    plan2_li2:'узгоджує деталі',
    plan2_li3:'записує клієнта в CRM',
    plan3_head:'Працює 24/7 без втоми',
    plan3_li1:'не помиляється і завжди на зв\'язку',
    plan3_li2:'відповідає вночі та у вихідні',
    plan_price_label:'Впровадження ',
    plan_price_sub:'Окупається за рахунок миттєвих продажів вже за 1–2 тижні',
    btn_choose_plan:'Вибрати план',
    plan_ext_h3_pre:'Розширена версія: ',
    plan_ext_h3_accent:'пам\'ять + аналітика',
    plan_ext1_h4:'Запам\'ятовує клієнтів і веде діалог на дистанції',
    plan_ext1_p:'Кожен дзвінок транскрибується. AI пам\'ятає все і продовжує з того ж місця навіть через місяці.',
    plan_ext2_h4:'Продає по-різному, а не за шаблоном',
    plan_ext2_p:'Аналізує профіль клієнта і підбирає підхід: комусь частіше, комусь — дорожчу послугу.',
    plan_ext3_h4:'Сам повертає клієнтів',
    plan_ext3_p:'Відстежує дату останнього візиту та ініціює контакт — як живий менеджер, але масштабовано.',
    plan_ext4_h4:'Масштабується на мережу без втрати якості',
    plan_ext4_p:'Єдиний стандарт на всіх точках. Без хаосу при зростанні.',
    plan_ext_price_label:'Ціна ',
    steps_h2_pre:'Запуск за ',
    steps_h2_accent:'5 кроків',
    steps_intro:'Прозорий процес від першої зустрічі до перших угод.',
    step1:'Аналіз',step2:'Сценарії',step3:'CRM',step4:'Навчання',step5:'Запуск',
    steps_outro:'Вам не потрібно розбиратися — ми робимо все під ключ.',
    cases_h2_pre:'AI в продажах — це ',
    cases_h2_accent:'вимірюваний результат',
    cases_h2_post:', а не гіпотеза',
    cases_intro:'Ми впроваджуємо AI-агентів у відділи продажів і фіксуємо зростання ключових метрик вже в перші тижні.',
    cases_sub:'Результати клієнтів',
    cases_niches:'Підтверджені кейси в нішах: нерухомість, інфобізнес, послуги.',
    case1_stat:'+37% повторних продаж',
    case1_niche:'Нерухомість',
    case1_text:'AI-агент активував базу з 4\u00a0000 неактуалізованих контактів.\n— 2\u00a0800 вихідних комунікацій за 7 днів\n— Повторно залучено понад 600 клієнтів\n— 14 додаткових угод без розширення команди',
    case2_stat:'×2 зростання конверсії',
    case2_niche:'Інфобізнес',
    case2_text:'AI обробляє вхідні заявки замість менеджерів.\n— Відповідь клієнту до 5 секунд\n— Конверсія: 18% → 36%',
    case_what:'Що це дає бізнесу',
    case2_li1:'Швидке повернення «сплячих» клієнтів',
    case2_li2:'Збільшення конверсії без зростання трафіку',
    case2_li3:'Зниження навантаження на команду',
    case2_li4:'Прогнозований зріст виручки',
    case3_stat:'−60% витрат на відділ продажів',
    case3_niche:'Послуги',
    case3_text:'AI замінив частину функцій менеджерів без втрати виручки.\n— Скорочення команди з 3 до 1 спеціаліста\n— Збереження обсягу продажів\n— Зниження розходів на 60%',
    case_cta_q:'Готові впровадити AI у ваш відділ продажів?',
    btn_audit:'Отримати аудит',
    btn_book_demo:'Записатись на демонстрацію',
    voices_h2_pre:'Виберіть ',
    voices_h2_accent:'AI-менеджера',
    voices_h2_post:' під ваш бізнес',
    voices_intro:'Різні голоси і стилі спілкування — під різні задачі.',
    voice_anna:'Поліна',voice_anna_badge:'Реанімація бази',
    voice_maksym:'Мія',voice_maksym_badge:'Дожим угод',
    voice_olena:'Софія',voice_olena_badge:'Повторні продажі',
    voice_listen:'Прослухати зразок',
    btn_select_voice:'Вибрати персонажа і замовити демо-дзвінок',
    btn_test_call:'Тестовий AI дзвінок',
    dcm_badge:'Live Demo',
    dcm_h2:'Відчуйте AI дзвінок прямо зараз',
    dcm_p:'Залиште номер — AI-агент зателефонує вам протягом 60 секунд.',
    dcm_phone_err:'Введіть коректний номер телефону',
    demo_modal_title:'Приклади дзвінків AI',
    demo_modal_sub:'Натисніть, щоб прослухати реальні демо',
    demo_cold_sub:'Вихідний дзвінок по холодній базі',
    demo_confirm_sub:'Обробка вхідного ліда',
    demo_close_sub:'Повернення відкладеного клієнта',
    demo_real_sub:'Запис справжнього дзвінка',
    demo_call_badge:'🤖 Live Demo',
    demo_call_h2_pre:'Відчуйте як ',
    demo_call_h2_accent:'AI дзвонить вам',
    demo_call_h2_post:' прямо зараз',
    demo_call_p:'Залиште свій номер — і AI-агент зателефонує вам протягом 60 секунд. Це справжній дзвінок, не запис.',
    dcf1:'Живий AI-голос, не запис',
    dcf2:'Відповідає на ваші питання в реальному часі',
    dcf3:'Дзвінок протягом 60 секунд',
    demo_call_form_h3:'Отримати демо-дзвінок',
    demo_call_form_p:'AI-агент зателефонує вам і проведе повноцінну демонстрацію.',
    label_name:'Ім\'я',
    label_phone:'Телефон',
    placeholder_name:'Введіть ваше ім\'я',
    placeholder_phone:'+380 50 123 45 67',
    btn_call_me:'Зателефонуйте мені',
    demo_disclaimer:'Демо-дзвінок безкоштовний. Без спаму та нав\'язливих продажів.',
    form_h2:'Замовте демо-дзвінок',
    form_p:'AI-агент зателефонує вам протягом 60 секунд — справжній дзвінок, не запис.',
    btn_send:'Надіслати',
    btn_close:'Закрити',
    calc_h2:'Скільки ви заощадите?',
    calc_p:'Введіть дані про ваш відділ продажів.',
    calc_ops:'Кількість операторів (1–10)',
    calc_sal:'Середня ЗП оператора, грн',
    calc_save_label:'Економія на місяць: ',
    success_h2:'AI-агент дзвонить!',
    success_p:'Очікуйте дзвінок протягом 60 секунд. Підготуйтесь до справжньої демонстрації AI.',
    countdown_label:'секунд до дзвінка',
    demo_h2_new:'Спробуйте AI-менеджера прямо зараз',
    demo_sub_new:'Оберіть зручний спосіб познайомитись з нашим AI',
    demo_instant:'Миттєво',
    demo_60sec:'60 секунд',
    demo_call_title:'Поговорити з AI зараз',
    demo_call_desc:'Натисніть кнопку — AI-агент відповість прямо в браузері. Потрібен мікрофон.',
    demo_callback_title:'AI зателефонує вам',
    demo_callback_desc:'Залиште номер — AI-агент зателефонує на ваш телефон протягом хвилини.',
    demo_f1:'Без реєстрації',
    demo_f2:'Без очікування',
    demo_f3:'Живий діалог',
    demo_f4:'Справжній дзвінок',
    demo_f5:'На ваш номер',
    demo_f6:'Безкоштовно',
    btn_talk_now:'Почати розмову'
  },
  en: {
    nav_capabilities:'Features',
    nav_compare:'AI vs Manager',
    nav_plans:'Pricing',
    nav_steps:'Launch',
    nav_cases:'Results',
    nav_voices:'Voices',
    nav_ai_demo:'🤖 Demo',
    btn_get_demo:'Get a Demo',
    btn_calc:'Calculate ROI',
    hero_h1_accent:'AI Sales Manager',
    hero_h1_rest:' that calls, handles leads and closes deals',
    hero_sub:'Replace or supercharge your sales team — no hiring, training or human factor.',
    hero_price:'Setup — ₴40\u00a0000\u00a0\u00a0·\u00a0\u00a0Monthly — from $100/mo',
    demo_examples:'Sample Calls',
    demo_cold:'Cold Call',
    demo_confirm:'Lead Confirmation',
    demo_close:'Deal Closing',
    demo_real:'Real Cold Call',
    cap_h2_pre:'What our ',
    cap_h2_accent:'AI Manager can do',
    cap_intro:'See the AI manager in action: handling leads and booking clients 24/7',
    cap_speed_pre:'Responds in ',
    cap_speed_accent:'2 seconds',
    cap_speed_body:'Never misses a hot lead, starts the conversation instantly and guides to booking.',
    cap_close:'Closes to appointment',
    cap_close_body:'Clarifies details, proposes a convenient time and records the booking in CRM.',
    cap_nonstop_pre:'Works ',
    cap_nonstop_accent:'24/7 without fatigue',
    cap_nonstop_body:'Consistent quality at any time — no sick days, burnout or human factor.',
    cap_crm:'Lives in your CRM',
    cap_crm_body:'Integrates with your system, saves time and keeps leads organised.',
    cap_vid_label:'AI Manager Demo',
    cmp_h2_pre:'AI Agent vs ',
    cmp_h2_accent:'Sales Manager',
    cmp_intro:'Click on a character to see advantages or disadvantages.',
    cmp_ai_title:'AI Agent',
    cmp_ai_sub:'(Bot)',
    cmp_human_title:'Manager',
    cmp_human_sub:'(Human)',
    btn_get_ai:'Get AI',
    pain_h2_pre:'You are already ',
    pain_h2_accent:'losing money',
    pain_h2_post:'. Every single day.',
    pain_intro:'Not because of ads. Not because of the market. Because of process gaps that cost you clients and revenue.',
    pain_note:'It seems you have these problems — money is going to competitors.',
    pain_solution:'AI manager will close all the losses.',
    pain_solution_sub:'Intercept leads and multiply revenue.',
    btn_demo_ai:'Get AI Manager Demo',
    pain1_title:'Missed Calls',
    pain1_text:'The client doesn\'t wait — they go to the competitor.',
    pain1_stat:'+15% revenue lost every day',
    pain2_title:'Slow Response',
    pain2_text:'A reply in 15 minutes is already too late.',
    pain2_stat:'Up to 50% of leads go unanswered',
    pain3_title:'Inactive Database',
    pain3_text:'Contacts exist, but no sales from the database.',
    pain3_stat:'Thousands of dormant clients in your base',
    plans_h2_pre:'Starter Package ',
    plans_h2_accent:'AI Manager',
    plans_intro:'Responds instantly and captures hot leads',
    plan1_head:'AI responds in seconds',
    plan1_li1:'no waiting',
    plan1_li2:'no excuses',
    plan1_li3:'immediately runs conversation and records',
    plan2_head:'Drives client to booking, not "passes along"',
    plan2_li1:'clarifies convenient time',
    plan2_li2:'agrees on details',
    plan2_li3:'records client in CRM',
    plan3_head:'Works 24/7 without fatigue',
    plan3_li1:'never makes mistakes, always connected',
    plan3_li2:'responds at night and on weekends',
    plan_price_label:'Setup ',
    plan_price_sub:'Pays back through instant sales within 1–2 weeks',
    btn_choose_plan:'Choose plan',
    plan_ext_h3_pre:'Advanced version: ',
    plan_ext_h3_accent:'memory + analytics',
    plan_ext1_h4:'Remembers clients and continues the conversation over time',
    plan_ext1_p:'Every call is transcribed. AI remembers everything and picks up where it left off even months later.',
    plan_ext2_h4:'Sells differently, not by template',
    plan_ext2_p:'Analyzes the client\'s profile and selects the right approach.',
    plan_ext3_h4:'Brings clients back on its own',
    plan_ext3_p:'Tracks last visit date and initiates contact — like a live manager, but at scale.',
    plan_ext4_h4:'Scales to a network without quality loss',
    plan_ext4_p:'Single standard across all locations. No chaos while growing.',
    plan_ext_price_label:'Price ',
    steps_h2_pre:'Launch in ',
    steps_h2_accent:'5 steps',
    steps_intro:'Transparent process from the first meeting to first deals.',
    step1:'Analysis',step2:'Scripts',step3:'CRM',step4:'Training',step5:'Launch',
    steps_outro:'You don\'t need to figure it out — we do everything turnkey.',
    cases_h2_pre:'AI in sales is a ',
    cases_h2_accent:'measurable result',
    cases_h2_post:', not a hypothesis',
    cases_intro:'We deploy AI agents in sales teams and record metric growth from the first weeks.',
    cases_sub:'Client Results',
    cases_niches:'Proven cases in: real estate, infobusiness, services.',
    case1_stat:'+37% repeat sales',
    case1_niche:'Real Estate',
    case1_text:'AI agent activated a database of 4,000 cold contacts.\n— 2,800 outbound calls in 7 days\n— 600+ clients re-engaged\n— 14 additional deals without expanding the team',
    case2_stat:'×2 conversion growth',
    case2_niche:'Infobusiness',
    case2_text:'AI handles incoming leads instead of managers.\n— Response within 5 seconds\n— Conversion: 18% → 36%',
    case_what:'Business impact',
    case2_li1:'Fast recovery of dormant clients',
    case2_li2:'Increased conversion without more traffic',
    case2_li3:'Reduced team workload',
    case2_li4:'Predictable revenue growth',
    case3_stat:'−60% sales team costs',
    case3_niche:'Services',
    case3_text:'AI replaced part of manager functions without losing revenue.\n— Team reduced from 3 to 1 specialist\n— Sales volume maintained\n— Costs reduced by 60%',
    case_cta_q:'Ready to deploy AI in your sales team?',
    btn_audit:'Get Audit',
    btn_book_demo:'Book a Demo',
    voices_h2_pre:'Choose your ',
    voices_h2_accent:'AI Manager',
    voices_h2_post:' for your business',
    voices_intro:'Different voices and communication styles — for different tasks.',
    voice_anna:'Polina',voice_anna_badge:'Database Revival',
    voice_maksym:'Mia',voice_maksym_badge:'Deal Closing',
    voice_olena:'Sofia',voice_olena_badge:'Repeat Sales',
    voice_listen:'Listen sample',
    btn_select_voice:'Choose character & request demo call',
    btn_test_call:'Test AI Call',
    dcm_badge:'Live Demo',
    dcm_h2:'Experience an AI call right now',
    dcm_p:'Leave your number — the AI agent will call you within 60 seconds.',
    dcm_phone_err:'Please enter a valid phone number',
    demo_modal_title:'AI Call Samples',
    demo_modal_sub:'Click to listen to real demos',
    demo_cold_sub:'Outbound call to cold database',
    demo_confirm_sub:'Incoming lead handling',
    demo_close_sub:'Re-engaging a deferred client',
    demo_real_sub:'Recording of a real call',
    demo_call_badge:'🤖 Live Demo',
    demo_call_h2_pre:'Experience ',
    demo_call_h2_accent:'AI calling you',
    demo_call_h2_post:' right now',
    demo_call_p:'Leave your number — and the AI agent will call you within 60 seconds. This is a real call, not a recording.',
    dcf1:'Live AI voice, not a recording',
    dcf2:'Answers your questions in real time',
    dcf3:'Call within 60 seconds',
    demo_call_form_h3:'Get a Demo Call',
    demo_call_form_p:'The AI agent will call you and run a full demonstration.',
    label_name:'Name',
    label_phone:'Phone',
    placeholder_name:'Enter your name',
    placeholder_phone:'+380 50 123 45 67',
    btn_call_me:'Call me',
    demo_disclaimer:'Demo call is free. No spam or pushy sales.',
    form_h2:'Request a demo call',
    form_p:'The AI agent will call you within 60 seconds — a real call, not a recording.',
    btn_send:'Send',
    btn_close:'Close',
    calc_h2:'How much will you save?',
    calc_p:'Enter your sales team data.',
    calc_ops:'Number of operators (1–10)',
    calc_sal:'Average operator salary, UAH',
    calc_save_label:'Monthly savings: ',
    success_h2:'AI Agent is calling!',
    success_p:'Expect a call within 60 seconds. Get ready for a real AI demonstration.',
    countdown_label:'seconds until the call',
    demo_h2_new:'Try AI Manager right now',
    demo_sub_new:'Choose how you want to meet our AI',
    demo_instant:'Instant',
    demo_60sec:'60 seconds',
    demo_call_title:'Talk to AI now',
    demo_call_desc:'Click the button — AI agent will answer right in your browser. Microphone required.',
    demo_callback_title:'AI will call you',
    demo_callback_desc:'Leave your number — AI agent will call your phone within a minute.',
    demo_f1:'No registration',
    demo_f2:'No waiting',
    demo_f3:'Live conversation',
    demo_f4:'Real phone call',
    demo_f5:'To your number',
    demo_f6:'Free of charge',
    btn_talk_now:'Start conversation'
  }
};

function applyTranslation(el, key){
  var lang = document.documentElement.dataset.lang || 'uk';
  var t = translations[lang];
  if(!t || !t[key]) return;
  el.textContent = t[key];
}

function applyLanguage(lang){
  document.documentElement.setAttribute('data-lang', lang);
  var t = translations[lang];
  if(!t) return;

  $$('[data-i18n]').forEach(function(el){
    var key = el.dataset.i18n;
    if(t[key]) el.textContent = t[key];
  });

  $$('[data-i18n-placeholder]').forEach(function(el){
    var key = el.dataset.i18nPlaceholder;
    if(t[key]) el.placeholder = t[key];
  });

  /* update language dropdown button */
  var flag = $('.js-lang-flag');
  var name = $('.js-lang-name');
  if(lang === 'en'){
    if(flag) flag.textContent = '🇬🇧';
    if(name) name.textContent = 'EN';
  } else {
    if(flag) flag.textContent = '🇺🇦';
    if(name) name.textContent = 'UA';
  }
  $$('.js-lang-opt').forEach(function(opt){
    var isActive = opt.dataset.lang === lang;
    opt.classList.toggle('is-active', isActive);
    opt.setAttribute('aria-selected', isActive ? 'true' : 'false');
  });

  renderCompare(currentCmpKey);
  renderVoice(selectedVoice);
  setStep(stepIdx);
}

/* ── Language dropdown toggle ── */
(function(){
  var dropdown = $('#lang-dropdown');
  var btn      = dropdown ? dropdown.querySelector('.js-lang-toggle') : null;
  if(!dropdown || !btn) return;

  function openDD(){
    dropdown.classList.add('is-open');
    btn.setAttribute('aria-expanded','true');
    var menu = $('#lang-dd-menu');
    if(menu) menu.removeAttribute('hidden');
  }
  function closeDD(){
    dropdown.classList.remove('is-open');
    btn.setAttribute('aria-expanded','false');
    var menu = $('#lang-dd-menu');
    if(menu) menu.setAttribute('hidden','');
  }
  btn.addEventListener('click', function(e){
    e.stopPropagation();
    dropdown.classList.contains('is-open') ? closeDD() : openDD();
  });
  document.addEventListener('click', function(e){
    if(!dropdown.contains(e.target)) closeDD();
  });
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape') closeDD();
  });
  $$('.js-lang-opt').forEach(function(opt){
    opt.addEventListener('click', function(){
      var newLang = opt.dataset.lang;
      applyLanguage(newLang);
      try{localStorage.setItem('site_lang', newLang)}catch(err){}
      closeDD();
    });
  });
})();

/* ──────────── init ──────────── */
(function(){
  var savedLang = '';
  try{savedLang = localStorage.getItem('site_lang') || ''}catch(err){}
  var lang = (savedLang === 'en') ? 'en' : 'uk';
  applyLanguage(lang);

  renderCompare('ai');
  renderVoice('anna');
  setStep(0);
  renderCalc();
})();
