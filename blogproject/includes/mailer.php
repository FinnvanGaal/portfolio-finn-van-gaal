<?php

// includes/mailer.php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

function make_mailer(): Mailer
{
    $dsn = 'smtp://localhost:1025';
    $transport = Transport::fromDsn($dsn);
    return new Mailer($transport);
}

function send_mail(string $to, string $subject, string $textBody, ?string $htmlBody = null): void
{
    $mailer = make_mailer();
    $email = (new Email())
        ->from('no-reply@mijnblog.local')
        ->to($to)
        ->subject($subject)
        ->text($textBody);

    if ($htmlBody !== null) {
        $email->html($htmlBody);
    }
    $mailer->send($email);
}

function notify_post_author(array $authorData, string $slug, string $commenter, string $comment): void
{
    $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $postUrl = $scheme . '://' . $host . '/currentPost.php?post=' . urlencode($slug);

    $subject = 'Nieuwe reactie op jouw post: ' . $authorData['post_title'];

    $textBody = "Hoi {$authorData['author_username']},\n\n"
        . "Er is een nieuwe reactie op jouw post: \"{$authorData['post_title']}\".\n\n"
        . "Reactie geplaatst door: {$commenter}\n"
        . "Reactie:\n{$comment}\n\n"
        . "Bekijk de post: {$postUrl}\n\n"
        . "— Automatische melding";

    // 🎨 Styled HTML versie
    $htmlBody = '
<div style="font-family: Arial, sans-serif; background-color:#f6f5f3; padding:20px;">
    <div style="max-width:600px; margin:auto; background:#fff; border-radius:12px; box-shadow:0 2px 5px rgba(0,0,0,0.1); overflow:hidden;">
    
    <!-- Header -->
    <div style="background:#588157; padding:16px; text-align:center;">
        <h1 style="color:#fff; margin:0; font-size:20px;">🍴 Mijn Blog</h1>
    </div>

    <div style="padding:20px;">
        <h2 style="color:#588157; margin-top:0;">Nieuwe reactie op jouw post</h2>
        <p>Hoi <strong>' . htmlspecialchars($authorData['author_username']) . '</strong>,</p>
        <p>Er is een nieuwe reactie geplaatst op jouw post: <em>' . htmlspecialchars($authorData['post_title']) . '</em></p>
        <p><strong>Reactie geplaatst door:</strong> ' . htmlspecialchars($commenter) . '</p>
        <blockquote style="background:#f6f5f3; border-left:4px solid #588157; margin:15px 0; padding:10px;">
        ' . nl2br(htmlspecialchars($comment)) . '
        </blockquote>
        <p>
        <a href="' . htmlspecialchars($postUrl) . '" 
            style="display:inline-block; padding:10px 16px; background:#588157; color:#fff; text-decoration:none; border-radius:8px;">
            Bekijk de post
        </a>
        </p>
        <p style="color:#777; font-size:12px;">— Automatische melding</p>
    </div>
    </div>
</div>';

    send_mail($authorData['author_email'], $subject, $textBody, $htmlBody);
}
