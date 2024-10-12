<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Support\Collection;

    class ProjectGenreConnection extends Model {
        use HasFactory;

	    public static function getByProject( int $id ): Collection {
            return ProjectGenreConnection::where('project_id', '=', $id)->get(['genre_id'])->map(fn($id) => Genre::getById($id));
        }

	    public function projects(): HasMany {
            return $this->hasMany('App\Project');
        }

        public function genres(): HasMany {
            return $this->hasMany('App\Genre');
        }
    }
