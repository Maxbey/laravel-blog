<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
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
            'title'         => 'required|string|min:3',
            'excerpt'       => 'required|string|min:100',
            'body'          => 'required|string|min:300',
            'published_at'  => 'required|date'
        ];
    }
}
