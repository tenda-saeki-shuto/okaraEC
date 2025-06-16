

<div class="p-4">
    <h2 class="text-xl font-bold mb-4">注文履歴の詳細</h2>

    <div class="mb-4">
        <p class="font-semibold">注文番号：</p>
        <p class="ml-4">{{ $order->order_code }}</p>
    </div>

     <div class="mb-4">
        <p class="font-semibold">支払い方法：</p>
        <p class="ml-4">{{ $order->payment }}</p>
    </div>
     <div class="mb-4">
        <p class="font-semibold">お届け先：</p>
        <p class="ml-4">{{ $order->prefecture }}{{ $order->address }}</p>
    </div>
     <div class="mb-4">
        <p class="font-semibold">注文内容：</p>
        <p class="ml-4">{{ $order->postal_code }}</p>
    </div>
    
    <div class="mt-6">
    <a href="{{ route('orders') }}" 
       class="inline-block bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">
        戻る
    </a>
</div>
    

</div>
