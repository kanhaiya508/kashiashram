<?php

namespace App\View\Components;

use App\Models\Survey;
use Illuminate\View\Component;

class SurveyDropdown extends Component
{
    public $name;
    public $label;
    public $selected;
    public $surveys;

    public function __construct($name, $label, $selected = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->selected = $selected;
        $this->surveys = Survey::pluck('survey_no', 'id'); // Fetch surveys as [id => survey_no]
    }

    public function render()
    {
        return view('components.survey-dropdown');
    }
}
