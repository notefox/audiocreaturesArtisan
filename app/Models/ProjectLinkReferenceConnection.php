<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class ProjectLinkReferenceConnection extends Model {
        use HasFactory;

        public function reference_links(): HasMany {
            return $this->hasMany('App\ReferenceLink');
        }

        public function projects(): hasMany {
            return $this->hasMany('App\Project');
        }
    }
