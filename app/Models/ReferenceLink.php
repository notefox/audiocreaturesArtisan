<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use LaravelIdea\Helper\App\Models\_IH_ReferenceLinkType_C;

class ReferenceLink extends Model
{
    use HasFactory;

    public function reference_link_type(): HasOne {
        return $this->HasOne('App\ReferenceLinkType');
    }

    public function getConnectedType(): ReferenceLinkType|null {
        $reference_type = $this->reference_link_type_id;

        return ReferenceLinkType::find($reference_type);
    }
}
