<?php

use Illuminate\Http\Request;
use App\Http\Middleware\User;
use App\Http\Middleware\Admin;
use App\Http\Middleware\ApiAuthCheck;
use App\Http\Middleware\Authenticate;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckMaintenance;
use Illuminate\Auth\AuthenticationException;
use App\Http\Middleware\RevalidateBackHistory;
use Illuminate\Session\TokenMismatchException;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix(AppServiceProvider::ADMIN)
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(
            except: ['stripe/*']
        );

        $middleware->redirectGuestsTo(fn(Request $request) => route('login'));

        $middleware->alias([
            'guest' => RedirectIfAuthenticated::class,
            'auth' => Authenticate::class,
            'revalidate' => RevalidateBackHistory::class,
            'user' => User::class,
            'admin' => Admin::class,
            'check.maintenance' => CheckMaintenance::class,
            'api.auth.check' => ApiAuthCheck::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => 'Sorry, your session seems to have expired. Please login again.', 'data' => null]);
            } else if ($request->is(AppServiceProvider::ADMIN) || $request->is(AppServiceProvider::ADMIN . '/*')) {
                return redirect('admin')->withErrors(['warning' => 'Sorry, your session seems to have expired. Please login again.']);
            }
            return redirect('/')->withErrors(['warning' => 'Sorry, your session seems to have expired. Please login again.']);
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['status' => 404, 'message' => trans('app.Not_found'), 'result' => null], 404);
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson() && !$request->header('Authorization') !== "") {
                return response()->json(['status' => 401, 'message' => trans('auth.Token_invalid'), 'result' => null], 401);
            }
            if ($request->is('api/*')) {
                return response()->json(['status' => 404, 'message' => trans('app.Not_found'), 'result' => null], 404);
            }
            if ($request->is(AppServiceProvider::ADMIN) || $request->is(AppServiceProvider::ADMIN . '/*')) {
                return redirect()->guest(route('admin.login'));
            }
            return redirect()->guest(route('login'));
        });
    })
    ->create();
