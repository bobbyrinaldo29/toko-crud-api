<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
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
            'id'            => $this->id,
            'nama_barang'   => $this->nama_barang,
            'harga_barang'  => $this->harga_barang,
            'created_at'    => $this->created_at->format('d/m/Y'),
            'updated_at'    => $this->updated_at->format('d/m/Y')
        ];
    }
}
