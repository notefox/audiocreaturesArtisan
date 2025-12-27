<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;

class ProjectController extends Controller
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

         Project::withoutTrashed()->delete($id);
    }

    public function get($id) {
        return Project::withoutTrashed()->find($id);
    }
}
