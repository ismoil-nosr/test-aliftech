<?php

namespace App\Http\Requests;

class ContactUpdateRequest extends ContactRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|min:3|max:30|unique:contacts,name,' . $this->contact->id . ',id',
            'emails'    => 'required|array|min:1',
            'emails.*'  => 'required|email|distinct|unique:emails,value,' . $this->contact->id . ',contact_id',
            'phones'    => 'required|array|min:1|',
            'phones.*'  => 'required|min:2|max:17|distinct|regex:/^([0-9\s\-\+\(\)]*)$/|unique:phones,value,' . $this->contact->id . ',contact_id',
        ];
    }
}
