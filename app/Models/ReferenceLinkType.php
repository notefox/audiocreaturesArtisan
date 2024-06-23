<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReferenceLinkType extends Model
{
    use HasFactory;

    public function reference_links(): HasMany {
        return $this->hasMany('App\ReferenceLink');
    }
}
