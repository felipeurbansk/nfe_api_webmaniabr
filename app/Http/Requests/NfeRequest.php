<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NfeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'natureza_operacao' => 'required',
            'operacao' => 'required',
            'modelo' => 'required',
            'nome_completo' => 'required',
            'cpf' => 'required|cpf|formato_cpf',
            'email' => 'required|email',
            'endereco' => 'required',
            'numero' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'cep' => 'required|formato_cep',
            'item' => 'required',
            'nome_produto' => 'required',
            'ncm' => 'required',
            'quantidade' => 'required',
            'unidade' => 'required',
            'peso' => 'required',
            'origem' => 'required',
            'subtotal' => 'required',
            'total' => 'required',
            'presenca' => 'required',
            'modalidade_frete' => 'required',
            'frete' => 'required',
            'desconto' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
