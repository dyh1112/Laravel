<!DOCTYPE html>
<html>
<head>
    <title>綠界付款測試</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/node-forge@0.7.0/dist/forge.min.js"></script>
    <script src="https://ecpg.ecpay.com.tw/Scripts/sdk-1.0.0.js?t=20210121100116"></script>
</head>
<body>
    <button id="pay-btn">前往付款</button>

    <script>
        let payToken = '';

        document.getElementById('pay-btn').addEventListener('click', function() {
            axios.get('/ecpay/get-token')
            .then(function(response) {
                if(response.data.success) {
                    payToken = response.data.token;
                    // 初始化綠界 SDK (Stage 測試環境)
                    ECPay.initialize('Stage', 1, function(errMsg) {
                        if(errMsg) {
                            alert('初始化錯誤: ' + errMsg);
                            return;
                        }
                        // 產生付款介面，語系使用 "zh-TW"
                        ECPay.createPayment(payToken, 'zh-TW', function(errMsg) {
                            if(errMsg) {
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
                alert('取得 Token 發生錯誤');
            });
        });
    </script>
</body>
</html>
