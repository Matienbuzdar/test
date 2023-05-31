<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use App\Http\Requests\Razorpay\RazorpayRequest;

class RazorpayPaymentController extends Controller
{

    public function store(RazorpayRequest $request)

    {

        $input = $request->all();
        

        $api = new Api('api keys', 'your api keys');
        

        //$api = new Api($key_id, $secret);

          $order = $api->order->create(array('receipt' => '123', 'amount' => $request->amount*100, 'currency' => 'USD', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
          if($order){

              $postData = [];
              $postData['id'] = $order['id'];
              $postData['amount'] = $request->amount;
              $postData['currency'] = $order['currency'];
              $postData['receipt'] = $order['receipt'];
              $postData['status'] = $order['status'];
              $postData['notes'] = json_encode($order['notes']);
              session()->put('data',$postData);
              if(session()->has('data')){
                return redirect('/');
               }
          }

          abort(404);
       
          
  

        // if(count($input)  && !empty($input['razorpay_payment_id'])) {

        //     try {

        //         $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

        //     } catch (Exception $e) {

        //         return  $e->getMessage();

        //         Session::put('error',$e->getMessage());

        //         return redirect()->back();

        //     }

        // }

          

        // Session::put('success', 'Payment successful');

        // return redirect()->back();

    }

    public function resRazorpay(Request $request)
    {
        session()->flush('data');
        
        dd($request->all());
                // PHP SDK: https://github.com/razorpay/razorpay-php
        // use Razorpay\Api\Api;
        // $api = new Api("[YOUR_KEY_ID]", "[YOUR_KEY_SECRET]");

        // $api->utility->verifyWebhookSignature($webhookBody, $webhookSignature, $webhookSecret);
// $webhookBody should be raw webhook request body
    }
}
