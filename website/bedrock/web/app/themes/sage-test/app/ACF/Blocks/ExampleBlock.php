<?php

namespace App\ACF\Blocks;

use App\Lib\BlockRenderer;
use Geniem\ACF\Block;
use Geniem\ACF\Field;
use Geniem\ACF\Field\Message;

class ExampleBlock
{
    const NAME = 'example';

    protected $title = 'Example Block';

    protected $description = 'This is an example block.';

    protected $category = 'common';

    protected $icon = 'menu';

    protected $mode = 'edit';

    protected $supports = [
        'align' => false,
        'anchor' => true,
    ];

    public function __construct()
    {
        $block = new Block($this->title, static::NAME);
        $block->set_category($this->category);
        $block->set_icon($this->icon);
        $block->set_description($this->description);
        $block->set_mode($this->mode);
        $block->set_supports($this->supports);
        $block->set_renderer($this->get_renderer());

        // Add the block name as a message field to label the blocks in the content area edit mode
        $block_name_field = new Message($this->title, 'block_name_field_' . static::NAME, 'block_name_field');
        $block->add_field($block_name_field);

        $block->add_fields($this->fields());
        $block->add_data_filter([$this, 'with']);

        $block->register();
    }

    /**
     * Getter for block name.
     *
     * @return string
     */
    public function get_name()
    {
        return static::NAME;
    }

    public function fields()
    {
        $strings = [
            'title' => [
                'label' => 'Otsikko',
                'instructions' => 'Syötä tähän enintään 90 merkkiä pitkä noston otsikko.',
            ],
            'description' => [
                'label' => 'Tekstikappale',
                'instructions' => 'Syötä tähän enintään 160 merkkiä pitkä noston tekstikappale.',
            ],
        ];

        $key = $this->get_name();

        $title = (new Field\Text($strings['title']['label']))
            ->set_key("{$key}_title")
            ->set_name('title')
            ->set_maxlength(90)
            ->set_wrapper_width(100)
            ->set_required()
            ->redipress_include_search()
            ->set_instructions($strings['title']['instructions']);

        $description = (new Field\Textarea($strings['description']['label']))
            ->set_key("{$key}_description")
            ->set_name('description')
            ->set_new_lines('')
            ->set_rows(3)
            ->set_maxlength(160)
            ->redipress_include_search()
            ->set_instructions($strings['description']['instructions']);

        return [
            $title,
            $description,
        ];
    }

    public function with(array $data): array
    {
        return $data;
    }

    /**
     * Get the renderer.
     * If dust partial is not found in child theme, we will use the parent theme partial.
     *
     * @param string $name Dust partial name, defaults to block name.
     *
     * @return BlockRenderer
     */
    protected function get_renderer(string $name = '')
    {
        $name = strtolower($this->get_name());
        $file = 'blocks.' . $name;

        return new BlockRenderer($file);
    }
}
