<?php
/**
 * Copyright (c) 2021. Geniem Oy
 */

namespace App\ACF\Layouts;

use Geniem\ACF\Exception;
use Geniem\Theme\ACF\Fields\SmallHighlightsFields;
use Geniem\Theme\Logger;

/**
 * Class SmallHighlightsLayout
 */
class SmallHighlightsLayout extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = 'small_highlights';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Pienet nostot',
            $key . '/' . self::KEY,
            self::KEY
        );

        $this->add_layout_settings();
        $this->add_layout_fields();
    }

    /**
     * Add layout fields
     *
     * @return void
     */
    protected function add_layout_fields() : void {
        $fields = new SmallHighlightsFields();

        try {
            $this->add_fields(
                $this->filter_layout_fields(
                    $fields->get_fields( $this->get_key() ),
                    $this->get_key(),
                    self::KEY
                )
            );
        }
        catch ( Exception $e ) {
            ( new Logger() )->error( $e->getMessage(), $e->getTrace() );
        }
    }
}
