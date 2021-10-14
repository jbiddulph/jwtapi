<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VenueResource extends JsonResource
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
            'venuename' => $this->venuename,
            'venuetype' => $this->venuetype,
            'address' => $this->address,
            'address2' => $this->address2,
            'town' => $this->town,
            'county' => $this->county,
            'postcode' => $this->postcode,
            'postalsearch' => $this->postalsearch,
            'telephone' => $this->telephone,
            'easting' => $this->easting,
            'northing' => $this->northing,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'local_authority' => $this->local_authority,
            'website' => $this->website,
            'photo' => $this->photo,
            'is_live' => $this->is_live,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
