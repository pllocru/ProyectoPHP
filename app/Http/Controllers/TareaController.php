<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::paginate(10);
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_progreso,completada,cancelada',
            'user_id' => 'required|exists:users,id',
            'cliente_id' => 'nullable|exists:clientes,id',
            'asignado_a' => 'nullable|exists:users,id',
            'anotaciones' => 'nullable|string',
        ]);

        Tarea::create($request->all());

        session()->flash('success', 'Tarea creada correctamente.');
        return redirect()->route('tareas.index');
    }

    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|nullable|string',
            'estado' => 'sometimes|in:pendiente,en_progreso,completada,cancelada',
            'user_id' => 'sometimes|exists:users,id',
            'cliente_id' => 'sometimes|nullable|exists:clientes,id',
            'asignado_a' => 'sometimes|nullable|exists:users,id',
            'anotaciones' => 'sometimes|nullable|string',
        ]);

        $tarea->update($request->all());

        session()->flash('success', 'Tarea actualizada correctamente.');
        return redirect()->route('tareas.index');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        session()->flash('success', 'Tarea eliminada correctamente.');
        return redirect()->route('tareas.index');
    }
}
