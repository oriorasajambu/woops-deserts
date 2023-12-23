<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectImagesModal extends Component
{
    /**
     * The layout message.
     *
     * @var string
     */
    public $title;

    /**
     * The layout route.
     *
     * @var string
     */
    public $route;

    /**
     * The layout id.
     *
     * @var string
     */
    public $id;

    /**
     * The layout label.
     *
     * @var string
     */
    public $label;

    /**
     * The layout watermark.
     *
     * @var string
     */
    public $watermark;

    /**
     * The layout watermark.
     *
     * @var string
     */
    public $alt;

    /**
     * The layout compress.
     *
     * @var string
     */
    public $compress;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $route, $id, $label, string $watermark = 'true', string $alt = 'true', string $compress)
    {
        $this->title = $title;
        $this->route = $route;
        $this->id = $id;
        $this->label = $label;
        $this->watermark = $watermark;
        $this->alt = $alt;
        $this->compress = $compress;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.select-images-modal');
    }
}
