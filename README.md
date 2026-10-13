# AI sales manager site

Marketing site for an AI sales manager, with a live call demo and a lead form. The public title is “AI-менеджер для продажів” on ai-agent.website.

## Problem

The product is a voice agent. A static feature list did not show that. The site had to let a visitor hear a demo call and leave a lead without a separate app.

## What was built

A PHP site with:

- `index.php` as the landing page (Ukrainian, with a language switch in the markup).
- `demo-call.php`, `call.php`, and `ai-demo.php` for the call demo.
- `lead.php` and `send-lead.php` for the enquiry.
- Shared bootstrap, styles, and audio assets.

The page is built to be opened on a phone: viewport fit, a fixed theme color, and a short path from the hero to the demo and the form.

## How it works

`includes/bootstrap.php` loads first. The landing page posts the lead to the PHP handler. The demo flow plays the prepared audio and collects the visitor’s details on the same site, so the campaign does not depend on a third-party form embed.

## Stack

PHP, JavaScript, CSS, static audio.

## Run locally

Serve the directory with any PHP server:

```bash
php -S 127.0.0.1:8080
```

Open `http://127.0.0.1:8080`.

## What this public copy leaves out

The local virtualenv that was only used to generate documents. No production mailbox passwords are in this tree. Wire `send-lead.php` to your own transport before going live.

`includes/secrets.php` reads the Telegram token, the CRM token, and the ElevenLabs agent id from the environment. The page copy on the site itself is Ukrainian, because that is the language of ai-agent.website. This README is the English account of the project.
