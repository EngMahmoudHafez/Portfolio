<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\ImageService;

class SettingController extends Controller
{
    public function __construct(protected ImageService $imageService) {}

    public function index(): View
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            if ($request->hasFile($key)) {
                $oldValue = Setting::get($key);
                $value = $this->imageService->replace($oldValue, $request->file($key), 'settings');
            }
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
