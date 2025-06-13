<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Seguridad;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {

        $user = $request->user();

        // Obtener el registro de seguridad
        $seguridad = Seguridad::where('usu_num_doc', $user->num_doc)->firstOrFail();

        // Validar
        $request->validateWithBag('updatePassword', [
            'current_password' => ['required'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Verificar que la contraseña actual coincida
        if (!Hash::check($request->current_password, $seguridad->seg_clave_hash)) {
            return back()->withErrors([
                'updatePassword.current_password' => 'La contraseña actual es incorrecta.',
            ]);
        }

        // Actualizar nueva contraseña
        $seguridad->update([
            'seg_clave_hash' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Contraseña actualizada correctamente');
    }
}
