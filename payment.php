<?php
function processPayment($payment_method, $amount, $token) {
    if ($payment_method == "khalti") {
        $url = "https://khalti.com/api/v2/payment/verify/";
        $data = ['token' => $token, 'amount' => $amount];
        $headers = ['Authorization: Key YOUR_KHALTI_SECRET_KEY'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $status_code == 200;
    } else if ($payment_method == "esewa") {
        // eSewa payment verification code here
        return true;
    }
    return false;
}
?>
