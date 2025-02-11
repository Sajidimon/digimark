<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $settingsData = Setting::all();
        return Inertia::render('Admin/Settings', [
            'settingsData' => $settingsData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'HeaderLogo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:1024',
            'herobgimage' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:1024',
            'heading' => 'nullable|string',
            'SubHeading' => 'nullable|string',
            'ButtonLink' => 'nullable|string',
            'FooterLogo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:1024',
            'FooterDescription' => 'nullable|string',
            'Footerfb' => 'nullable|string',
            'Footeryt' => 'nullable|string',
            'Footerinsta' => 'nullable|string',
            'copyright' => 'nullable|string',
        ]);

        $settings = Setting::first();

        $headerlogopath = $settings->HeaderLogo ?? null;
        $herobgimagepath = $settings->herobgimage ?? null;
        $FooterLogopath = $settings->FooterLogo ?? null;

        if ($request->hasFile('HeaderLogo')) {
            $headerlogopath = $request->file('HeaderLogo')->storeAs('images', time() . '_' . $request->file('HeaderLogo')->getClientOriginalName(), 'public');
        }

        if ($request->hasFile('herobgimage')) {
            $herobgimagepath = $request->file('herobgimage')->storeAs('images', time() . '_' . $request->file('herobgimage')->getClientOriginalName(), 'public');
        }

        if ($request->hasFile('FooterLogo')) {
            $FooterLogopath = $request->file('FooterLogo')->storeAs('images', time() . '_' . $request->file('FooterLogo')->getClientOriginalName(), 'public');
        }

        if ($settings) {
            $settings->update([
                'HeaderLogo' => $headerlogopath,
                'herobgimage' => $herobgimagepath,
                'heading' => $request->input('heading'),
                'SubHeading' => $request->input('SubHeading'),
                'ButtonLink' => $request->input('ButtonLink'),
                'FooterLogo' => $FooterLogopath,
                'FooterDescription' => $request->input('FooterDescription'),
                'Footerfb' => $request->input('Footerfb'),
                'Footeryt' => $request->input('Footeryt'),
                'Footerinsta' => $request->input('Footerinsta'),
                'copyright' => $request->input('copyright'),
            ]);
        } else {
            Setting::create([
                'HeaderLogo' => $headerlogopath,
                'herobgimage' => $herobgimagepath,
                'heading' => $request->input('heading'),
                'SubHeading' => $request->input('SubHeading'),
                'ButtonLink' => $request->input('ButtonLink'),
                'FooterLogo' => $FooterLogopath,
                'FooterDescription' => $request->input('FooterDescription'),
                'Footerfb' => $request->input('Footerfb'),
                'Footeryt' => $request->input('Footeryt'),
                'Footerinsta' => $request->input('Footerinsta'),
                'copyright' => $request->input('copyright'),
            ]);
        }

        return redirect()->back();
    }
}
