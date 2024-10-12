<?php

    namespace App\Models;

    use App\Repositories\ImageRepository;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Support\Facades\Storage;

    /**
     * @property int $id
     * @property string $image_path
     * @property string $image_name
     * @property string $sha256
     * @property string mime_type
     */
    class Images extends Model {
        use HasFactory;

        protected $table = 'images';
        protected $fillable = [ 'image_path', 'image_name', 'sha256', 'mime_type' ];

        public function alt($size = 'thumbnail'): Images {
            if(!in_array($size,array_keys(ImageRepository::$alt_sizes))) {
                return $this;
            }

            return Images::all()
                         ->where('parent', '=', $this->id)
                         ->firstWhere('image_name', '=', "$this->image_name-$size");
        }

        public function original() {
            if($this->parent == 0) {
                return $this;
            }

            return Images::all()->firstWhere('id', '=', $this->parent);
        }

        public function absolute_path(): string {
            $storage = Storage::disk($this->parent == 0 ? 'public' : 'sizes');

            return asset('storage/' . $this->image_path);
        }
        public function projects(): HasOne {
            return $this->HasOne('App\Model\Projects');
        }

        public function publishers(): HasOne {
            return $this->hasOne('App\Models\Publisher');
        }
    }
