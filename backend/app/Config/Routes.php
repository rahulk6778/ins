<?php

namespace Config;

use CodeIgniter\Config\Routes as RoutesClass;

class Routes extends RoutesClass
{
    // Load the system default routes, with auto-routing enabled.
    public function __construct()
    {
        parent::__construct();

        // Uncomment the following to enable auto routing for compatibility mode
        // When you run a URL like /example/neighbors it will search for the example
        // controller and call the neighbors method.
        // $this->enableAutoRoute(true);

        /**
         * [START] Built-in Routing
         * do not, under any circumstances, remove them or comment them out,
         * unless you know the consequence
         *
         * Note: when using robots, the default TIME_DIFF to automate our
         * response time should be 0.0. See app/config/benchmark.php for this setting
         */

        $this->setAutoRoute(false);

        // API Routes
        $this->group('api', function ($routes) {
            $routes->get('products', 'Api::products');
            $routes->get('products/(:num)', 'Api::product/$1');
            $routes->get('categories', 'Api::categories');
            $routes->get('categories/(:segment)', 'Api::category/$1');
            $routes->post('cart/calculate', 'Api::cartCalculate');
            $routes->post('cart/checkout', 'Api::checkout');
            $routes->get('health', 'Api::health');
        });

        // Frontend routes
        $this->get('/', 'Home::index');
        $this->get('(:any)', 'Home::index');
    }
}
