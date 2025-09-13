<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // চাইলে policy দিয়ে manage করতে পারো
    }

    public function rules(): array
    {
        return [
            'name'       => [
                'required',
                'string',
                Rule::unique('servers')->where('provider', $this->provider),
            ],
            'ip_address' => ['required', 'ipv4', 'unique:servers,ip_address'],
            'provider'   => ['required', Rule::in(['aws','digitalocean','vultr','other'])],
            'status'     => ['required', Rule::in(['active','inactive','maintenance'])],
            'cpu_cores'  => ['required', 'integer', 'between:1,128'],
            'ram_mb'     => ['required', 'integer', 'between:512,1048576'],
            'storage_gb' => ['required', 'integer', 'between:10,1048576'],
        ];
    }
}
