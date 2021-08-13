<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\shipping;
use App\Models\Division;
use App\Models\Order;
use App\Models\ProductAttribute;
use App\Models\Upazilas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe;
// Payap Payment Getway.
use Session;
use Redirect;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class CheckoutController extends Controller
{
    private $_api_context;
    function __construct()
    {
        $this->middleware('auth');
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    function checkout(){
        $country = Country::orderBy('name', 'asc')->get();
        $cartData = Cart::orderBy('id', 'asc')->get();
        $coupon = session('coupon');
        $discount = Coupon::where('coupon_code', $coupon)->first();
        session(['coupon' => '']);
        return view('Frontend.pages.checkout',[
            'countries' => $country,
            'cart' => $cartData,
            'coupons' => $discount
        ]);
    }

    function checkPost(Request $request){
        // different shipping jodi check mark hoy thaole checked value hobe are na hoy defult value 1 insert hobe.
        $diffShipping = $request->diffShipping ?? 1;
        $userId = Auth::id();
        if($request->payment == 'bank'){
            $billing = new billing;
            $billing->userId = $userId;
            $billing->fullName = $request->fullName;
            $billing->companyName = $request->companyName;
            $billing->phone = $request->phone;
            $billing->email = $request->email;
            $billing->address = $request->address;
            $billing->country = $request->country;
            $billing->state = $request->state;
            $billing->city = $request->city;
            $billing->upazilas = $request->upazilas;
            $billing->postCode = $request->postCode;
            $billing->note = $request->note;
            $billing->paymentMethod = $request->payment;
            $billing->diffShipping = $diffShipping;
            $billing->save();

            if($diffShipping == 2){
                $shipping = new shipping;
                $shipping->billingId = $billing->id;
                $shipping->fullName = $request->S_fullName;
                $shipping->companyName = $request->S_companyName;
                $shipping->phone = $request->S_phone;
                $shipping->email = $request->S_email;
                $shipping->address = $request->S_address;
                $shipping->country = $request->S_country;
                $shipping->state = $request->S_state;
                $shipping->city = $request->S_city;
                $shipping->upazilas = $request->S_upazilas;
                $shipping->postCode = $request->S_postCode;
                $shipping->save();
            }


        }elseif($request->payment == 'paypal'){

            $billing = new billing;
            $billing->userId = $userId;
            $billing->fullName = $request->fullName;
            $billing->companyName = $request->companyName;
            $billing->phone = $request->phone;
            $billing->email = $request->email;
            $billing->address = $request->address;
            $billing->country = $request->country;
            $billing->state = $request->state;
            $billing->city = $request->city;
            $billing->upazilas = $request->upazilas;
            $billing->postCode = $request->postCode;
            $billing->coupon = $request->coupon;
            $billing->total_amount = $request->total_amount;
            $billing->note = $request->note;
            $billing->paymentMethod = $request->payment;
            $billing->diffShipping = $diffShipping;
            $billing->save();

            if($diffShipping == 2){
                $shipping = new shipping;
                $shipping->billingId = $billing->id;
                $shipping->fullName = $request->S_fullName;
                $shipping->companyName = $request->S_companyName;
                $shipping->phone = $request->S_phone;
                $shipping->email = $request->S_email;
                $shipping->address = $request->S_address;
                $shipping->country = $request->S_country;
                $shipping->state = $request->S_state;
                $shipping->city = $request->S_city;
                $shipping->upazilas = $request->S_upazilas;
                $shipping->postCode = $request->S_postCode;
                $shipping->save();
            }

            // session(['billing_id' => $billing->id]);

            $oldCookie_id = $request->cookie('cookie_id');
            $carts = Cart::with(['Product','Color', 'Size'])->where('cookie_id', $oldCookie_id )->get();
            $total = 0;
            $i = 0;
            foreach($carts as $cart){
                // echo $cart->product_id;
                $price = ProductAttribute::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->first()->price;

                $order = new Order;
                $order->billing_id = $billing->id;
                $order->product_id = $cart->product_id;
                $order->user_id = $userId;
                $order->color_id = $cart->color_id;
                $order->size_id = $cart->size_id;
                $order->product_price = $price;
                $order->product_quantity = $cart->quantity;
                $order->save();

                $cart->delete();
                $total += $cart->quantity *   $price;

                $item_1[$i] = new Item();

                $item_1[$i]->setName($cart->product->title)
                    ->setCurrency('USD')
                    ->setQuantity($cart->quantity)
                    ->setPrice($price);
                $i++;
            }

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_list = new ItemList();
                $item_list->setItems($item_1);

                $amount = new Amount();
                $amount->setCurrency('USD')
                    ->setTotal($total);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Enter Your transaction description');

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(route('PayPalStatus'))
                    ->setCancelUrl(route('PayPalStatus'));

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));
                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        \Session::put('error','Connection timeout');
                        return "paywithpaypal";
                    } else {
                        \Session::put('error','Some error occur, sorry for inconvenient');
                        return "errorpaywithpaypal";
                    }
                }

                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                Session::put('paypal_payment_id', $payment->getId());

                if(isset($redirect_url)) {
                    return Redirect::away($redirect_url);
                }

                \Session::put('error','Unknown error occurred');

                return "paywithpaypal OK";

        }elseif($request->payment == 'card'){

            $billing = new billing;
            $billing->userId = $userId;
            $billing->fullName = $request->fullName;
            $billing->companyName = $request->companyName;
            $billing->phone = $request->phone;
            $billing->email = $request->email;
            $billing->address = $request->address;
            $billing->country = $request->country;
            $billing->state = $request->state;
            $billing->city = $request->city;
            $billing->upazilas = $request->upazilas;
            $billing->postCode = $request->postCode;
            $billing->coupon = $request->coupon;
            $billing->total_amount = $request->total_amount;
            $billing->note = $request->note;
            $billing->paymentMethod = $request->payment;
            $billing->diffShipping = $diffShipping;
            $billing->save();

            if($diffShipping == 2){
                $shipping = new shipping;
                $shipping->billingId = $billing->id;
                $shipping->fullName = $request->S_fullName;
                $shipping->companyName = $request->S_companyName;
                $shipping->phone = $request->S_phone;
                $shipping->email = $request->S_email;
                $shipping->address = $request->S_address;
                $shipping->country = $request->S_country;
                $shipping->state = $request->S_state;
                $shipping->city = $request->S_city;
                $shipping->upazilas = $request->S_upazilas;
                $shipping->postCode = $request->S_postCode;
                $shipping->save();
            }

            $oldCookie_id = $request->cookie('cookie_id');
            $carts = Cart::with(['Product','Color', 'Size'])->where('cookie_id', $oldCookie_id )->get();

            $total = 0;

            foreach($carts as $cart){
                $price = ProductAttribute::where('product_id', $cart->product_id )->where('color_id', $cart->color_id )->where('size_id', $cart->size_id )->first()->price;

                $order = new Order;
                $order->billing_id = $billing->id;
                $order->product_id = $cart->product_id;
                $order->user_id = Auth::id();
                $order->size_id = $cart->size_id;
                $order->color_id = $cart->color_id;
                $order->product_price = $price;
                $order->product_quantity = $cart->quantity;
                $order->save();
                $total += $cart->quantity * $price;
                $cart->delete();
            }

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge= Stripe\Charge::create ([
                "amount" => $total * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from ES WEB DEV 2001"
            ]);

            $billingId = billing::findOrFail($billing->id);
            $billingId->total_amount = $total;
            $billingId->paymentStatus	= 2;
            $billingId->save();

            $orders = Order::with('product')->where('billing_id', $billing->id)->get();
            foreach ($orders as $order) {
                $productQuantity = ProductAttribute::where('product_id', $order->product_id )->where('color_id', $order->color_id )->where('size_id', $order->size_id )->first();
                $productQuantity->decrement('quantity', $order->product_quantity);
                $productQuantity->save();
            }
            Mail::to([Auth::user()->email, 'rahmmed.bd24@gmail.com'])->send(new OrderShipped($orders));
            return redirect('/order-invoice');
        }elseif($request->payment == 'cash'){
            return 'cash';
        }else{
            return back()->with('payment', 'Please select Payment Method');
        }
    }

    public function PayPalStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return "Payment failed-1";
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            \Session::put('success','Payment success !!');

            $billing_id = session('billing_id');
            $orders = Order::with('product')->where('billing_id', $billing_id)->get();
            foreach ($orders as $order) {
                $productQuantity = ProductAttribute::where('product_id', $order->product_id )->where('color_id', $order->color_id )->where('size_id', $order->size_id )->first();
                $productQuantity->decrement('quantity', $order->product_quantity);
                $productQuantity->save();
            }
            Mail::to([Auth::user()->email, 'rahmmed.bd24@gmail.com'])->send(new OrderShipped($orders));
            return "Payment success and Mail send !!";
        }

        \Session::put('error','Payment failed !!');


		return "Payment failed !!";
    }

    function getState($stateId){
        $state = Division::where('country_id', $stateId)->orderBy('name', 'asc')->get();
        return response()->json($state);
    }

    function getCity($cityId){
        $city = City::where('division_id', $cityId)->orderBy('name', 'asc')->get();
        return response()->json($city);
    }

    function getUpazilas($upazilaId){
        $upazilas = Upazilas::where('district_id', $upazilaId)->orderBy('name', 'asc')->get();
        return response()->json($upazilas);
    }
}
