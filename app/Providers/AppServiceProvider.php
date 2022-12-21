<?php

namespace App\Providers;

use App\Models\Cart\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\TraitsFolder\BladeDirectives;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $qty = 0;
        // $cart = Cart::where('user_id', Auth::id())->get();
        // foreach ($cart as $key) {
        //     // $qty = 0;
        //     $qty += $key->book_qty;
        // }
        //  view()->share('cart_count', $qty);

        //  Blade::directive('count_digit', function ($qty) {
        //      return Str::length($qty);
        //  });

        Blade::directive('currency', function ( $expression ) { return "Rp <?php echo number_format($expression,0,',','.'); ?>"; });
    }
}
