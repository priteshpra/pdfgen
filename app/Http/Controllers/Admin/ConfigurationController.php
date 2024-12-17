<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Role;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use App\Models\Configuration;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConfigurationController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $conf = Configuration::where(['id' => 1])->first();
        $roles = Role::pluck('title', 'id');
        return view('admin.configur.edit', compact('conf', 'id'));
    }

    public function update(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'IosAppVersion' => 'required|string|max:255',
            'AndroidAppVersion' => 'required|string|max:255',
            'SupportEmail' => 'required|email',
        ]);

        // Update the authenticated user's profile
        $user = Configuration::findOrFail(1);
        $user->IosAppVersion = $request->IosAppVersion;
        $user->AndroidAppVersion = $request->AndroidAppVersion;
        $user->SupportEmail = $request->SupportEmail;
        $user->SMTPPORT = $request->SMTPPORT;
        $user->SMTPPASS = $request->SMTPPASS;
        $user->AndroidAppUrl = $request->AndroidAppUrl;
        $user->IOSAppUrl = $request->IOSAppUrl;
        $user->save();

        // Return response
        return redirect()->route('admin.configuration.edit', 1)->with(['status-success' => "Configuration updated successfully"]);
    }
}
