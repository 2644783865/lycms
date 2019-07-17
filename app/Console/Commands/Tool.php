<?php

namespace App\Console\Commands;

use App\Services\CmsBaseService;
use App\Services\CompanyService;
use Illuminate\Console\Command;
use Route;

class Tool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lycms:tool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '工具';

    public function handle(CompanyService $service)
    {

        var_dump($service->formCode);
        var_dump($service->case->formCode);
        return ;
        print_r($service->getSubCategories('案例')->toArray());
    }

    public function routes()
    {
        $routes = Route::getRoutes();
        $names = [];
        foreach ($routes as $route) {
            $name = $route->getName();
            if (substr($name, 0, 6) == 'admin.') {
                $names[] = $name;
            }
        }
        return $names;
    }
}