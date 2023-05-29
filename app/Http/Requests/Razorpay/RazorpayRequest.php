<?php
namespace App\Http\Requests\Razorpay;
use App\Http\Requests\Request;

class RazorpayRequest extends Request
{
    public function rules()
    {
        return ['name'=>'required','amount'=>'required'];
    }
}