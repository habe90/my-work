<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\FormController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Encrypt;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        $this->authorize('auth_profile_edit');

        // ID trenutno prijavljenog korisnika
        $userId = encrypt(Auth::user()->id);
        $accountId = encrypt(Auth::user()->account_id); // Ovo pretpostavlja da 'account_id' postoji u User modelu

        // Učitavanje forme za uređivanje profila
        $editProfileFormRequest = new Request([
            'recordID' => $userId,
            'formName' => encrypt('Edit Admin Profile'),
        ]);
        $editProfileForm = app(FormController::class)->loadMyForm($editProfileFormRequest);

        // Učitavanje forme za promjenu lozinke
        $changePasswordFormRequest = new Request([
            'recordID' => $accountId,
            'formName' => encrypt('Change password'),
        ]);
        $changePasswordForm = app(FormController::class)->loadMyForm($changePasswordFormRequest);

        // Prikazivanje view-a sa formama
        return view('profile.show', compact('editProfileForm', 'changePasswordForm'));
    }
}
