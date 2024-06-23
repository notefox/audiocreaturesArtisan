<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLinkReferenceConnection extends Model
{
    use HasFactory;

    public function reference_links() {
        return $this->hasMany('App\ReferenceLink');
    }

    public function projects() {
        return $this->hasMany('App\Project');
    }
}
