<?php

namespace App\Http\Controllers;

use App\Helpers\imageHelper;
use App\Models\Application;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $application = Application::findOrFail(1);
        $province = Province::all();

        return view('dashboard.settings.applications.index', [
            'title'         => 'Application Setting',
            'application'   => $application,
            'province'      => $province,
        ]);
    }

    public function update(Request $request, Application $application)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'fonnte_key' => 'required',
            'order_no' => 'required|numeric',
            'ticket_no' => 'required|numeric',
            'logo' => 'image|mimes:jpg,jpeg,png,bmp,webp|max:2048',
        ]);

        if ($request->file('logo')) {
            if ($request->oldLogo) {
                Storage::delete($request->oldLogo);
            }
            $validatedData['logo'] = imageHelper::cropLogo($request->file('logo'), 'logo');
        }

        $validatedData['facebook_link'] = $request->facebook_link;
        $validatedData['x_link'] = $request->x_link;
        $validatedData['youtube_link'] = $request->youtube_link;
        $validatedData['instagram_link'] = $request->instagram_link;
        $validatedData['github_link'] = $request->github_link;
        $validatedData['updated_by'] = Auth::user()->id;

        Application::where('id', $application->id)->update($validatedData);

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'message' => 'Application Setting Update Successfully!',
            ]);
    }
}
