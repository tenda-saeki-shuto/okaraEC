<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recipes;
use App\Models\RecipeIngredients;
use App\Models\RecipeSteps;
use App\Models\RecipeNutritionFact;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.recipes_create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.recipes_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $recipe_main = $request->validate([
            'title' => 'required|max:30',
            'content' => 'required|max:300',
            // 'img' => 'nullable|max:300',
            'time' => 'required|max:20',
            'amount' => 'required|max:20',
            'category_id' => 'required|integer|min:1',
        ]);
        $recipe_main['img'] = 'sample.png'; //あとで消す
        $recipe = Recipes::create($recipe_main);


        $materials = $request->validate([
            'material.*' => 'required|max:20',
            'quantity.*' => 'required|max:20',
        ]);

        // var_dump($recipe->id);
        var_dump(count($materials['material']));
        for ($i = 0; $i < count($materials['material']); $i++) {
            var_dump($materials['material'][$i]);
            var_dump($materials['quantity'][$i]);
            RecipeIngredients::create([
                "recipe_id" => $recipe->id,
                "name" => $materials['material'][$i],
                "amount" => $materials['quantity'][$i],
            ]);
        }


        // $procedures = $request->validate([
        //     'procedure.*' => 'required|max:20',
        //     // 'sub_img.*' => 'required|max:300',
        // ]);

        // var_dump($recipe->id);
        // foreach ($procedures['selections'] as $procedure) {
        //     var_dump($selection_content);
        //     $ingredient['recipe_id'] = $recipe->id;
        //     $ingredient['name'] = $selection_content;
        //     $ingredient['amount'] = $selection_content;
        //     QuizSelections::create($ingredient);
        // }
        var_dump($recipe_main);



        $request->session()->flash('message', '保存しました');
        return redirect()->route('recipe.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
