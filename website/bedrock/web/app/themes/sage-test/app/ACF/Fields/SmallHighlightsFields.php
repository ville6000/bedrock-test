<?php

namespace App\ACF\Fields;

use Geniem\ACF\Field;

class SmallHighlightsFields
{
    public function get_fields( string $key ) : array
    {
        $strings = [
            'title' => [
                'label'        => 'Otsikko',
                'instructions' => 'Syötä tähän enintään 90 merkkiä pitkä noston otsikko.',
            ],
            'description' => [
                'label'        => 'Tekstikappale',
                'instructions' => 'Syötä tähän enintään 160 merkkiä pitkä noston tekstikappale.',
            ],
            'link' => [
                'label'        => 'Linkki',
                'instructions' => 'Valitse tästä linkin kohde.',
            ],
        ];

        $highlights = ( new Field\Repeater( 'Nostot' ) )
            ->set_key( "{$key}_highlights" )
            ->set_name( 'highlights' )
            ->hide_label()
            ->set_wrapper_classes( 'no-label' )
            ->set_min( 1 )
            ->set_layout( 'block' )
            ->set_button_label( 'Lisää uusi nosto' );

        $title = ( new Field\Text( $strings['title']['label'] ) )
            ->set_key( "{$key}_title" )
            ->set_name( 'title' )
            ->set_maxlength( 90 )
            ->set_wrapper_width( 100 )
            ->set_required()
            ->redipress_include_search()
            ->set_instructions( $strings['title']['instructions'] );

        $description = ( new Field\Textarea( $strings['description']['label'] ) )
            ->set_key( "{$key}_description" )
            ->set_name( 'description' )
            ->set_new_lines( '' )
            ->set_rows( 3 )
            ->set_maxlength( 160 )
            ->redipress_include_search()
            ->set_instructions( $strings['description']['instructions'] );

        $link = ( new Field\Link( $strings['link']['label'] ) )
            ->set_key( "{$key}_link" )
            ->set_name( 'link' )
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['link']['instructions'] );

        $highlights->add_fields( [
            $link,
            $title,
            $description,
        ] );

        return [
            $highlights,
        ];
    }
}
