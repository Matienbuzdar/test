<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\Razorpay\RazorpayRequest;
use Carbon\Carbon;
use DB;

class RazorpayPaymentController extends Controller
{
    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function store(RazorpayRequest $request)
    {
       $users = User::with('post')->get();     
       $input = $request->all();
       $order = $this->api->order->create(array('receipt' => '123', 'amount' => $request->amount*100, 'currency' => 'USD', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
      if(!$order){
        abort(404);
      }

          session()->put('data',$order);
            return redirect('/');
           
      

       
       
          

    }

    public function paymentCallback(Request $request)
    {
         $api = new Api('rzp_live_S1c6FeCd9ihl6l','H8EUFxa4B7JaiRxTXUB7CfdP');
         $payment = $api->payment->fetch(request('razorpay_payment_id'));

        if ($payment->status == 'captured') {
            // Payment successful
            // Add your logic here
            return 'Payment successful';
        } else {
            // Payment failed
            // Add your logic here
            return 'Payment failed';
        }
    }
}
