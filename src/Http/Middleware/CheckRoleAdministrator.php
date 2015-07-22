<?php namespace webvolant\abslider\Http\Middleware;

use Closure;
use webvolant\abadmin\Models\User;
//use Illuminate\Contracts\Routing\Middleware;

class CheckRoleManager //implements Middleware
{
    public function handle($request, Closure $next)
    {
        if (\Auth::check())
        {
            $role = User::getStrRole(\Auth::user()->role);
            if ($role == config('config.roles')[2]){
                return $next($request);
            }
            else{
                $errors['alert_danger'] = "У вас не достаточно прав для просмотра адреса, на который вы пытались зайти, Вам нужно авторизоваться.";
                return \Redirect::route('administrator')->withErrors($errors);
            }
        }else{
            $errors['alert_warning'] = "Авторизуйтесь пожалуйста, чтобы просмотреть страницу.";
            return \Redirect::route('administrator')->withErrors($errors);
        }
    }

}
