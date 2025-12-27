<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Exception;

class PlatformController extends Controller
{
    /**
     * @throws Exception
     */
    public function existenceCheck($id) {
        if($this->get($id)) {
            return;
        }

        throw new Exception('Platform not found');
    }

    /**
     * @throws Exception
     */
    public function destroy(string $id) {
        $this->existenceCheck($id);

        Platform::withoutTrashed()->delete($id);
    }

    public function get($id) {
        return Platform::withoutTrashed()->find($id);
    }
}
