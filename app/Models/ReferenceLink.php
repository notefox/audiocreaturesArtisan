<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasOne;

    class ReferenceLink extends Model {
        use HasFactory;

        public function reference_link_type(): HasOne {
            return $this->HasOne('App\ReferenceLinkType');
        }
    }
