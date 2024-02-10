<?php

namespace App\Http\Middleware;

use App\Models\Role_permission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $publicPermission = ['/', 'home', 'login', 'register'];
        $uri = $request->path();
        $role_id = session('user_role') ?? '';
        if ($role_id){

            #get all role_id in Role_permission to this id 

            $rolePermissions = Role_permission::where('role_id', $role_id)->get();

            foreach ($rolePermissions as $rolePermission) 
            {
                #access to the function permission in my model Role_permission

                $permission = $rolePermission->permission;
                
                #check the permissions for any route

                if (count(explode('/', $uri)) > 2) {
                    
                    if (strstr($uri, $permission->permissions)) return $next($request);
                    
                } else {
                    
                    if ($uri === $permission->permissions) return $next($request);
                }
                
            }
            return abort(404);
        } else {
            if (in_array($uri, $publicPermission)) return $next($request);
            else return abort(404);
        }
    }
}
