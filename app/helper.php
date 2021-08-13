<?php

    use App\Models\Cart;
    use Illuminate\Support\Facades\Cookie;

    function cart(){
        $oldCookie = Cookie::get('cookie_id');
        return Cart::with(['product'])->where('cookie_id', $oldCookie)->get();
    }


?>
