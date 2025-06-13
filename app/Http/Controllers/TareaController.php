<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Estado;
use App\Models\Tarea;
use App\Models\EmpTarea;
use App\Constantes\Mensajes;

class TareaController extends Controller
{
    private $apiBase;

    public function __construct()
    {
        $this->apiBase = config('app.url') . '/api';
        Http::timeout(5);
    }

    public function index()
    {
        try {
            $tareas = Tarea::with('estados')->get();
            $estados = Estado::all();
            return view('Perfil_Produccion.nueva_tarea', compact('tareas', 'estados'));
        } catch (\Exception $e) {
            return back()->with('error', Mensajes::ERROR_SERVER);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validar datos
            $request->validate([
                'tar_nombre' => 'required|string|max:50',
                'tar_descripcion' => 'required|string|max:200',
            ]);

            try {
                Tarea::create([
                    'tar_nombre' => $request->tar_nombre,
                    'tar_descripcion' => $request->tar_descripcion,
                    'tar_estado' => 1
                ]);
            } catch (\Exception $e) {
                return back()->with('error', 'Ocurrió un problema al crear la tarea.');
            }

            return redirect()->route('pro_tareas')->with('success', 'Tarea creada exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', Mensajes::ERROR_SERVER);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar datos
            $request->validate([
                'tar_nombre' => 'string|max:50',
                'tar_descripcion' => 'string|max:200',
                'tar_estado' => 'numeric'
            ]);

            // Buscar la tarea a actualizar
            $tarea = Tarea::findOrFail($id);

            // Actualizar los campos
            $tarea->update([
                'tar_nombre' => $request->tar_nombre,
                'tar_descripcion' => $request->tar_descripcion,
                'tar_estado' => $request->tar_estado
            ]);

            return redirect()->back();
        } catch (\Exception $e) {
            return back()->with('error', Mensajes::ERROR_SERVER);
        }
    }

    public function tareasAsignadas()
    {
        try {
            $userId = Auth::user()->num_doc;

            // Consulta las tareas relacionadas al usuario autenticado
            $tareasAsignadas = Tarea::whereHas('empleados', function ($query) use ($userId) {
                $query->where('empleados_num_doc', $userId); // Filtra por el usuario autenticado
            })
            ->with(['empleados' => function($query) use ($userId) {
                $query->where('empleados_num_doc', $userId);
            }])
            ->get();

            $estados = Estado::all();

            return view('Perfil-Operario.tareasAsignadas', compact('tareasAsignadas', 'estados'));
        } catch (\Exception $e) {
            return back()->with('error', Mensajes::ERROR_SERVER);
        }
    }


    public function editarEstado($id_tarea, $id_empleado_tarea)
    {
        try {
        // Cargar la tarea y empleado correspondiente
        $tarea = Tarea::findOrFail($id_tarea);
        $empleadoTarea = EmpTarea::findOrFail($id_empleado_tarea);
        $estados = Estado::whereIn('id_estados', [3, 4])->get();

        return view('Perfil-Operario.editarEstado', compact('tarea', 'empleadoTarea', 'estados'));
        } catch (\Exception $e) {
            return back()->with('error', Mensajes::ERROR_SERVER);
        }
    }

    public function actualizarEstado(Request $request, $id_tarea, $id_empleado_tarea)
    {
        try {
            $request->validate([
                'estadoTarea' => 'required|numeric',
            ]);

            // Actualizar el estado de la tarea para el empleado
            $empleadoTarea = EmpTarea::findOrFail($id_empleado_tarea);
            $empleadoTarea->emp_tar_estado_tarea = $request->estadoTarea;
            $empleadoTarea->save();

            return redirect()->route('tarea.editar', ['id_tarea' => $id_tarea, 'id_empleado_tarea' => $id_empleado_tarea])->with('success', 'Estado actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', Mensajes::ERROR_SERVER);
        }
    }
}
