<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::query()
            ->when($request->q, function ($query, $q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->whereShow(true)
            ->paginate();
       
        $context = compact('settings');
        return view('settings.index', $context);
    }

    //edit
    public function edit(Setting $setting)
    {
        $context = compact('setting');
        return view('settings.edit', $context);
    }

    //update
    public function update(Request $request, Setting $setting)
    {
        $validate = $request->validate([
            'value' => 'required',
        ]);

        $setting->update($validate);
        return to_route('settings.index')->with('success', 'Texto actualizado');
    }
}
