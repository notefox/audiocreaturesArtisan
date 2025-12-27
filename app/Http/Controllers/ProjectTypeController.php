<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use Exception;

class ProjectTypeController extends Controller
{
    /**
     * @throws Exception
     */
    private function existenceCheck($id) {
        if($this->get($id)) {
            return;
        }

        throw new Exception('Project not found');
    }

    /**
     * @throws Exception
     */
    public function destroy(string $id) {
        $this->existenceCheck($id);

        ProjectType::withoutTrashed()->delete($id);
    }

    public function get($id) {
        return ProjectType::withoutTrashed()->find($id);
    }
}
