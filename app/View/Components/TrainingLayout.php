<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TrainingLayout extends Component
{
    public $training;
    public $title;

    public function __construct($training, $title = 'Training')
    {
        $this->training = $training;
        $this->title = $title;
    }

    public function render()
    {
        return view('layouts.training');
    }
}
