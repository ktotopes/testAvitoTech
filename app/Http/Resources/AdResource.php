<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'    => $this->resource->name,
            'logoUrl' => $this->resource->photo[0],
            'price'   => $this->resource->price,
            ...$this->additionalFields($request),
        ];
    }

    private function additionalFields(\Illuminate\Http\Request $request): array
    {
        $additionalFields = [];

        $fields = $request->input('fields') ?? [];

        foreach ($fields as $field) {
            if (in_array($field, ['photo','description','id'])) {
                $additionalFields[$field] = $this->resource[$field];
            }
        }

        return $additionalFields;
    }
}
