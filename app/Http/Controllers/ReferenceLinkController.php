<?php

namespace App\Http\Controllers;

use App\Models\ReferenceLink;
use Exception;

class ReferenceLinkController extends Controller
{
    /**
     * @throws Exception
     */
    private function existenceCheck($id) {
        $referenceLinkFound = $this->get($id);

        if(!$referenceLinkFound) {
            throw new Exception('Reference Link not found');
        }
    }

    /**
     * @throws Exception
     */
    public function destroy(string $id) {
        $this->existenceCheck($id);

        ReferenceLink::withoutTrashed()->delete($id);
    }

    public function get(string $id) {
        return ReferenceLink::withoutTrashed()->find($id);
    }
}
