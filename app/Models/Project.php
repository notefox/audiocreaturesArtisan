<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Project extends Model {
        use HasFactory;
        use SoftDeletes;

        public function publisher(): HasOne {
            return $this->hasOne('App\Publisher');
        }

        public function project_link_reference_connections(): HasMany {
            return $this->hasMany('App\ProjectLinkReferenceConnection');
        }

        public function project_genre_connections(): HasMany {
            return $this->hasMany('App\ProjectGenreConnection');
        }

        public function project_platform_connections(): HasMany {
            return $this->hasMany('App\ProjectPlatformConnection');
        }

        public function project_type_connections(): HasMany {
            return $this->hasMany('App\ProjectTypeConnection');
        }
    }
