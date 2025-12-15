<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLecturaRequest extends FormRequest
{
    function attributes(): array
    {
        return [
            'idtema'        => 'tema',
            'idtipo_tirada' => 'tipo de tirada',
            'pregunta'      => 'pregunta',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    function authorize(): bool
    {
        // Pongo true porque la seguridad ya la maneja el middleware 'auth' en las rutas
        return true;
    }

    function messages(): array
    {
        $required = 'Es obligatorio seleccionar un :attribute.';
        $exists   = 'El :attribute seleccionado no es válido.';
        $max      = 'La :attribute no puede superar los :max caracteres.';
        $string   = 'La :attribute debe ser texto.';

        return [
            'idtema.required'        => $required,
            'idtema.exists'          => $exists,
            'idtipo_tirada.required' => $required,
            'idtipo_tirada.exists'   => $exists,
            'pregunta.string'        => $string,
            'pregunta.max'           => $max,
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    function rules(): array
    {
        return [
            'idtema'        => 'required|exists:tema,id',
            'idtipo_tirada' => 'required|exists:tipo_tirada,id',
            'pregunta'      => 'nullable|string|max:500',
        ];
    }
}
