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
        $categories = Category::all();
        return view('admin.recipe_create', compact('categories'));
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
            'category_id' => 'required|integer|min:1',
        ]);
        $recipe_main['img'] = 'sample.png'; //あとで消す
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
        //レシピの材料を登録
        for ($i = 0; $i < count($materials['material']); $i++) {
            RecipeIngredients::create([
                "recipe_id" => $recipe->id,
                "name" => $materials['material'][$i],
                "amount" => $materials['quantity'][$i],
            ]);
        }
        //レシピの手順を登録
        for ($i = 0; $i < count($procedures['procedure']); $i++) {
            RecipeSteps::create([
                "recipe_id" => $recipe->id,
                "content" => $procedures['procedure'][$i],
                "img" => $procedures['sub_img'][$i],
            ]);
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
            'material.*' => 'required|max:20',
            'quantity.*' => 'required|max:20',
        ]);
        //レシピの手順部分
        $procedures = $request->validate([
            'procedure.*' => 'required|max:20',
            'sub_img.*' => 'nullable|max:300',
        ]);

        //レシピのメイン部分を登録
        $recipe->update($recipe_main);
        //レシピの材料を登録
        for ($i = 0; $i < count($materials['material']); $i++) {
            $recipe->recipeIngredients->update([
                "recipe_id" => $recipe->id,
                "name" => $materials['material'][$i],
                "amount" => $materials['quantity'][$i],
            ]);
        }
        //レシピの手順を登録
        for ($i = 0; $i < count($procedures['procedure']); $i++) {
            $recipe->recipeSteps->update([
                "recipe_id" => $recipe->id,
                "content" => $procedures['procedure'][$i],
                "img" => $procedures['sub_img'][$i],
            ]);
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
