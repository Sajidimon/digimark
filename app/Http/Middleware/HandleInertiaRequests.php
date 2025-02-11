<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
           'auth'=> fn()=> Auth::check() ? [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role,
           ] : null,
            'cartLength' => session('cart') ? count(session('cart')) : 0,
            'pages'=>Page::all(),
            'categories'=>Category::all(),
            'products'=>Product::all(),
            'services'=>Service::all(),
            'settingsData' => Setting::all(),
        ]);
    }
}
