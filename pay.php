<?php 
$product_name = $_POST["product_name"];
$price = $_POST["product_price"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];


include 'src/instamojo.php';



try {
    $api = new Instamojo\Instamojo('d89259788f0bae8441794d8cc9a2f995', '549de66dc02dff5047dcdc4e9378f8d1','https://www.instamojo.com/api/1.1/payment-requests/');

    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://instamojo-otest.herokuapp.com/thankyou.php",
        "webhook" => "http://instamojo-otest.herokuapp.com/webhook.php"
        ));
    
    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
  ?>