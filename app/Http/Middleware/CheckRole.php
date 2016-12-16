<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next)
    {
        //get current route
        $action = $this->getRequiredRoleForRoute($request->route());
        $exRotue    =   explode('.' , $action['as']);
        $main       =   $exRotue[0];
        $permisson  =   $exRotue[1];

        // get Role permisson
        $role_id = $request->user()->role_id;
        $role = DB::table('roles as r')
                    ->select('r.id as rid','r.name as rname', 'r.display_name as rdname','pr.read','pr.write','pr.delete','p.name as pname','p.display_name as pdname','p.id as pid','p.route')
                    ->leftJoin('permisson_roles as pr','pr.role_id','=','r.id')
                    ->leftJoin('permissons as p','p.id','=','pr.permisson_id')
                    ->where('r.id',$role_id)->get();
        //check permisson
        foreach ($role as  $value) {
            // echo '<br>'. $value->route;
            if($main == $value->route){

                if($value->read == true && $permisson=='list')
                {
                     return $next($request);
                }
                if($value->write ==true && $permisson=='create')
                {
                     return $next($request);
                }
                if($value->delete ==true && $permisson=='delete')
                {
                     return $next($request);
                }
           }
        }

        return response([
                        'error' => [
                            'code' => 'INSUFFICIENT_ROLE',
                            'description' => 'You are not authorized to access this resource.'
                        ]
                    ], 401);

    }
    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return $actions;//isset($actions['roles']) ? $actions['roles'] : null;
    }
}
