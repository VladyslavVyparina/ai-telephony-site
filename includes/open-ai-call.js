/**
 * Відкриває ElevenLabs ConvAI widget (вхідна лінія).
 * Новий API: CustomEvent 'elevenlabs-agent:expand' (метод .open() більше не існує).
 */
(function (window, document) {
  'use strict';

  function dispatchExpand(widget) {
    try {
      document.dispatchEvent(
        new CustomEvent('elevenlabs-agent:expand', {
          detail: { action: 'expand' },
          bubbles: true
        })
      );
      if (widget) {
        widget.dispatchEvent(
          new CustomEvent('elevenlabs-agent:expand', {
            detail: { action: 'expand' },
            bubbles: true
          })
        );
      }
      return true;
    } catch (err) {
      return false;
    }
  }

  function clickShadowExpand(widget) {
    if (!widget || !widget.shadowRoot) return false;
    var root = widget.shadowRoot;
    var btn =
      root.querySelector('[aria-label="Expand widget"]') ||
      root.querySelector('[aria-label="Expand"]') ||
      root.querySelector('button');
    if (!btn) return false;
    try {
      btn.click();
      return true;
    } catch (err) {
      return false;
    }
  }

  function openInboundLine() {
    var widget = document.querySelector('elevenlabs-convai');
    var opened = dispatchExpand(widget);

    if (widget && typeof widget.open === 'function') {
      try {
        widget.open();
        opened = true;
      } catch (err2) {}
    }

    if (clickShadowExpand(widget)) opened = true;

    /* Якщо скрипт віджета ще не завантажився — повторити після появи */
    if (!widget || !widget.shadowRoot) {
      var tries = 0;
      var timer = setInterval(function () {
        tries += 1;
        var w = document.querySelector('elevenlabs-convai');
        dispatchExpand(w);
        if (clickShadowExpand(w) || tries >= 20) clearInterval(timer);
      }, 250);
    }

    return opened;
  }

  function unavailableMessage() {
    var lang = (document.documentElement.getAttribute('data-lang') || 'uk').toLowerCase();
    if (lang === 'ru') {
      return 'Входная линия временно недоступна. Воспользуйтесь формой обратного звонка.';
    }
    if (lang === 'en') {
      return 'Inbound line is temporarily unavailable. Please use the callback form.';
    }
    return 'Вхідна лінія тимчасово недоступна. Скористайтеся формою зворотного дзвінка.';
  }

  function bindStartButtons(selector, requireWidget) {
    document.addEventListener('click', function (e) {
      var trigger = e.target.closest(selector);
      if (!trigger) return;
      e.preventDefault();
      if (requireWidget && !document.querySelector('elevenlabs-convai')) {
        window.alert(unavailableMessage());
        return;
      }
      openInboundLine();
    });

    document.addEventListener('keydown', function (e) {
      if (e.key !== 'Enter' && e.key !== ' ') return;
      var trigger = e.target.closest(selector);
      if (!trigger) return;
      e.preventDefault();
      trigger.click();
    });
  }

  window.PulseInbound = {
    open: openInboundLine,
    bindStartButtons: bindStartButtons,
    unavailableMessage: unavailableMessage
  };
})(window, document);
