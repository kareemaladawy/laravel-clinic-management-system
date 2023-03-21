<?php

namespace App\Http\Resources;

use App\Models\History;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $history = History::where('patient_id', $this->id)->get('properties');
        $last_viewed_at = $this->last_viewed_at ? $this->last_viewed_at->diffForHumans() : null;
        return [
            'name' => $this->whenNotNull($this->name),
            'email' => $this->whenNotNull($this->email),
            'phone_number' => $this->whenNotNull($this->phone_number),
            'birthday' => $this->whenNotNull($this->birthday),
            'location' => $this->whenNotNull($this->location),
            'created_at' => $this->whenNotNull($this->created_at->diffForHumans()),
            'last_viewed_at' => $this->whenNotNull($last_viewed_at),
            'history' => $history->isEmpty() ? 'no history yet' : $history[0]->properties
        ];
    }
}
