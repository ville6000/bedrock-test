<?php
/**
 * Theme ACF
 */

$templates = [
    \App\Lib\ACF\Templates\Page::class,
];

$templates = \apply_filters('kpo/acf/templates', $templates);

foreach ($templates as $template) {
    (new $template());
}
