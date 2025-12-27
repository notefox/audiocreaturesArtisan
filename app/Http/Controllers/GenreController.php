<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Exception;

class GenreController extends Controller
{
    /**
     * @throws Exception
     */
    private function existenceCheck($id) {
        if(Genre::find($id)) {
            return;
        }

        throw new Exception('Genre not found');
    }

    /**
     * @throws Exception
     */
    public function destroy(string $id) {
        $this->existenceCheck($id);

        Genre::withoutTrashed()->delete($id);
    }

    public function get($id) {
        return Genre::withoutTrashed()->find($id);
    }
}
