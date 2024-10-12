<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class ProjectType extends Model {
        use HasFactory;
        use SoftDeletes;

        public $timestamps = false;

        public function getById( $id ): ProjectType {
            return ProjectType::firstWhere('id', '=', $id);
        }

        public function project_type_connections(): HasMany {
            return $this->hasMany('App\ProjectTypeConnection');
        }
    }
