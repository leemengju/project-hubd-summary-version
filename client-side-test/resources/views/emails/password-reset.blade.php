<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <title>密碼重設驗證碼</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        .code {
            font-size: 24px;
            font-weight: bold;
            color: rgb(255, 48, 48) !important;
            background: #ffffff !important;
            border: 2px solid #ff0000 !important;
            padding: 10px;
            display: inline-block;
            margin: 10px 0;
            border-radius: 5px;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        img {
            max-width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>❤️364HUBD❤️</h1>
        <h2>密碼重設驗證碼</h2>
        <p>您好，</p>
        <p>您的驗證碼如下：</p>
        <div class="code">{{ $code }}</div>
        <p>請在 5 分鐘內輸入完成驗證。</p>
        <p>如果您沒有請求密碼重設，請忽略此郵件。</p>
        <br>
        <p style="font-size: 12px; color: #666;">此為系統自動發送，請勿回覆。</p>
    </div>
</body>

</html>
