<?php

namespace App\Lib\ACF\Templates;

use Geniem\ACF\Exception;
use Geniem\ACF\Group;
use Geniem\ACF\Field;
use Geniem\ACF\RuleGroup;

class Page
{
    public function __construct()
    {
        \add_action(
            'init',
            \Closure::fromCallable([$this, 'register_fields'])
        );
    }

    protected function register_fields(): void
    {
        try {
            $group_title = 'Asetukset';

            $field_group = (new Group($group_title))
                ->set_key('fg_page');

            $key = $field_group->get_key();

            $rule_group = (new RuleGroup())
                ->add_rule('page_type', '!=', 'posts_page')
                ->add_rule('post_type', '==', 'page');

            $field_group->add_rule_group($rule_group);
            $field_group->add_fields($this->get_fields($key));

            $field_group->register();
        } catch (Exception $e) {
            // Log the error.
        }
    }

    protected function get_fields(string $key): array
    {
        $strings = [
            'nav_title' => [
                'label' => 'Valikkokäyttöön lyhennetty otsikko',
                'instructions' => '',
            ],
            'ingress' => [
                'label' => 'Ingressi',
                'instructions' => '',
            ],
            'search_keywords' => [
                'label' => 'Haun apusanat',
                'instructions' => 'Lisää haun apusanoja välilyönnillä erotettuna',
            ],
        ];

        $nav_title_field = (new Field\Text($strings['nav_title']['label']))
            ->set_key("{$key}_nav_title")
            ->set_name('nav_title')
            ->set_instructions($strings['nav_title']['instructions']);

        $ingress_field = (new Field\Textarea($strings['ingress']['label']))
            ->set_key("{$key}_ingress")
            ->set_name('ingress')
            ->set_rows(4)
            ->redipress_include_search()
            ->set_instructions($strings['ingress']['instructions']);

        $search_keywords_field = (new Field\Textarea($strings['search_keywords']['label']))
            ->set_key("{$key}_search_keywords")
            ->set_name('search_keywords')
            ->set_rows(2)
            ->redipress_include_search()
            ->set_instructions($strings['search_keywords']['instructions']);

        return [
            $nav_title_field,
            $ingress_field,
            $search_keywords_field,
        ];
    }
}

(new Page());
