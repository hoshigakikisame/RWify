<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// app imports
use App\Models\UserModel;
 
class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        /**
         * @var UserModel $currentUser
         */
        $currentUser = Auth::user();

        if (!in_array($currentUser->getRole(), $role)) {
            return abort(403, 'Access Denied');
        }
 
        return $next($request);
    }
 
}