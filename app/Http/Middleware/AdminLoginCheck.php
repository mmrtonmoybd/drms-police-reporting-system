<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminLoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_session = $request->session()->get('user');

        if ($user_session and isset($user_session['login']) and $user_session['login'] == true) {
            $user = User::where('id', $user_session['id'])->first();

            if ($user_session['password'] == $user->password) {
                //ACCESS AVAILABLE
            } else {
                $request->session()->pull('user');
                $request->session()->flash('error_msg', 'Your session expaired');

                return redirect('admin/login');
            }
        } else {
            $request->session()->flash('error_msg', 'You are not authorized');

            return redirect('admin/login');
        }

        return $next($request);
    }
}
