<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $serverId = $this->route('server')->id; // route model binding থেকে আসবে

        return [
            'name'       => [
                'sometimes',
                'string',
                Rule::unique('servers')->ignore($serverId)->where('provider', $this->provider ?? $this->route('server')->provider),
            ],
            'ip_address' => ['sometimes', 'ipv4', Rule::unique('servers')->ignore($serverId)],
            'provider'   => ['sometimes', Rule::in(['aws','digitalocean','vultr','other'])],
            'status'     => ['sometimes', Rule::in(['active','inactive','maintenance'])],
            'cpu_cores'  => ['sometimes', 'integer', 'between:1,128'],
            'ram_mb'     => ['sometimes', 'integer', 'between:512,1048576'],
            'storage_gb' => ['sometimes', 'integer', 'between:10,1048576'],
        ];
    }
}
