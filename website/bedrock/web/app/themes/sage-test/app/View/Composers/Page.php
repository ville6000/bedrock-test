<?php

namespace App\View\Composers;

use App\ACF\Layouts\SmallHighlightsLayout;
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

    public function layouts()
    {
        $main_layouts = get_field( 'layouts' ) ?? [];

        return $this->formatAcfFlexibleLayouts( $main_layouts, [
            'small_highlights' => [ SmallHighlightsLayout::class, 'format_layout' ],
        ] );
    }

    private function formatAcfFlexibleLayouts( array $layouts, array $callbacks ): array
    {
        $handled = [];

        if ( empty( $layouts ) ) {
            return $handled;
        }

        foreach ( $layouts as $layout ) {
            if ( empty( $layout['acf_fc_layout'] ) ) {
                continue;
            }

            if ( array_key_exists( $layout['acf_fc_layout'], $callbacks ) ) {
                $handled[] = call_user_func( $callbacks[$layout['acf_fc_layout']], $layout );
            }
        }

        return $handled;
    }

    public function with(): array
    {
        return [
            'title'   => $this->title(),
            'layouts' => $this->layouts(),
        ];
    }
}
