<?php

namespace App\ACF\Layouts;

class LargeHighlightsLayout extends \Geniem\ACF\Field\Flexible\Layout
{
    const KEY = 'large_highlights';

    public function __construct(string $key)
    {
        parent::__construct(
            'Suuret nostot',
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
            'template' => 'partials.components.small-highlights',
            'data'   => $layout['highlights']
        ];
    }
}
