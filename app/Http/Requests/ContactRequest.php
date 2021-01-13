<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'      => 'required|string|min:3|max:30|unique:contacts,name',
            'emails'    => 'array|min:1',
            'emails.*'  => 'email|distinct|unique:emails,value',
            'phones'    => 'array|min:1|',
            'phones.*'  => 'min:2|max:17|distinct|regex:/^([0-9\s\-\+\(\)]*)$/|unique:phones,value',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Введите имя',
            'name.unique' => 'Контакт с таким именем уже существует',
            'name.min' => 'Имя должно быть не меньше 3-х символов',
            'name.min' => 'Имя должно быть не больше 30 символов',
            'emails.*.required' => 'Введите email',
            'emails.*.email' => 'Введите правильный email',
            'emails.*.unique' => 'Контакт с таким email уже существует',
            'emails.*.distinct' => 'Дублирующее значение',
            'phones.*.required' => 'Введите номер телефона',
            'phones.*.min' => 'Введите номер телефона',
            'phones.*.max' => 'Номер не может превышать 17 цифр',
            'phones.*.distinct' => 'Дублирующее значение',
            'phones.*.regex' => 'Неправильный формат телефона',
            'phones.*.unique' => 'Контакт с таким номером уже существует',
        ];
    }
}
