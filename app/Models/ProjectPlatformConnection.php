<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Support\Collection;

    class ProjectPlatformConnection extends Model {
        use HasFactory;

	    public static function getByProject( int $id ): Collection {
			return ProjectPlatformConnection::where('project_id', '=', $id)->get('platform_id')->map(fn($id) => Platform::get( $id));
	    }

	    public function projects(): HasMany {
            return $this->hasMany('App\Project');
        }

        public function platforms(): HasMany {
            return $this->hasMany('App\Platform');
        }
    }
