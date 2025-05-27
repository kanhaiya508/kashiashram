<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchableDropdown extends Component
{
  public $name;
  public $label;
  public $selected;
  public $options;

  public function __construct($name, $label, $selected = null, $options = [])
  {
    $this->name = $name;
    $this->label = $label;
    $this->selected = $selected;
    $this->options = $options;
  }

  public function render()
  {
    return view('components.searchable-dropdown');
  }
}
