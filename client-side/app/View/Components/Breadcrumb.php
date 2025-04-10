<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $items; // 麵包屑項目

    /**
     * 建構子：接收傳入的麵包屑資料
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * 渲染元件視圖
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
