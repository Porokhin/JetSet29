<?php
header('Access-Control-Allow-Origin: *'); // Разрешаем запросы из Telegram Mini App
header('Content-Type: text/html; charset=utf-8');

// URL сайта Jetset29.ru (можно менять по необходимости)
$url = 'https://jetset29.ru';

// Получаем HTML сайта
$html = file_get_contents($url, false, stream_context_create([
    'http' => ['header' => 'User-Agent: Mozilla/5.0']
]));

// Удаляем заголовки, которые блокируют iframe
$html = preg_replace('/<meta[^>]+http-equiv=["\']X-Frame-Options["\'][^>]+>/i', '', $html);
$html = preg_replace('/<meta[^>]+content-security-policy[^>]+>/i', '', $html);

// Исправляем ссылки, чтобы они вели на оригинальный сайт через прокси
$html = str_replace('href="/', 'href="' . $url . '/', $html);
$html = str_replace('src="/', 'src="' . $url . '/', $html);

// Выводим обработанный HTML
echo $html;
?>
