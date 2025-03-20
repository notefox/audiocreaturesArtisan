<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Platform extends Model {
        use HasFactory;
        use SoftDeletes;

        public $timestamps = false;


        public static function get( $id ): Platform {
            return Platform::firstWhere('id', '=', $id);
        }

        public function project_platform_connections() {
            return $this->hasMany('App\ProjectPlatformConnection');
        }

    }
