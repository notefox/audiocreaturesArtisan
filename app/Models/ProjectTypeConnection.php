<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class ProjectTypeConnection extends Model {
        use HasFactory;

        public function project_types() {
            return $this->hasMany('App\ProjectType');
        }

        public function projects() {
            return $this->hasMany('App\Project');
        }
    }
