namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class SetGuardSession
{
    public function handle($request, Closure $next, $guard = 'web')
    {
        // Set session cookie dynamically based on guard
        $sessionName = $guard . '_session';
        config(['session.cookie' => env('SESSION_COOKIE_' . strtoupper($guard), Str::slug(env('APP_NAME', 'laravel'), '_').'_session')]);

        return $next($request);
    }
}