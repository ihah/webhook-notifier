<?php

namespace Ihah\WebhookNotifier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GitlabRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'object_kind' => 'required',
        ];
    }
}
