<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getAppName()
    {

        $path = base_path('config/app.php');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'name=' . config('app.name'),
                'name=' . 'Sunucode',
                file_get_contents($path)
            ));
        }
        $name = config('app.name');

        return response()->json($name);
    }

    public function getAppVars()
    {
        $data = [];
        $data['name'] = config('app.name');
        $data['logo'] = config('app.logo');
        $data['icon'] = config('app.icon');

        return response()->json($data);
    }

    public function changeVars(Request $request)
    {
        $path = base_path('.env');

        if (isset($request->appname)) {
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    'APP_NAME=' . config('app.name'),
                    'APP_NAME=' . $request->appname,
                    file_get_contents($path)
                ));
            }
        }

        if ($request->hasFile('logo')) {
            $imageName = 'logo.png';

            $request->logo->storeAs('public/images', $imageName);
        }

        if ($request->hasFile('icon')) {
            $imageName = 'icon.png';

            $request->icon->storeAs('public/images', $imageName);
        }

        return $this->getAppVars();
    }
}
