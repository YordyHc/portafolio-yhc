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
    Log::info('ENTRÓ A CONTACTO STORE');
    try {

        Log::info('ANTES DE CREAR CONTACTO');

        $contacto = Contacto::create($request->validated());

        Log::info('CONTACTO CREADO', [
            'id' => $contacto->id,
        ]);

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
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'exception' => get_class($e),
            'sql' => $e->getSql(),
        ], 500);
    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'exception' => get_class($e),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Contacto  $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contacto  $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contacto  $contacto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contacto  $contacto)
    {
        //
    }
}
