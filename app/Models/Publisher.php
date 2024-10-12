<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Publisher extends Model {
        use HasFactory;
        use SoftDeletes;

        protected $fillable = ['name', 'country', 'link'];

        public $timestamps = false;

        public function get_logo(): Images|null {
            return Images::query()->find($this->logo_id)?->first();
        }
    }
