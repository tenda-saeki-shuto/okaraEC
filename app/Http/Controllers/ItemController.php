<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Allergy;
use App\Models\ItemNutritionFact;
use App\Models\ItemAllergy;



class ItemController extends Controller
{
    public function create()
    {
        $allergy_list = Allergy::all(); 
        return view('admin.items_create', compact('allergy_list'));
    }

    // 
    public function show()
    { // 商品名、種類名、最終更新日、在庫
        $item_list = Item::all();
        return view('', compact('item_list'));
    }

    public function store(Request $request)
    {
        //table: item, item_nutrition_facts(栄養), item_picture(サブ写真), item_allergies,
        // 商品データ
        $itemData = $request->validate([
            'name' => 'required|max:30',
            'price' => 'required|integer',
            'content' => 'nullable|string|max:255',
            //'img' => 'required|string',
            'category_id' => 'required|integer',      
            'stock' => 'required|integer',                
        ]);
        // ここは変更
        $itemData['img']= 'sample.png';
        // モデルに送信
        $item = Item::create($itemData);

        // 商品の栄養
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


        // 商品のアレルギー
        // 複数個選択？
        // バリデーションはいらない
        $allergyIds = $request->input('allergies', []);
        foreach ($allergyIds as $allergy_id) {
            ItemAllergy::create([
                'item_id' => $item->id,
                'allergy_id' => $allergy_id,
            ]);
        }
        // itemAllergies::create($itemAllergiesData);

    //     // サブ画像
    //     $subImgs = $request->input('sub_imgs', []);
    //     foreach ($subImgs as $img) {
    //     ItemPicture::create([
    //         'item_id' => $item->id,
    //         'img' => $img,
    //     ]);
    // }

        //var_dump($item->name);



    // return redirect()->route('item.index')->with('message', '商品を登録しました');
    return;
    }
}
