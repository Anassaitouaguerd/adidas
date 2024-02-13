<?php

namespace App\Console\Commands;

use App\Models\Permissions;
use App\Models\Role;
use App\Models\Role_permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class PermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:permission-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'générer les permission';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $allRoutes = Permissions::all();

        # delete all data in my database 

        foreach ($allRoutes as $route) {
            $route->delete();
        }

        # insert the new data

        $routes = Route::getRoutes();
        $already = [];
        foreach ($routes as $route) {
            $uri = $route->uri();

            # skip the routes supported by laravel

            if (strstr($uri, 'csrf')) continue;
            if (strstr($uri, '_')) continue;
            if (strstr($uri, 'api')) continue;

            # skipe the uri already existe 

            if (in_array($uri, $already)) continue;

            Permissions::create([
                'permissions' => $uri,
            ]);

            $already[] = $uri;
        }

        $modaleRoute = Permissions::all();
        $superAdminRole = Role::where('role', 'super admin')->first();
        $adminRole = Role::where('role', 'admin')->first();
        $clientRole = Role::where('role', 'client')->first();

        #Super admin permission 
        
        foreach ($modaleRoute as $route) {
            Role_permission::create([
                'role_id' => $superAdminRole->id,
                'permission_id' => $route->id,
            ]);
        }
        
        #admin permission 
        foreach ($modaleRoute as $route) {
            if (strstr($route->permissions, 'SuperAdmin')) continue;
            Role_permission::create([
                'role_id' => $adminRole->id,
                'permission_id' => $route->id,
            ]);
        }
        
        #client permission
        
        foreach ($modaleRoute as $route) {
            if (strstr($route->permissions, 'SuperAdmin')) continue;
            if (strstr($route->permissions, 'admin')) continue;
            Role_permission::create(
                [
                    'role_id' => $clientRole->id,
                    'permission_id' => $route->id,
                ]
            );
        }
    }
}
    