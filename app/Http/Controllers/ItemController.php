<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Allergy;
use App\Models\ItemNutritionFact;
use App\Models\ItemAllergy;
use App\Models\ItemPicture;



class ItemController extends Controller
{
    public function create()
    {
        $allergy_list = Allergy::all();
        return view('admin.items_create', compact('allergy_list'));
    }


    // 商品一覧表示
    public function index()
    {
        $item_list = Item::all();
        return view('user.items', compact('item_list'));
    }

    // 商品詳細表示
    public function show($id)
    {
        $item = Item::with([
            'categories',
            'itemPictures',
            'itemAllergies.Allergies',
            'nutritionFacts'
        ])->findOrFail($id);

        return view('user.item_detail', compact('item'));
    }


    public function store(Request $request)
    {
        //table: item, item_nutrition_facts(栄養), item_picture(サブ写真), item_allergies,


        // 商品データ
        // table: Items
        $itemData = $request->validate([
            'name' => 'required|max:30',
            'price' => 'required|integer',
            'content' => 'nullable|string|max:255',
            'img' => 'required|string',
            'category_id' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        // 保存方法処理
        if ($request['is_cold'] == 'refrigerated') { // 冷蔵の時
            $itemData['is_cold'] = 1;
        } else { // 冷凍の時
            $itemData['is_frozen'] = 1;
        }
        $item = Item::create($itemData);

        // table: item_nutrition_facts
        $nutritionData = $request->validate([
            'energy' => 'required|integer',
            'protein' => 'required|integer',
            'fat' => 'required|integer',
            'carb' => 'required|integer',
            'fiber' => 'required|integer',
            'salt_eqv' => 'required|integer',
        ]);

        $nutritionData['item_id'] = $item->id;
        ItemNutritionFact::create($nutritionData);


        // アレルギー
        // table: item_allergies
        $allergyIds = [];
        foreach ($allergyIds as $allergy_id) {
            ItemAllergy::create([
                'item_id' => $item->id,
                'allergy_id' => $allergy_id,
            ]);
        }

        // サブ画像
        $subImgs = $request->input('sub_imgs', []);
        foreach ($subImgs as $img) {
            $create = ItemPicture::create([
                'item_id' => $item->id,
                'img' => $img,
            ]);
        }




        // return redirect()->route('item.index')->with('message', '商品を登録しました');
        return;
    }
}
