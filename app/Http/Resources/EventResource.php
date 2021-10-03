<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'venue_id' => $this->venue_id,
            'eventName' => $this->eventName,
            'eventDetails' => $this->eventDetails,
            'eventPhoto' => $this->eventPhoto,
            'eventDate' => $this->eventDate,
            'eventTimeStart' => $this->eventTimeStart,
            'eventTimeEnd' => $this->eventTimeEnd,
            'eventType' => $this->eventType,
            'eventCost' => $this->eventTimeCost,
            'is_live' => $this->is_live,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
