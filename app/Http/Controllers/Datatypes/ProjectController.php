<?php

namespace App\Http\Controllers\Datatypes;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller {

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy( int $id ): JsonResponse {
        // Assuming you have a model named Project
        $project = ( new Project )->find( $id );

        if ( ! $project ) {
            return response()->json( [ 'message' => 'Project not found' ], 404 );
        }

        $project->delete();

        return response()->json( [ 'message' => 'Project deleted successfully' ] );
    }
}
