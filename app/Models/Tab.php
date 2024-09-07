<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasOne;

    class Tab extends Model {
        use HasFactory;

        public function user(): HasOne {
            return $this->hasOne('App\User');
        }

        public function previous(): ?Tab {
            $previous_id = $this->getAttribute('prev');

            return $this->hasPrev() ? Tab::find($previous_id) : null;
        }

        public function next(): ?Tab {
            $next_id = $this->getAttribute('next');

            return $this->hasNext() ? Tab::find($next_id) : null;
        }

        public function hasPrev(): bool {
            return !!$this->getAttribute('prev');
        }

        public function hasNext(): bool {
            return !!$this->getAttribute('next');
        }
    }
