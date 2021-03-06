<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Socials extends Component
{

    public $driver;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->driver = config('services.socials');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.socials');
    }
}
