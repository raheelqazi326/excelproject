<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SpreadSheet;

class SelectCategory extends Component
{
    public $category;
    protected $listeners = ["tableUpdated"];

    public function tableUpdated() {}

    public function render()
    {
        $data['categories'] = SpreadSheet::groupBy('category')->where('user_id', auth()->user()->id)->pluck('category');
        return view('livewire.select-category')->with($data);
    }
}
