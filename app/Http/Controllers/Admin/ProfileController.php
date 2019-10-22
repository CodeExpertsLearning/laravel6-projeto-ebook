<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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

    public function update(Request $request)
    {
        $userData = $request->get('user');
        $profileData = $request->get('profile');

        try{

            if($userData['password']) {
                $userData['password'] = bcrypt($userData['password']);
            } else {
                unset($userData['password']);
            }

            $user = auth()->user();

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
