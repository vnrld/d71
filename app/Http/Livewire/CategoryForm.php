<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CategoryForm extends Component
{
    public string $name = '';

    public Collection $categories;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categories = Category::all();
    }

    public function submit()
    {
        $validatedData = $this->validate(
            [
                'name' => 'required|min:1|unique:categories',
            ]
        );

        Category::create($validatedData);
        return redirect()->route('dashboard.articles-categories');
    }

    public function deleteCategory(int $categoryId)
    {
        Category::destroy($categoryId);
        return redirect()->route('dashboard.articles-categories');
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
