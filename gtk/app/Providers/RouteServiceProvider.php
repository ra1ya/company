<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * المسار الرئيسي الذي يتم تحميله عند زيارة الموقع.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * حدد مسارات الويب الخاصة بالتطبيق.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
        $this->mapStudentsRoutes(); // إضافة هذه السطر لتحميل مسارات الطلاب
    }

    /**
     * حدد مسارات الويب الخاصة بالتطبيق.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * حدد مسارات API الخاصة بالتطبيق.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * حدد مسارات الطلاب الخاصة بالتطبيق.
     *
     * @return void
     */
    protected function mapStudentsRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/students-auth.php')); // مسارات الطلاب
    }
}
