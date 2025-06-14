<x-layouts.app>
    <div class="container">
        <h2>💳 結帳頁面</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>商品名稱</th>
                    <th>數量</th>
                    <th>價格</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ number_format($item['price'], 0) }}</td>
                        <td>${{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                    </tr>
                    @php $total += $item['price'] * $item['quantity']; @endphp
                @endforeach
            </tbody>
        </table>

        <h4>總金額：${{ number_format($total, 0) }}</h4>

        <!-- 點擊按鈕後觸發 JS 去取得 Token -->
        <button class="btn btn-primary" id="pay-btn">確認付款</button>
    </div>

    <!-- ECPay SDK + axios + jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/node-forge@0.7.0/dist/forge.min.js"></script>
    <script src="https://ecpg.ecpay.com.tw/Scripts/sdk-1.0.0.js?t=20210121100116"></script>

    <script>
        document.getElementById('pay-btn').addEventListener('click', function() {
            axios.get('/ecpay/get-token')
                .then(function(response) {
                    if (response.data.success) {
                        const payToken = response.data.token;

                        ECPay.initialize('Stage', 1, function(errMsg) {
                            if (errMsg) {
                                alert('初始化錯誤: ' + errMsg);
                                return;
                            }

                            ECPay.createPayment(payToken, 'zh-TW', function(errMsg) {
                                if (errMsg) {
                                    alert('建立付款介面錯誤: ' + errMsg);
                                }
                            }, 'V2');
                        });

                    } else {
                        alert('取得 Token 失敗');
                    }
                })
                .catch(function(error) {
                    console.error(error);
                    alert('發生錯誤，無法取得付款 Token');
                });
        });
    </script>
</x-layouts.app>
