<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:3|max:40',
            'description' => 'required|min:10|max:100',
            'img'=>'mimes:jpeg,png,:max:5000'
        ];
    }

    public function messages()
    {

        return [
            'title.required' => 'Заголовок обязательное поле',
            'description.required' => 'Основной текст обязательное поле',
            'title.min' => 'Заголовок должен иметь не менее :min символов',
            'description.min' => 'Основной текст должен иметь не менее :min символов',
            'title.max' => 'Заголовок должен иметь не более :max символов',
            'description.max' => 'Основной текст должен иметь не более :max символов',
            'img.mimes'=> 'Принимаются картинки только с форматом .jpeg или .png',
            'img.max'=>'Картинки выше :max кб не пройдут',
        ];
    }
}
