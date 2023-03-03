<?php

namespace App\ACF\Templates;

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
            'tab'    => 'Sisältö',
            'button' => 'Lisää uusi lohko',
        ];

        $tab = ( new Field\Tab( $strings['tab'] ) )
            ->set_placement( 'left' );

        $layouts_field = ( new Field\FlexibleContent( $strings['tab'] ) )
            ->set_key( "${key}_layouts" )
            ->set_name( 'layouts' )
            ->set_button_label( $strings['button'] )
            ->hide_label();

        return [
            $layouts_field,
        ];
    }
}

(new Page());
