<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8',

        ];
    }

    public function attributes()
    {
        return [
            'password' => 'senha'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'O campo :attribute precisa ser um email válido',
            'exists' => 'O campo :attribute ainda não foi registrado no sistema',
            'string' => 'O campo :attribute precisa ser um texto valido',
            'min' => 'O campo :attribute precisa ter pelo menos :min caracteres'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'errors' => $validator->errors(),
            'message' => 'Authentication failed'
        ], 422);

        throw new HttpResponseException($response);
    }
}
