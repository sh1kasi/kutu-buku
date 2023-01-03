<?php

namespace App\Providers;

use App\Models\Cart\Cart;
use Illuminate\Support\Str;
use App\Models\Category\Category;
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

        $category = Category::get();
        view()->share('category', $category);


        Blade::directive('currency', function ( $expression ) { return "Rp <?php echo number_format($expression,0,',','.'); ?>"; });
    }
}
