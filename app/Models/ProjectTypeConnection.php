<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class ProjectTypeConnection extends Model {
        use HasFactory;

        public static function getByProject( int $id ) {
            return ProjectTypeConnection::all()->where( 'project_id', '=', $id )->get( [ 'project_type_id' ] )->map( fn( $id ) => ProjectType::getById( $id ) );
        }

        public function project_types() {
            return $this->hasMany( 'App\ProjectType' );
        }

        public function projects() {
            return $this->hasMany( 'App\Project' );
        }
    }
