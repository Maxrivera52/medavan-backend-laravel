<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DiagnosticCollection extends ResourceCollection
{
    
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'count' => $this->collection->count()
        ];

    }
}
