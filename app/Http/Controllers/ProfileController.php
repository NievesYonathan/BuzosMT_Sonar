<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\TipoDoc;
use App\Models\Estado;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

            $usuario = $request->user();
            $tiposDocumentos = TipoDoc::all();
            $estados = Estado::all();

            return view('profile.edit', compact('usuario', 'tiposDocumentos', 'estados'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            $usuario = $request->user();

            // Actualiza solo los campos del formulario
            $usuario->update([
                't_doc' => $request->t_doc,
                'num_doc' => $request->num_doc,
                'usu_nombres' => $request->usu_nombres,
                'usu_apellidos' => $request->usu_apellidos,
                'usu_fecha_nacimiento' => $request->usu_fecha_nacimiento,
                'usu_sexo' => $request->usu_sexo,
                'email' => $request->email,
                'usu_direccion' => $request->usu_direccion,
                'usu_telefono' => $request->usu_telefono,
            ]);

            return redirect()->route('profile.edit')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error de conexión con el servidor']);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
