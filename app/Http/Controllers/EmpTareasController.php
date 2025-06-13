<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmpTarea;
use App\Models\Produccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpTareasController extends Controller
{
    public function store(Request $request, $id)
    {
        $response = [];

        // Validación de entrada
        $validator = Validator::make($request->all(), [
            'empleados_num_doc' => 'required',
            'tarea_id_tarea' => 'required',
            'emp_tar_fecha_asignacion' => 'required',
            'emp_tar_fecha_entrega' => 'required',
            'emp_tar_estado_tarea' => 'required'
        ]);

        if ($validator->fails()) {
            $status = 400;
            $response = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => $status
            ];
        } else {
            // Verificar que la producción existe
            $produccion = Produccion::find($id);
            if (!$produccion) {
                $status = 404;
                $response = [
                    'message' => 'Producción no encontrada',
                    'status' => $status
                ];
            } else {
                // Creación del registro en la tabla emp_tarea
                $empTarea = EmpTarea::create([
                    'empleados_num_doc' => $request->empleados_num_doc,
                    'tarea_id_tarea' => $request->tarea_id_tarea,
                    'emp_tar_fecha_asignacion' => $request->emp_tar_fecha_asignacion,
                    'emp_tar_fecha_entrega' => $request->emp_tar_fecha_entrega,
                    'emp_tar_estado_tarea' => $request->emp_tar_estado_tarea,
                    'produccion_id_produccion' => $id
                ]);

                if (!$empTarea) {
                    $status = 500;
                    $response = [
                        'message' => 'Error al crear el registro de tarea para la producción',
                        'status' => $status
                    ];
                } else {
                    $status = 201;
                    $response = [
                        'message' => 'Tarea asociada con éxito a la producción',
                        'empTarea' => $empTarea,
                        'status' => $status
                    ];
                }
            }
        }

        return response()->json($response, $status);
    }
}
