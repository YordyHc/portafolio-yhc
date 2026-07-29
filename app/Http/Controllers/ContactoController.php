<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use App\Services\EmailService;
use App\Http\Requests\StoreContactoRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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
    public function store(StoreContactoRequest  $request, EmailService $emailService)
{
    try {

        $contacto = Contacto::create($request->validated());

        try {
            $emailService->enviarContacto($contacto);
        } catch (\Throwable $e) {

            Log::warning(
                'No fue posible enviar el correo de confirmación.',
                [
                    'contacto_id' => $contacto->id,
                    'error' => $e->getMessage(),
                ]
            );
        }

        return response()->json([
            'success' => true,
        ], 201);

    } catch (QueryException $e) {

        Log::error('Error de base de datos.', [
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'No fue posible registrar la información.',
        ], 500);

    } catch (\Throwable $e) {

        Log::critical('Error inesperado.', [
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Ha ocurrido un error interno.',
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
