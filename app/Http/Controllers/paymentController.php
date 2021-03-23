<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MidtransController;
use PhpParser\Node\Expr\New_;

class paymentController extends Controller
{
    public function payment()
    {
        $midtrans = new MidtransController;
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'Dian',
                'last_name' => 'Sulistyarini',
                'email' => 'dian.pra@example.com',
                'phone' => '08111222333',
            ),
        );
        $token = $midtrans->getSnapToken2($params);
        // echo $token;
        // return view('buttonPay')->with('token', $token);
        return view('buttonPay',  ['token' => $token]);
    }
}
