<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'logo' => $this->logo ? url("storage/{$this->logo}") : '',
            'cnpj' => $this->cnpj,
            'name' => $this->name,
            'flag' => $this->url,
            'email' => $this->email,
            'date_created' => Carbon::parse($this->created_at)->format('d/m/Y'),
        ];
    }
}
