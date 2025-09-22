<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public string $color;
    public string $title = '';
    public string $icon;
    /**
     * Create a new component instance.
     */
    public function __construct(public string $href, public string $type, public string $name = '')
    {
        if ($type == 'add') {
            $this->color = 'btn btn-primary';
            $this->icon = 'fa fa-plus mr-1';
        } elseif ($type == 'show') {
            $this->color = 'btn btn-info btn-sm';
            $this->title = __('keywords.show');
            $this->icon = 'fa fa-eye';
        } elseif ($type == 'edit') {
            $this->color = 'btn btn-success btn-sm';
            $this->title = __('keywords.edit');
            $this->icon = 'bx  bx-edit';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
