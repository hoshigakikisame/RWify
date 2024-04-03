<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserModel;
 
class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /**
         * @var UserModel $currentUser
         */
        $currentUser = $request->user();

        if (!$currentUser->getRole() != $role) {
            return abort(403, 'Access Denied');
        }
 
        return $next($request);
    }
 
}