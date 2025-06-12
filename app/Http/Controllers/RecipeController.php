<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Recipes;
use App\Models\RecipeIngredients;
use App\Models\RecipeSteps;
use App\Models\RecipeNutritionFact;

class RecipeController extends Controller
{
    private $recipe;

    public function __construct(Recipes $recipe) {
        $this->recipe = $recipe;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipes::orderBy("updated_at","desc")->paginate(20);
        return view('admin.recipe_index', compact('recipes')); // あとで変える
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $recipe = $this->recipe;
        $categories = Category::all();
        $ingredients = $this->recipe->recipeIngredients;
        $steps = $this->recipe->recipeSteps;
        return view('admin.recipe_create', compact('recipe', 'categories', 'ingredients', 'steps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //フォームの値をバリデーション
        //レシピのメイン部分
        $recipe_main = $request->validate([
            'title' => 'required|max:30',
            'content' => 'required|max:300',
            // 'img' => 'nullable|max:300',
            'time' => 'required|max:20',
            'amount' => 'required|max:20',
            'category_id' => 'required|integer|exists:categories,id',
        ]);
        $recipe_main['img'] = 'sample.png'; //あとで消す
        //レシピの栄養部分
        $nutrition_facts = $request->validate([
            'energy' => 'nullable|integer|min:0',
            'protein' => 'nullable|numeric|min:0',
            'fat' => 'nullable|numeric|min:0',
            'carb' => 'nullable|numeric|min:0',
            'fiber' => 'nullable|numeric|min:0',
            'salt_eqv' => 'nullable|numeric|min:0',
        ]);
        //レシピの材料部分
        $materials = $request->validate([
            'material.*' => 'required|max:20',
            'quantity.*' => 'required|max:20',
        ]);
        //レシピの手順部分
        $procedures = $request->validate([
            'procedure.*' => 'required|max:20',
            'sub_img.*' => 'nullable|max:300',
        ]);

        //レシピのメイン部分を登録
        $recipe = Recipes::create($recipe_main);
        //レシピの栄養を登録
        $nutrition_facts['recipe_id'] = $recipe->id;
        // dd($nutrition_facts);
        RecipeNutritionFact::create([
            'recipe_id'=> $recipe->id,
            $nutrition_facts]);
        //レシピの材料を登録
        if (!empty($materials)) {
            foreach ($materials['material'] as $index => $name) {
                $amount = $materials['quantity'][$index];
                RecipeIngredients::create([
                    'recipe_id' => $recipe->id,
                    'name' => $name,
                    'amount' => $amount,
                ]);
            }
        }
        //レシピの手順を登録
        if (!empty($procedures)) {
            foreach ($procedures['procedure'] as $index => $content) {
                $img = $procedures['sub_img'][$index];
                RecipeSteps::create([
                    'recipe_id' => $recipe->id,
                    'content' => $content,
                    'img' => $img,
                ]);
            }
        }

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
    public function edit(Recipes $recipe)
    {
        $categories = Category::all();
        $ingredients = $recipe->recipeIngredients;
        $steps = $recipe->recipeSteps;
        return view('admin.recipe_edit', compact('recipe', 'categories', 'ingredients', 'steps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipes $recipe)
    {
        //フォームの値をバリデーション
        //レシピのメイン部分
        $recipe_main = $request->validate([
            'title' => 'required|max:30',
            'content' => 'required|max:300',
            // 'img' => 'nullable|max:300',
            'time' => 'required|max:20',
            'amount' => 'required|max:20',
            'category_id' => 'required|integer|min:1',
        ]);
        $recipe_main['img'] = 'sample.png'; //あとで消す
        //レシピの材料部分
        $materials = $request->validate([
            'ingredient_id.*' => 'nullable|integer',
            'material.*' => 'required|max:20',
            'quantity.*' => 'required|max:20',
        ]);
        //レシピの手順部分
        $procedures = $request->validate([
            'step_id.*' => 'nullable|integer',
            'procedure.*' => 'required|max:300',
            'sub_img.*' => 'nullable|max:300',
        ]);
        
        //レシピのメイン部分を登録
        $recipe->update($recipe_main);

        //レシピの材料を登録
        $ingredient_ids = $recipe->recipeIngredients()->pluck('id')->toArray();
        $form_ingredient_ids = array_filter($materials['ingredient_id'] ?? []);
        if (!empty($materials)) {
            foreach ($materials['material'] as $index => $name) {
                $id = $form_ingredient_ids[$index] ?? null;
                $amount = $materials['quantity'][$index];

                if ($id) {
                    $ingredient = RecipeIngredients::find($id);
                    if ($ingredient) {
                        $ingredient->update([
                            'name' => $name,
                            'amount' => $amount,
                        ]);
                    }
                } else {
                    RecipeIngredients::create([
                        'recipe_id' => $recipe->id,
                        'name' => $name,
                        'amount' => $amount,
                    ]);
                }
            }
        }
        $ingredient_delete_ids = array_diff($ingredient_ids, $form_ingredient_ids);
        if (!empty($ingredient_delete_ids)) {
            $recipe->recipeIngredients()->whereIn('id', $ingredient_delete_ids)->delete();
        }

        //レシピの手順を登録
        $steps_ids = $recipe->recipeSteps()->pluck('id')->toArray();
        $form_steps_ids = array_filter($procedures['step_id'] ?? []);
        if (!empty($procedures)) {
            foreach ($procedures['procedure'] as $index => $content) {
                $id = $form_steps_ids[$index] ?? null;
                $img = $procedures['sub_img'][$index];

                if ($id) {
                    $ingredient = RecipeSteps::find($id);
                    if ($ingredient) {
                        $ingredient->update([
                            'content' => $content,
                            'amount' => $img,
                        ]);
                    }
                } else {
                    RecipeSteps::create([
                        'recipe_id' => $recipe->id,
                        'content' => $content,
                        'img' => $img,
                    ]);
                }
            }
        }
        $step_delete_ids = array_diff($steps_ids, $form_steps_ids);
        if (!empty($step_delete_ids)) {
            $recipe->recipeSteps()->whereIn('id', $step_delete_ids)->delete();
        }

        $request->session()->flash('message', '更新しました');
        return redirect()->route('recipe.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
