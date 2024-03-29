<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\FormController;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        $this->authorize('auth_profile_edit');

        // Pretpostavljam da imate metodu koja vam vraća ID korisnika i ID njegovog accounta
        $userId = encrypt(auth()->user()->id);
        $accountId = encrypt(auth()->user()->account_id);

        // Pretpostavimo da imate formu naziva 'Edit Admin Profile'
        $editProfileFormRequest = new Request([
            'recordID' => $userId,
            'formName' => encrypt('Edit Admin Profile'),
        ]);
        $editProfileForm = (new FormController)->loadMyForm($editProfileFormRequest);

        // Pretpostavimo da imate formu naziva 'Change password'
        $changePasswordFormRequest = new Request([
            'recordID' => $accountId,
            'formName' => encrypt('Change password'),
        ]);
        $changePasswordForm = (new FormController)->loadMyForm($changePasswordFormRequest);

        // Prikazivanje view-a sa formama
        return view('profile.show', [
            'editProfileForm' => $editProfileForm,
            'changePasswordForm' => $changePasswordForm
        ]);
    }
}