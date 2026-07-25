<?php

namespace App\Http\Controllers;

use App\Models\contacto;
use Illuminate\Http\Request;
use App\Services\EmailService;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, EmailService $emailService)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|email|unique:contacto,correo',
        'mensaje' => 'required|string'
    ]);

    try {
        $contacto = Contacto::create($datos);

        $emailService->enviarContacto($contacto);

        return response()->json([
            'success' => true,
            'message' => 'Contacto registrado correctamente.',
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }

}

    /**
     * Display the specified resource.
     */
    public function show(contacto $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contacto $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contacto $contacto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contacto $contacto)
    {
        //
    }
}
