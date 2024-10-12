<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class ReferenceLink extends Model {
        use HasFactory;
        use SoftDeletes;

        public function getById( $id ): ReferenceLink {
            return ReferenceLink::firstWhere('id', '=', $id);
        }

        public function reference_link_type(): HasOne {
            return $this->HasOne('App\ReferenceLinkType');
        }
    }
