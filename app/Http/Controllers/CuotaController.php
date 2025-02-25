<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CuotaController extends Controller
{
    private function obtenerTipoCambio($moneda)
    {
        $response = Http::get('https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/eur.json');

        if ($response->successful()) {
            $data = $response->json();
            return $data['eur'][$moneda] ?? null;
        }

        return null;
    }
    public function index()
    {
        $cuotas = Cuota::with('cliente')->paginate(10); 
        return view('cuotas.index', compact('cuotas'));
    }


    public function create()
    {
        return view('cuotas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'concepto' => 'required|string|max:255',
            'fecha_emision' => 'required|date',
            'importe' => 'required|numeric|min:0',
            'moneda' => 'required|string|size:3',
            'pagada' => 'boolean',
            'fecha_pago' => 'nullable|date',
            'notas' => 'nullable|string'
        ]);

        Cuota::create($request->all());

        return redirect()->route('cuotas.index')->with('success', 'Cuota creada correctamente.');
    }

    public function show(Cuota $cuota)
    {
        return view('cuotas.show', compact('cuota'));
    }

    public function edit(Cuota $cuota)
    {
        return view('cuotas.edit', compact('cuota'));
    }

    public function update(Request $request, Cuota $cuota)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'concepto' => 'required|string|max:255',
            'fecha_emision' => 'required|date',
            'importe' => 'required|numeric|min:0',
            'moneda' => 'required|string|size:3',
            'pagada' => 'boolean',
            'fecha_pago' => 'nullable|date',
            'notas' => 'nullable|string'
        ]);

        $cuota->update($request->all());

        return redirect()->route('cuotas.index')->with('success', 'Cuota actualizada correctamente.');
    }

    public function destroy(Cuota $cuota)
    {
        $cuota->delete();
        return redirect()->route('cuotas.index')->with('success', 'Cuota eliminada correctamente.');
    }
}
