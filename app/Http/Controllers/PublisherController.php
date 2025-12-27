<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Exception;

class PublisherController extends Controller
{
    /**
     * @throws \Exception
     */
    private function existenceCheck($id) {
        if($this->get($id)) {
            return;
        }

        throw new Exception('Publisher not found');
    }

    /**
     * @throws \Exception
     */
    public function destroy(string $id) {
        $this->existenceCheck($id);

        Publisher::withoutTrashed()->find($id)->delete();

        return redirect('dashboard#publisher');
    }

    public function get($id) {
        return Publisher::withoutTrashed()->find($id);
    }
}
