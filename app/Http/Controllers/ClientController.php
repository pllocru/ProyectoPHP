<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pais;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('pais')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $paises = Pais::all();
        return view('clientes.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cif' => 'required|string|max:50|unique:clientes,cif',
            'name' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:100|unique:clientes,email',
            'cuenta_corriente' => 'required|string|max:34',
            'pais_id' => 'required|integer',
            'moneda' => 'required|string|max:10',
            'importe_cuota_mensual' => 'required|numeric|min:0',
        ]);

        Cliente::create($validated);

        session()->flash('success', 'Cliente creado correctamente.');

        return redirect()->route('clientes.index');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }



    public function edit(Cliente $cliente)
    {
        $paises = Pais::all();
        return view('clientes.edit', compact('cliente', 'paises'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'cif' => 'required|unique:clientes,cif,' . $cliente->id,
            'name' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'cuenta_corriente' => 'required|string|max:34',
            'pais_id' => 'required|exists:paises,id',
            'moneda' => 'required|string|size:3',
            'importe_cuota_mensual' => 'required|numeric|min:0',
        ]);

        $cliente->update($request->all());

        session()->flash('success', 'Cliente actualizado correctamente.');

        return redirect()->route('clientes.index');
    }


    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    public function delete(Cliente $cliente)
    {
        return view('clientes.delete', compact('cliente'));
    }

}
