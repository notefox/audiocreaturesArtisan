<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Genre extends Model {
        use HasFactory;
        use SoftDeletes;

        public function project_genre_connections(): HasMany {
            return $this->hasMany('App\ProjectGenreConnection');
        }
    }
