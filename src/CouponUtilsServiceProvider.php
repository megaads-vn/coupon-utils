<?php 
 namespace Megaads\CouponUtils;


 use Illuminate\Support\ServiceProvider;

 class CouponUtilsServiceProvider extends ServiceProvider 
 {
    public function boot() 
    {
      $this->registerHelpers();
      $this->publishConfig();
    }

    public function register() 
    {
        
    }

    private function publishConfig() 
    {
      if (function_exists('config_path')) {
         $path = $this->getConfigPath();
         $this->publishes([$path => config_path('coupon-utils.php')], 'config');
     }
    }

    private function getConfigPath() {
        return __DIR__.'/../config/coupon-utils.php';
    }

    /**
     * Register helpers file
     */
    public function registerHelpers()
    {
        $file = __DIR__ . '/helpers.php';
        if (file_exists($file))
        {
            require_once $file;
        }
    }
 }