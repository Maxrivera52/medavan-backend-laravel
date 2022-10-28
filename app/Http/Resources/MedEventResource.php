<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedEventResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'start' => $this->start,
            'duration' => $this->duration,
            'end' => $this->end,
            'resourceId' => $this->resourceId,
            "iddoctor"=> $this->iddoctor,
            "idcirugia"=> $this->idcirugia,
            "idanesthesia"=> $this->idanesthesia,
            "hospital_days"=> $this->hospital_days,
            "idpatient"=> $this->idpatient,
            "iddiagnostic"=> $this->iddiagnostic,
            "idsource"=> $this->idsource,
            "idmaterial"=> $this->idmaterial,
            "idequipment"=> $this->idequipment,
            "observations"=> null,
            "enable"=> 1,
        ];
    }
}
