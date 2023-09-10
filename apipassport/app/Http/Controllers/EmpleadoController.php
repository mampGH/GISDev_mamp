<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmpleadoResource;
use App\Models\Empleado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::all();
        return response([ 'empleados' => EmpleadoResource::collection($empleados), 'message' => 'Exito.'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nombre' => 'required|max:50',
            'edad' => 'required',
            'puesto_de_trabajo' => 'required|max:50',
            'salario' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Error de validación']);
        }

        $empleado = Empleado::create($data);

        return response([ 'empleado' => new EmpleadoResource($empleado), 'message' => 'Registro de empleado fue creado.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return response($empleado, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $empleado->update([
            'nombre' => $request->nombre,
            'edad' => $request->edad,
            'puesto_de_trabajo' => $request->puesto_de_trabajo,
            'salario' => $request->salario]);
            
        return response(['message' => 'Información de empleado fue actualizada.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empleado = Empleado::where('id', $id)->delete();

        return response(['message' => 'Registro de empleado fue eliminado.'], 201);
    }
}
