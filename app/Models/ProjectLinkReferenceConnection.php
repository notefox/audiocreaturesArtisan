<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Support\Collection;

    class ProjectLinkReferenceConnection extends Model {
        use HasFactory;

	    public static function getByProject( int $id ): Collection {
			return ProjectLinkReferenceConnection::where('project_id', '=', $id)->get(['reference_link_id'])->map(fn($id) => ReferenceLink::getById($id));
	    }


	    public function reference_links(): HasMany {
            return $this->hasMany('App\ReferenceLink');
        }

        public function projects(): hasMany {
            return $this->hasMany('App\Project');
        }
    }
