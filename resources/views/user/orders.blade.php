

<h2>注文履歴</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>注文日</th>
            <th>注文番号</th>
            <th>合計金額</th>
            <th>定期購入</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders_list as $order)
        <tr class="hover:bg-gray-100 cursor-pointer" onclick="window.location='{{ route('orders.show', ['order' => $order->id]) }}'">
                <td>
                    <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="text-blue-600 underline">
                        {{ \Carbon\Carbon::parse($order->dateTime)->format('Y年m月d日') }}
                    </a>
                </td>
                <td>
                    {{ $order->order_code }}
                </td>
                <td>
                    {{ $order->total_price }}円
                </td>
                <td>
                    {{ $order->is_regular ? 'はい' : 'いいえ' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



