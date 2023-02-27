<?php

namespace App\Http\Requests\Admin\User;

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
            "name" => "required|string",
            "email" => "required|string|email|unique:users,email," . $this->user_id,    //проблема с редактированием пользователя, почта уникальна, поэтому следует дописать
            "user_id" => "required|integer|exists:users,id",            //дополнительную проверку 10 минута https://www.youtube.com/watch?v=SUxYdPkdAX0&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=26
            "role" => "required|integer",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле необходимо заполнить',
            'name.string' => 'Это поле должно быть строковым',
            'email.unique' => 'Данный email занят',
            'role.required' => 'Это поле необходимо заполнить',
        ];
    }
}
