<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tabs extends Component
{
    public $tabs;
    public $activeTab;

    public function __construct($tabs = [], $activeTab = 0)
    {
        $this->tabs = $tabs;
        $this->activeTab = $activeTab;
    }

    public function render()
    {
        return view('components.tabs');
    }
}
