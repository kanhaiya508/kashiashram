<?php

namespace App\View\Components;

use App\Models\Customer;
use Illuminate\View\Component;

class CustomerDropdown extends Component
{
    public $customers;
    public $name;
    public $label;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @param string $name Input name attribute
     * @param string $label Dropdown label
     * @param int|null $selected Pre-selected customer ID
     */
    public function __construct($name, $label = 'Select Customer', $selected = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->selected = $selected;
        $this->customers = Customer::orderBy('created_at', 'desc')->get(); // Fetch latest customers
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.customer-dropdown');
    }
}
