<?php
return [
    'required' => ':attribute 不能為空。',

    'regex' => ':attribute 格式不正確。',

    'email' => ':attribute 必須是有效的電子郵件地址。',

    'min' => ['string' => ':attribute 必須至少 :min 個字元。',],

    'max' => ['string' => ':attribute 不能超過 :max 個字元。',],

    'digits' => ':attribute 必須是 :digits 位數字。',

    'digits_between' => ':attribute 格式不正確。',

    'integer' => ':attribute 必須是有效的數字。',

    'confirmed' => ':attribute 與確認欄位不相符。',

    'unique' => ':attribute 已被使用',




    // **自訂錯誤訊息**
    'custom' => [
        'name' => [
            'regex' => '使用者名稱格式不正確，請輸入中文。',
            'required' => '請輸入使用者名稱。',
            'max' => '使用者名稱最多只能有 100 個字元。',
        ],
        'phone' => [
            'required' => '請輸入手機號碼。',
            'digits' => '手機號碼必須是 10 位數字。',
            'regex' => '手機號碼格式不正確，請輸入 09 開頭的 10 碼數字。',
        ],
        'password' => [
            'required' => '請輸入密碼。',
            'min' => '密碼長度至少 6 位數。',
            'max' => '密碼長度最多 32 位數。',
        ],
        'year' => [
            'integer' => '請選擇有效的出生年份。',
            'min' => '請選擇有效的出生年份。',
            'max' => '請選擇有效的出生年份。',
        ],
        'month' => [
            'integer' => '請選擇有效的月份。',
            'min' => '請選擇有效的月份。',
            'max' => '請選擇有效的月份。',
        ],
        'day' => [
            'integer' => '請選擇有效的日期。',
            'min' => '請選擇有效的日期。',
            'max' => '請選擇有效的日期。',
        ],
        'email' => [
            'required' => '請輸入電子郵件地址。',
            'email' => '請輸入有效的電子郵件地址。',
            'exists' => '此電子郵件尚未註冊，請確認後再試。',
            'invalid' => '電子郵件格式不正確，請輸入有效的電子郵件地址。',
            'unique' => '此電子郵件已被註冊，請使用其他電子郵件。',
        ],

        'code' => [
            'numeric' => '驗證碼碼必須是數字。',
            'required' => '驗證碼不能為空。',
            'digits' => '驗證碼必須是 :digits 位數字。',
        ],
    ],


    // 自訂欄位名稱
    'attributes' => [
        'email' => '電子郵件',
        'password' => '密碼',
        'name' => '使用者名稱',
        'phone' => '手機號碼',
        'year' => '出生年份',
        'month' => '月份',
        'day' => '日期',
        'verification_code' => '驗證碼',
    ],


];
