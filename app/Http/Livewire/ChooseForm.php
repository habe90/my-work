<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Admin\FormController;
use App\Models\ServiceCategory;
use App\Models\Forms;
use Illuminate\Http\Request;
use Livewire\Component;

class ChooseForm extends Component
{  
    public $formId;

    public function mount($formId)
    {
        $this->formId = $formId;
    }

    public function render()
    {
        $category = Forms::findOrFail($this->formId);

        $formName = $category->name;  // Ime kategorije odgovara imenu forme
       
        // Kreirajte Request objekt za učitavanje forme
        $request = new Request([
            'recordID' => encrypt($this->formId),  // ID kategorije se koristi ovdje
            'formName' => encrypt($formName),  // Ime forme se šifrira i šalje
        ]);

        // Učitajte formu koristeći FormController
        $dynamicForm = (new FormController)->loadMyForm($request);

        return view('livewire.choose-form', [
            'dynamicForm' => $dynamicForm,
            'categoryName' => $category->name,
        ]);
    }
}
