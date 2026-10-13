<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';

$fb_pixel = '';
if (defined('FB_PIXEL_ID') && FB_PIXEL_ID !== '') {
    $fb_pixel = FB_PIXEL_ID;
} elseif (!empty($_GET['fb_pixel'])) {
    $fb_pixel = preg_replace('/\D/', '', (string) $_GET['fb_pixel']);
}

if ($fb_pixel !== '') :
    ?>
    <script>
      !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
      n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}
      (window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?php echo htmlspecialchars($fb_pixel, ENT_QUOTES, 'UTF-8'); ?>');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none" alt=""
        src="https://www.facebook.com/tr?id=<?php echo htmlspecialchars($fb_pixel, ENT_QUOTES, 'UTF-8'); ?>&ev=PageView&noscript=1" />
    </noscript>
    <?php
endif;

if (defined('GTAG_AW_ID') && GTAG_AW_ID !== '') :
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars(GTAG_AW_ID, ENT_QUOTES, 'UTF-8'); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?php echo htmlspecialchars(GTAG_AW_ID, ENT_QUOTES, 'UTF-8'); ?>');
    </script>
    <?php
endif;
