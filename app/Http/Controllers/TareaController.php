<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Provincia;
use Illuminate\Support\Facades\Storage;

class TareaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Administrador')) {
            // 🔹 Administradores ven todas las tareas
            $tareas = Tarea::paginate(10);
        } else {
            abort(403, 'No tienes permisos para ver todas las tareas.');
        }

        return view('tareas.index', compact('tareas'));
    }

    public function misTareas()
    {
        $user = auth()->user();

        if ($user->hasRole('Operario')) {
            // 🔹 Operarios solo ven sus tareas
            $tareas = Tarea::where('usuario_id', $user->id)->paginate(10);
        } else {
            abort(403, 'No tienes permisos para ver esta página.');
        }

        return view('tareas.index', compact('tareas'));
    }



    // Asegúrate de tener el modelo creado

    public function create()
    {
        $clientes = Cliente::all();
        $operarios = User::where('role', 'Operario')->get();
        $provincias = Provincia::all(); // Modelo que apunta a tbl_provincias

        return view('tareas.create', compact('clientes', 'operarios', 'provincias'));
    }



    public function edit(Tarea $tarea)
    {
        $provincias = Provincia::all();

        return view('tareas.edit', compact('tarea', 'provincias'));
    }


    public function show($id)
    {
        $tarea = Tarea::findOrFail($id);

        $existeResumen = $tarea->fichero_resumen
            ? Storage::disk('private')->exists($tarea->fichero_resumen)
            : false;

        return view('tareas.show', compact('tarea', 'existeResumen'));
    }


    public function store(Request $request)
    {


        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'usuario_id' => 'required|exists:users,id',
            'persona_contacto' => 'nullable|string|max:255',
            'telefono_contacto' => 'nullable|string|max:20',
            'correo_contacto' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'poblacion' => 'nullable|string|max:100',
            'codigo_postal' => 'nullable|string|max:10',
            'provincia' => 'required|exists:tbl_provincias,cod',
            'descripcion' => 'required|string',
            'estado' => 'required|in:P,R,C',
            'fecha_creacion' => 'nullable|date',
            'anotaciones_anteriores' => 'nullable|string',
        ]);

        Tarea::create($validated);

        session()->flash('success', 'Tarea creada correctamente.');

        return redirect()->route('tareas.index');
    }


    public function storenueva(Request $request)
    {
        $validated = $request->validate([
            'persona_contacto' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:20',
            'correo_contacto' => 'required|email|max:255',
            'direccion' => 'required|string|max:255',
            'poblacion' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:10',
            'provincia' => 'required|exists:tbl_provincias,cod',
            'descripcion' => 'required|string',
        ]);

        $validated['usuario_id'] = null;
        $validated['estado'] = 'N';
        $validated['cliente_id'] = session('cliente_id'); // ✅ Añadimos el cliente de la sesión

        Tarea::create($validated);

        session()->flash('success', 'Tarea creada correctamente.');
        session()->forget('cliente_verificado');
        session()->forget('cliente_id');

        return redirect()->route('tareas.verificar');
    }



    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());

        session()->flash('success', 'Tarea actualizada correctamente.');
        return redirect()->route('tareas.index');
    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        session()->flash('success', 'Tarea eliminada correctamente.');
        return redirect()->route('tareas.index');
    }

    public function verificarCliente(Request $request)
    {
        $request->validate([
            'cif' => 'required|string',
            'email' => 'required|email'
        ]);

        $cliente = Cliente::where('cif', $request->cif)
            ->where('email', $request->email)
            ->first();

        if ($cliente) {
            session()->put('cliente_verificado', true);
            session()->put('cliente_id', $cliente->id);
            return redirect()->route('tareas.nueva');
        }

        return redirect()->route('tareas.verificar')->with('error', 'Cliente no encontrado o datos incorrectos.');
    }


    public function nueva()
    {
        if (!session('cliente_verificado')) {
            return redirect()->route('tareas.verificar')->with('error', 'Debes verificar un cliente antes de crear una tarea.');
        }

        $provincias = Provincia::all();

        return view('crear_tarea', compact('provincias'));
    }

    public function asignarOperario(Tarea $tarea)
    {
        $operarios = User::role('Operario')->get();

        return view('tareas.asignar_operario', compact('tarea', 'operarios'));
    }

    public function guardarOperario(Request $request, Tarea $tarea)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
        ]);

        $tarea->update([
            'usuario_id' => $request->usuario_id,
            'estado' => 'P',
        ]);

        return redirect()->route('tareas.index')->with('success', 'Operario asignado correctamente.');
    }

    public function realizar(Tarea $tarea)
    {
        return view('tareas.realizar_tarea', compact('tarea'));
    }

    public function guardarRealizada(Request $request, Tarea $tarea)
    {
        $request->validate([
            'fecha_realizacion' => 'required|date',
            'anotaciones_posteriores' => 'nullable|string',
            'fichero_resumen' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only(['fecha_realizacion', 'anotaciones_posteriores']);

        if ($request->hasFile('fichero_resumen')) {
            $archivo = $request->file('fichero_resumen')->store('resumenes', 'private');
            $data['fichero_resumen'] = $archivo;

        }


        $data['estado'] = 'C';
        $data['fecha_actualizacion'] = now();

        $tarea->update($data);

        return redirect()->route('tareas.misTareas')->with('success', 'Tarea realizada correctamente.');
    }

    public function descargarResumen(Tarea $tarea)
    {
        if (!$tarea->fichero_resumen || !Storage::disk('private')->exists($tarea->fichero_resumen)) {
            abort(404, 'El fichero no existe.');
        }

        return Storage::disk('private')->download(
            $tarea->fichero_resumen,
            'Resumen_Tarea_' . $tarea->id . '.pdf'
        );
    }

    public function delete(Tarea $tarea)
    {
        return view('tareas.delete', compact('tarea'));
    }

    






}
