<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest 
{
    public function authorize(): bool
    {
        return auth()->user()->function === 'scrum master';
    }

    public function rules(): array
    {
        return [
            'name' =>'required|string|max:50',
            'descri_task' =>'required|string|max:255',
            'type'=>'required|in:Feature,review,design,docs,devops,bug',
            'priority'=>'required|in:alta,media,baixa',
            'date_expiration'=>'required|date',
            'who_does'=>'nullable|exists:users,id'
        ];
    }
}