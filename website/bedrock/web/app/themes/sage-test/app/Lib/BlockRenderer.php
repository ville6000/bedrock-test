<?php

namespace App\Lib;

readonly class BlockRenderer implements \Geniem\ACF\Interfaces\Renderer
{
    public function __construct(private string $partial)
    {
    }

    public function render(array $data): string
    {
        return view($this->partial, $data);
    }
}
