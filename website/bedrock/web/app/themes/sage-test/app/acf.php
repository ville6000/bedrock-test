<?php
/**
 * Theme ACF
 */

$templates = [
    \App\ACF\Templates\Page::class,
];

$templates = \apply_filters('kpo/acf/templates', $templates);

foreach ($templates as $template) {
    (new $template());
}

$files = scandir(__DIR__ . '/ACF/Blocks');
$cleaned_files = array_diff($files, ['.', '..',]);

array_walk($cleaned_files, function ($block) {
    $block_class_name = str_replace('.php', '', $block);

    if ($block_class_name !== $block) {
        $class_name = "App\\ACF\\Blocks\\{$block_class_name}";

        if (class_exists($class_name)) {
            (new $class_name());
        }
    }
});
