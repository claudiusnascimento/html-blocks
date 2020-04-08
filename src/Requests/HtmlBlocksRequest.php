<?php

namespace ClaudiusNascimento\HtmlBlocks\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HtmlBlocksRequest extends FormRequest
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

        $this->errorBag = $this->get('errorBag', 'default');
        $this->merge(['active' => $this->has('active')]);

        return [
            'rel' => 'required|string',
            'rel_id' => 'required|integer'
            // 'key' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'rel.required' => 'Sem identificação de relação',
            'rel.string' => 'Relação inválida',
            'rel_id.required' => 'Sem identificação de instância',
            'rel_id.integer' => 'ID da instância inválido',
            // 'key.required' => 'Preencha a chave',
        ];
    }
}
