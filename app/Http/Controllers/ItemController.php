<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Allergy;
use App\Models\Category;
use App\Models\ItemNutritionFact;
use App\Models\ItemAllergy;
use App\Models\ItemPicture;
use App\Models\UserLike;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;


class ItemController extends Controller
{

    // 商品一覧表示
    public function user_index()
    {
        $user = Auth::user();
        $items = Item::all();

        $item_list = $items->map(function ($item) use ($user) {
            $item->is_favorite = $user ? $item->likedByUsers()->where('user_id', $user->id)->exists() : false;
            return $item;
        });

        $category = Category::all();

        return view('user.items', compact('item_list', 'category'));
    }
    // 商品一覧のフィルター

    public function filter(Request $request)
    {
        $user = Auth::user();

        $items = Item::query();

        if ($request->filled('category')) {
            $items->where('category_id', $request->category);
        }

        $items = $items->get();

        // 各商品に is_favorited を追加
        $items->map(function ($item) use ($user) {
            $item->is_favorited = $user
                ? UserLike::where('user_id', $user->id)->where('item_id', $item->id)->exists()
                : false;
            return $item;
        });

        return response()->json([
            'items' => $items->values()
        ]);
    }

    public function show($id)
    {
        $item = Item::with([
            'categories',
            'itemPictures',
            'itemAllergies.Allergies',
            'nutritionFacts'
        ])->findOrFail($id);
        // dd($item);

        $user = Auth::user();

        // ユーザーのカート情報を取得
        $user_id = Auth::id();
        $cart_item = Cart::where('user_id', $user_id)->where('item_id', $id)->first();
        // dd($cart_item);

        // お気に入り状態を追加
        $item->is_favorited = false;
        if (Auth::check()) {
            $item->is_favorited = UserLike::where('user_id', $user->id)->where('item_id', $item->id)->exists();
        }

        return view('user.item_detail', compact('item', 'cart_item'));
    }

    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function index()
    { // 商品名、種類名、最終更新日、在庫
        $item_list = Item::orderBy("updated_at", "desc")->paginate(20);
        return view('admin.item_index', compact('item_list'));
    }

    public function create()
    {
        $item = $this->item;
        $item_nutrition_facts = $this->item->nutritionFacts;
        $item_allergies = [];
        $categories = Category::all();
        $allergy_list = Allergy::all();
        return view('admin.item_create', compact(
            'item',
            'item_nutrition_facts',
            'item_allergies',
            'categories',
            'allergy_list'
        ));
    }

    public function store(Request $request)
    {
        
        // 商品データ
        // table: Items
        $itemData = $request->validate([
            'name' => 'required|max:30',
            'price' => 'required|integer',
            'content' => 'nullable|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'stock' => 'required|integer',
        ]);
        // 画像ファイルのバリデーションは先に行う
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif',
            'sub_imgs.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|max:300',
        ]);


        if ($request->hasFile('img')) {
            // dd($request->file('img'));
            $path = $request->file('img');
            $image = $path->storeAs('items', $path->getClientOriginalName(), 'public');
            $itemData['img'] = $image; // ← $image を代入する
        }

        // 保存方法処理
        if ($request['is_cold'] == 'refrigerated') { // 冷蔵の時
            $itemData['is_cold'] = 1;
        } else if ($request['is_cold'] == 'frozen') { // 冷凍の時
            $itemData['is_frozen'] = 1;
        }
        $item = Item::create($itemData);

        // table: item_nutrition_facts
        $nutritionData = $request->validate([
            'energy' => 'nullable|integer|min:0',
            'protein' => 'nullable|numeric|min:0',
            'fat' => 'nullable|numeric|min:0',
            'carb' => 'nullable|numeric|min:0',
            'fiber' => 'nullable|numeric|min:0',
            'salt_eqv' => 'nullable|numeric|min:0',
        ]);

        $nutritionData['item_id'] = $item->id;
        ItemNutritionFact::create($nutritionData);


        // アレルギー
        // table: item_allergies
        $allergyIds = $request->validate([
            'allergies.*' => 'nullable|integer|exists:allergies,id',
        ]);
        if (!empty($allergyIds)) {
            foreach ($allergyIds['allergies'] as $allergy_id) {
                ItemAllergy::create([
                    'item_id' => $item->id,
                    'allergy_id' => $allergy_id,
                ]);
            }
        }
        // サブ画像
        if ($request->hasFile('sub_imgs')) {
            foreach ($request->file('sub_imgs') as $subImgFile) {
                $path = $subImgFile->store('items', 'public');
                ItemPicture::create([
                    'item_id' => $item->id,
                    'img' => $path,
                ]);
            }
        }

        $request->session()->flash('message', '保存しました');
        return redirect()->route('item.index');
    }

    public function edit(Item $item)
    {
        $item_nutrition_facts = $item->nutritionFacts;
        $item_allergies = $item->itemAllergies()->pluck('allergy_id')->toArray();
        $categories = Category::all();
        $allergy_list = Allergy::all();
        return view('admin.item_edit', compact(
            'item',
            'item_nutrition_facts',
            'item_allergies',
            'categories',
            'allergy_list'
        ));
    }

    public function update(Request $request, Item $item)
    {
        //table: item, item_nutrition_facts(栄養), item_picture(サブ写真), item_allergies,

        // 商品データ
        // table: Items
        $itemData = $request->validate([
            'name' => 'required|max:30',
            'price' => 'required|integer',
            'content' => 'nullable|string|max:255',
            // 'img' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'stock' => 'required|integer',
        ]);

        // 保存方法処理
        if ($request['is_cold'] == 'refrigerated') { // 冷蔵の時
            $itemData['is_cold'] = 1;
        } else if ($request['is_cold'] == 'frozen') { // 冷凍の時
            $itemData['is_frozen'] = 1;
        }
        $item->update($itemData);

        // table: item_nutrition_facts
        $nutritionData = $request->validate([
            'energy' => 'nullable|integer|min:0',
            'protein' => 'nullable|numeric|min:0',
            'fat' => 'nullable|numeric|min:0',
            'carb' => 'nullable|numeric|min:0',
            'fiber' => 'nullable|numeric|min:0',
            'salt_eqv' => 'nullable|numeric|min:0',
        ]);

        $nutritionData['item_id'] = $item->id;
        $item->nutritionFacts()->update($nutritionData);

        // アレルギー
        // table: item_allergies
        $allergyIds = $request->validate([
            'allergies.*' => 'nullable|integer|exists:allergies,id',
        ]);
        $allergy_ids = $item->itemAllergies()->pluck('id')->toArray();
        $form_allergy_ids = array_filter($allergyIds['allergies'] ?? []);
        if (!empty($allergyIds)) {
            foreach ($allergyIds['allergies'] as $index => $allergy_id) {
                $id = $form_allergy_ids[$index] ?? null;

                if ($id) {
                    $allergy = ItemAllergy::find($id);
                    if ($allergy) {
                        $allergy->update([
                            'item_id' => $item->id,
                            'allergy_id' => $allergy_id,
                        ]);
                    }
                } else {
                    ItemAllergy::create([
                        'item_id' => $item->id,
                        'allergy_id' => $allergy_id,
                    ]);
                }
            }
        }
        $allergy_delete_ids = array_diff($allergy_ids, $form_allergy_ids);
        if (!empty($allergy_delete_ids)) {
            $item->itemAllergies()->whereIn('id', $allergy_delete_ids)->delete();
        }

        // サブ画像
        $subImgs = $request->validate([
            'sub_imgs.*' => 'nullable|max:300',
        ]);
        $form_sub_img = array_filter($subImgs['sub_imgs'] ?? []);
        if (!empty($form_sub_img)) {
            $sub_img_ids = $item->itemPictures()->pluck('id')->toArray();
            foreach ($subImgs['sub_imgs'] as $img) {
                if (!is_null($img)) {
                    ItemPicture::create([
                        'item_id' => $item->id,
                        'img' => $img,
                    ]);
                }
            }
            $item->itemPictures()->whereIn('id', $sub_img_ids)->delete();
        }


        $request->session()->flash('message', '更新しました');
        return redirect()->route('item.index');
    }
}
