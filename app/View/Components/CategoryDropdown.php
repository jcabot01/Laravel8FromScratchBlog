<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class CategoryDropdown extends Component
{
    /**
     * Get the view / contents that represent the component.
     **/
    public function render()
    {
        return view('components.category-dropdown', [ //all fetching for categories done here
            'categories' => Category::all(),
            'currentCategory' => Category::where('slug', request('category'))->first() //where slug equals the requested category from search
        ]);
    }
}
