<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //all true else don't work
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
            "preview_image" => "nullable|file",
            "main_image" => "nullable|file",
            "category_id" => "required|integer|exists:categories,id",//exists проверяет что бы category_id в таблице категорий реально существовало
            "tag_ids" => "nullable|array",
            "tag_ids.*" => "nullable|integer|exists:tags,id" //.* означает что весь массив должен быть сопаставлен со значениями в таблице tags
        ];
    }
}
