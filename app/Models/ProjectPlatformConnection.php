<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class ProjectPlatformConnection extends Model {
        use HasFactory;

        public function projects(): HasMany {
            return $this->hasMany('App\Project');
        }

        public function platforms(): HasMany {
            return $this->hasMany('App\Platform');
        }
    }
