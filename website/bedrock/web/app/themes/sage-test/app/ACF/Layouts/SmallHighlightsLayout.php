<?php

namespace App\ACF\Layouts;

class SmallHighlightsLayout extends \Geniem\ACF\Field\Flexible\Layout
{
    const KEY = 'small_highlights';

    public function __construct(string $key)
    {
        parent::__construct(
            'Pienet nostot',
            $key . '/' . self::KEY,
            self::KEY
        );

        $this->fields();
    }

    protected function fields(): void
    {
        $fields = new \App\ACF\Fields\SmallHighlightsFields();

        $this->add_fields(
            $fields->get_fields($this->get_key()),
        );
    }

    public static function format_layout(array $layout): ?array
    {
        return [
            'layout' => $layout['acf_fc_layout'],
            'template' => 'components.small-highlights',
            'data'   => $layout['highlights']
        ];
    }
}
