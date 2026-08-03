<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'nombre' => ['required', 'string', 'max:255'],
        'correo' => ['required', 'email', 'max:255', 'unique:contacto,correo'],
        'mensaje' => ['required', 'string', 'max:2000'],
        ];
    }
    public function messages(): array
    {
        return [
            'nombre.required' => 'Debe ingresar su nombre.',

            'correo.required' => 'Debe ingresar un correo.',
            'correo.email' => 'El correo no es válido.',
            'correo.unique' => 'Este correo ya fue registrado.',

            'mensaje.required' => 'Debe escribir un mensaje.',
        ];
    }
}
