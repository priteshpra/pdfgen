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
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $user = User::where(['id' => $id])->first();
        $roles = Role::pluck('title', 'id');
        return view('admin.profile.edit', compact('user', 'id'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|numeric|digits:10',
        ]);

        // Update the authenticated user's profile
        $user = User::findOrFail($id);
        $user->mobile_no = $request->mobile_no;
        $user->name = $request->name;
        $user->save();

        // Return response
        return redirect()->route('admin.profile.edit', $id)->with(['status-success' => "Profile updated successfully"]);
    }
}
