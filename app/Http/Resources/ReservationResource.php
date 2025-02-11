<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'branch_id'=>$this->branch_id,
        'table_no'=>$this->table_no,
        'customer_contact_no'=>$this->customer_contact_no,
        'customer_name'=>$this->customer_name,
        'date'=>$this->date,
        'time'=>$this->time
        ];
        //return parent::toArray($request);
    }
}
