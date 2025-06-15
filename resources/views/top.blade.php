<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>トップ</title>
    <style>
        /* ヘッダーのスライドショー */
        .slideshow {
            flex-grow: 1;
            position: relative;
            width: 60%;
            height: 70%;
            z-index: 1;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }
        .slide {
            position: absolute;
            left: auto;
            width: 100%;
            height: auto;
            opacity: 0;
            transition: opacity 1.5s ease-in-out, transform 1.5s ease-in-out;
            object-fit: cover;
            z-index: 0;
            transform: scale(1.05); /*要素サイズの拡大縮小*/

        }
        .slide.active {
            opacity: 1;
            z-index: 1;
            transform: scale(1);
        }
    </style>
</head>
{{-- < class="h-screen w-full"> --}}
    <!-- ヘッダー入れる -->
    @include('user.user_header')

    <!-- スライドショー -->
    <!-- <div class="w-full"> -->
        <div id="slideshow" class="slideshow mt-5">
            <img class="slide" src="/img/cookie.png" alt="" />
            <img class="slide" src="/img/dounut.png" alt="" />
            <img class="slide active" src="/img/mince.png" alt="" />
        </div>

    <!-- </div> -->

    <div class="flex flex-col w-full items-center">
        <!-- テキストコンテンツ -->
        <div class="container w-[60%] h-auto">

            <div class="my-10 border-b-8 border-dotted">
                <h2 class="text-2xl font-bold mb-4">「おから」は栄養価の宝庫！</h2>
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-x-20">
                <div>
                    <p class="mb-4">
                        お豆腐が作られる過程で生まれる<br>
                        「おから」は驚くほどの栄養が詰まっています！
                    </p>
                    <p class="mb-4">
                        低糖質で、食物繊維たっぷり。<br>
                        さらに、植物由来のたんぱく質やカルシウム、
                        そして女性にうれしい大豆イソフラボンも含まれています。
                    </p>
                    <p class="mb-10">
                        捨てられがちな「おから」は、まさに体にも地球にも優しい<span class="text-xl font-bold">知られざるスーパーフード！</span>
                    </p>
                </div>

                <img src="/img/okara_top.png" alt="おからの画像" class="pb-10 aspect-3/2 object-cover ml-4">
                </div>
            </div>


            <div class="my-10">
                <h2 class="text-2xl font-bold mb-4">～捨てられていた宝物が、あなたの食卓を豊かにする～</h2>
                <div>
                    <p class="mb-4">
                        スーパーフード「おから」<br>
                        実は、食用利用されているのは<span class="font-bold">"たった1%"</span>と言われています。<br>
                        残りの膨大な量が、実はひっそりと廃棄されているのです。
                    </p>
                    <p class="mb-4">
                        私たちは、この"もったいない"に光を当てたい。<br>
                        捨てられる運命にあった「おから」という原石に、私たちのアイディアと技術で新たな輝きを与え、食卓に笑顔と豊かな恵みをお届けします。
                    </p>
                    <p>
                        小さな一歩が、大きな変化を生む。<br>
                        「おから」から、新しい食の価値を創造していきます。
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- クーポン発行メッセージ --}}
    @if(session('coupon_register'))
        <div id="popup-message" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg z-50 transition-opacity duration-500" role="alert">
            <span class="block sm:inline">新規登録ありがとうございます<br>{{ session('coupon_register') }}</span>
        </div>
    @endif

</body>
    <script>
        // スライドショーの画像切り替え
        const images = document.querySelectorAll('.slide');
        let currentIndex = 0;
        const totalImages = images.length;
        setInterval(() => {
            // すべての画像の active を外す
            images.forEach(image => image.classList.remove('active'));

            // 現在の画像だけ active をつける
            images[currentIndex].classList.add('active');

            // 次の画像に進む（ループ）
            currentIndex = (currentIndex + 1) % totalImages;
            }, 3000); // 3秒ごとに切り替え


        //クーポン発行メッセージのポップアップ
                    // 2秒後にフェードアウト
        setTimeout(() => {
            const popup = document.getElementById('popup-message');
            if (popup) {
                popup.style.opacity = '0';
                setTimeout(() => popup.remove(), 500); // フェードアウト後に削除
            }
        }, 2000);
    </script>

</html>
