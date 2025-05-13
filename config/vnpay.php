<?php

return [
    'vnp_TmnCode' => env('VNPAY_TMN_CODE', 'TESTTMNCODE'),
    'vnp_HashSecret' => env('VNPAY_HASH_SECRET', 'TESTHASHSECRET'),
    'vnp_Url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
    'vnp_ReturnUrl' => env('VNPAY_RETURN_URL', 'http://localhost:8000/payment/vnpay/return'),
];
