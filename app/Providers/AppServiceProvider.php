<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('ru_Ru');     //этот класс используется для работы с датой, эта строчка локализует весь вывод.
        Paginator::useBootstrapFive();  //устанавливаем пагинацию для bootstrap
    }
}
