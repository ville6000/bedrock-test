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

    public function fields() {
        return get_fields();
    }

    public function layouts() {
        return [
            'small-highlights-layout' => SmallHighlightsLayout::format_layout(),
        ];
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
