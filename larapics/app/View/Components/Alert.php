<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\HtmlString;

class Alert extends Component
{

    public $type;
    protected $types = [
        "success",
        "danger",
        "warning",
        "info"
    ];
    public $dismissible;
    protected $classes = ['alert'];


    /**
     * Create a new component instance.
     */
    public function __construct($type = "info", $dismissible = false) 
    {    
        $this->type = $this->validType($type);    
        $this->classes[] = "alert-{$this->type}";
        if($dismissible){
            $this->classes[] = "alert-dismissible fade show";
        }        
        $this->dismissible = $dismissible;
    }

    protected function validType($type){
        return in_array($type, $this->types) ? $type : 'info';
    }

    public function link($text, $target='#'){
        return new HtmlString("<a href=\"{$target}\" class=\"alert-link\">{$text}</a>");
    }

    public function icon($url = null){
        $this->classes[] = 'd-flex align-items-center';
        $icon = $url ?? "https://larapics.georgebertios.com/larapics/public/icons/icon-{$this->type}.svg";
        return new HtmlString("<img class='me-2' src='{$icon}'/>");
    }

    public function getClasses(){
        return join(" ", $this->classes);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
