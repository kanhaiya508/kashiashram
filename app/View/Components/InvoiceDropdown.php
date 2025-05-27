<?php

namespace App\View\Components;

use App\Models\Invoice;
use Illuminate\View\Component;

class InvoiceDropdown extends Component
{
    public $name;
    public $label;
    public $selected;
    public $invoice;

    public function __construct($name, $label, $selected = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->selected = $selected;
        $this->invoice = Invoice::pluck('invoice_number', 'id'); // Fetch surveys as [id => quotation_number]
    }

    public function render()
    {
        return view('components.invoice-dropdown');
    }
}
