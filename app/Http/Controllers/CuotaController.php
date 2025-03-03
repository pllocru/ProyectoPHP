<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\MiCorreo;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;




class CuotaController extends Controller
{
    public function index()
    {
        $cuotas = Cuota::with('cliente')->paginate(10);
        return view('cuotas.index', compact('cuotas'));
    }

    public function create()
    {
        $clientes = Cliente::all()->map(function ($cliente) {
            $tipoCambio = $this->obtenerTipoCambio($cliente->moneda);
            $cliente->importe_convertido = $tipoCambio ? round($cliente->importe_cuota_mensual / $tipoCambio, 2) : $cliente->importe_cuota_mensual;
            return $cliente;
        });

        return view('cuotas.create', compact('clientes'));
    }

    private function obtenerTipoCambio($moneda)
    {
        if ($moneda === 'EUR') {
            return 1;
        }

        $response = Http::get('https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/eur.json');

        if ($response->successful()) {
            $data = $response->json();
            return $data['eur'][strtolower($moneda)] ?? null;
        }

        return null;
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

        $cuota = Cuota::create($request->all());
        $cliente = $cuota->cliente;

        $data = [
            'nombre' => $cliente->name ?? 'Cliente Desconocido',
            'concepto' => $cuota->concepto,
            'importe' => number_format($cuota->importe, 2) . ' EUR',
            'fecha_emision' => $cuota->fecha_emision->format('d/m/Y'),
            'mensaje' => 'Se ha generado una nueva cuota para tu cuenta.',
        ];

        try {
            Mail::to($cliente->email)->send(new MiCorreo($data));
            session()->flash('success', 'Cuota creada correctamente y correo enviado.');
        } catch (\Exception $e) {
            session()->flash('error', 'Cuota creada pero no se pudo enviar el correo.');
        }

        return redirect()->route('cuotas.index');
    }

    public function show(Cuota $cuota)
    {
        return view('cuotas.show', compact('cuota'));
    }

    public function edit(Cuota $cuota)
    {
        $clientes = Cliente::all(); // Obtener todos los clientes disponibles
        return view('cuotas.edit', compact('cuota', 'clientes'));
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
        session()->flash('success', 'Cuota actualizada correctamente.');

        return redirect()->route('cuotas.index');
    }

    public function delete(Cuota $cuota)
    {
        return view('cuotas.delete', compact('cuota'));
    }


    public function destroy(Cuota $cuota)
    {
        $cuota->delete();
        session()->flash('success', 'Cuota eliminada correctamente.');

        return redirect()->route('cuotas.index');
    }

    public function descargarPDF(Cuota $cuota)
{
    $pdf = Pdf::loadView('cuotas.pdf', compact('cuota'));
    return $pdf->download('cuota_'.$cuota->id.'.pdf');
}


}
