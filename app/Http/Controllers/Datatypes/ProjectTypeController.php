<?php

namespace App\Http\Controllers\Datatypes;

use App\Http\Controllers\Controller;
use App\Models\ProjectType;
use Illuminate\Http\JsonResponse;

class ProjectTypeController extends Controller {

    public function destroy( $id ): JsonResponse {
        // Implement logic to delete a resource by its ID
        // You can use a model to find and delete the record
        $projectType = ProjectType::get( $id );

        if ( ! $projectType ) {
            return response()->json( [ 'message' => 'Resource not found' ], 404 );
        }

        $projectType->delete();

        return response()->json( [ 'message' => 'Resource deleted successfully' ], 200 );
    }

}
