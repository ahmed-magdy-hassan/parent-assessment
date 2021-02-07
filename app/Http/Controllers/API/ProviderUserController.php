<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\DataProviders\{
    DataProviderX,
    DataProviderY,
    DataProviderZ
};
use App\Http\Controllers\Controller;

class ProviderUserController extends Controller
{
    public function index(Request $request)
    {
        $users = collect();

        collect($this->providers())
            ->reject(fn ($providerClass, $providerName) => !empty($request->get('provider')) && $request->get('provider') != $providerName)
            ->map(function ($provider) use (&$users, $request) {

                $providerUsers = $provider
                    ->jsonParser()
                    ->filterByStatus($request->get('status'))
                    ->filterByCurrency($request->get('currency'))
                    ->filterByAmount('>=', $request->get('balanceMin'))
                    ->filterByAmount('<=', $request->get('balanceMax'))
                    ->get();

                $users = $users->merge($providerUsers);
            });

        return response()->json([
            'users' => $users
        ]);
    }

    protected function providers()
    {
        return collect([
            "DataProviderX" => new DataProviderX,
            "DataProviderY" => new DataProviderY
        ]);
    }
}
