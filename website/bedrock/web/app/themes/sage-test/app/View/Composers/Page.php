<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Page extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
        'partials.content-page',
    ];
 
    /**
     * Returns the post title.
     *
     * @return string
     */
    public function title()
    {
        return get_the_title();
    }

    public function layouts() {

        $main_layouts = get_field( 'layouts' );

        return $this->format_acf_flexible_layouts( $main_layouts, [
            'small_highlights_layout' => [ SmallHighlightsLayout::class, 'format_layout' ],
        ] );
    }

    private function format_acf_flexible_layouts( array $layouts, array $callbacks ) {
        
        $handled = [];

        if ( empty( $fields ) ) {
            return $handled;
        }

        foreach ( $layouts as $layout ) {

            if ( empty( $layout['acf_fc_layout'] ) ) {
                continue;
            }

            if ( array_key_exists( $layout['acf_fc_layout'], $callbacks ) ) {
                $handled[] = call_user_func( $layout['acf_fc_layout'], $layout );
            }
        }
    
        return $handled;
    }

    /**
     * 
     *
     * @return string
     */
    public function with() {
        return [
            'title'   => $this->title(),
            'layouts' => $this->layouts(),
        ];
    }
}
