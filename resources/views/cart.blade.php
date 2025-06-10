<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">
    <title>カートの中身</title>
</head>
<body>
    <!-- ヘッダー入れる -->

    <div class="flex flex-col items-center mt-20 w-full">
        <h1 class="text-3xl font-bold mb-5">現在のカートの中</h1>
        <table>
            <thead>
                <tr class="bg-gray-200">
                    <th>商品名</th>
                    <th>単価</th>
                    <th>数量</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>おからパウダー</th>
                    <td class="text-center">1000円</td>
                    <td class="p-1">
                        <div class="flex">
                            <select name="item_amount" class="flex-1 m-1">
                                @for($i=1; $i<=10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <button class="px-5 bg-sky-500 rounded-2xl text-white font-black flex-1 delete-btn">削除</button>
                        </div>
                    </td>
                    <td class="text-center">1000円</td>
                </tr>
                <tr>
                    <th>おからパウダー</th>
                    <td class="text-center">1000円</td>
                    <td class="p-1">
                        <div class="flex">
                            <select name="item_amount" class="flex-1 m-1">
                                @for($i=1; $i<=10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <button class="px-5 bg-sky-500 rounded-2xl text-white font-black text-xl flex-1 delete-btn">削除</button>
                        </div>
                    </td>
                    <td class="text-center">1000円</td>
                </tr>
            </tbody>
            <tfoot class="font-bold">
                <tr>
                    <th scope="row" colspan="3" class="text-right">合計金額（税込）</th>
                    <td class="text-center">3000円</td>
                </tr>
            </tfoot>
        </table>
        <form action="">
            <button class="py-3 px-8 bg-sky-500 rounded-2xl text-white font-black text-xl mt-5">購入手続きへ</button>
        </form>
    </div>

    <script>
        // 削除ボタンを押した際の処理
        let delete_buttons = document.querySelectorAll(".delete-btn");
        console.log(delete_buttons);
        delete_buttons.forEach((delete_button) => {
            delete_button.addEventListener('click', function(){
                // カートの表からレコードごと消す(直近のtr要素を丸ごと消す)
                let tr = delete_button.closest("tr");
                tr.remove();
            });
        });
    </script>
</body>
</html>