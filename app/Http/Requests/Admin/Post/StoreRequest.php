<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;    //должен быть true иначе работать не будет
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "content" => "required|string",
            "preview_image" => "required|file",
            "main_image" => "required|file",
            "category_id" => "required|integer|exists:categories,id",//exists проверяет что бы category_id в таблице категорий реально существовало
            "tag_ids" => "nullable|array",
            "tag_ids.*" => "nullable|integer|exists:tags,id" //.* означает что весь массив должен быть сопаставлен со значениями в таблице tags
        ];
    }

    public function messages(){     //данный метод зарезирвирован и используется для выведения ошибок
                                    //указываем поле, после правило, далее сообщение которое должно быть выведено при возникновении ошибки
        return [
            'title.required' => 'Это поле необходимо заполнить',
            'title.string' => 'Это поле должно соответствовать строковому типу',
            'content.required' => 'Это поле необходимо заполнить',
            'content.string' => 'Это поле должно соответствовать строковому типу',
            'preview_image' => 'Это поле необходимо заполнить',
            'preview_image' => 'Необходимо выбрать файл',
            'main_image' => 'Это поле необходимо заполнить',
            'main_image' => 'Необходимо выбрать файл',
            'category_id.required' => 'Необходимо выбрать категорию',
            'category_id.integer' => 'Категория должна быть числом',
            'category_id.exists' => 'Категория должна присутствовать в базе данных',
        ];

    }
    
}
