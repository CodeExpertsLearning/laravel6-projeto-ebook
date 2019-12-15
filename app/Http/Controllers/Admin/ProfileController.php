<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserProfileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if(!$user->profile()->count()) {
            $user->profile()->create();
        }

        return view('profile.index', compact('user'));
    }

    public function update(UserProfileRequest $request)
    {
        $userData = $request->get('user');
        $profileData = $request->get('profile');

        try{

            if($userData['password']) {

            	$validator = Validator::make($request->all(), [
            		'user.password' => ['min:8']
	            ], ['min' => 'Senha deve ter pelo menos :min caracteres!']);

            	if($validator->fails())
            		return redirect()->back()->withErrors($validator);

                $userData['password'] = bcrypt($userData['password']);
            } else {
                unset($userData['password']);
            }

            $user = auth()->user();

            if($request->hasFile('avatar')) {
	            Storage::disk('public')->delete($user->avatar);

	            $profileData['avatar'] = $request->file('avatar')->store('avatars', 'public');
            } else {
            	unset($profileData['avatar']);
            }

            $user->update($userData);

            $user->profile()->update($profileData);

            flash('Perfil atualizado com sucesso!')->success();
			return redirect()->route('profile.index');

        } catch(\Exception $e) {

            $message = 'Erro ao remover categoria!';

		    if(env('APP_DEBUG')) {
			    $message = $e->getMessage();
		    }

		    flash($message)->warning();
		    return redirect()->back();

        }
    }
}
