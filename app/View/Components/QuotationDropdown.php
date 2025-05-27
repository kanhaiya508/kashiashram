<?php

namespace App\View\Components;

use App\Models\Quotation;
use Illuminate\View\Component;

class QuotationDropdown extends Component
{
    public $name;
    public $label;
    public $selected;
    public $quotation;

    public function __construct($name, $label, $selected = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->selected = $selected;
        $this->quotation = Quotation::pluck('quotation_number', 'id'); // Fetch surveys as [id => quotation_number]
    }

    public function render()
    {
        return view('components.quotation-dropdown');
    }
}
