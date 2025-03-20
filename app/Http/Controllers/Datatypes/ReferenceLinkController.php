<?php

namespace App\Http\Controllers\Datatypes;

use App\Http\Controllers\Controller;
use App\Models\ReferenceLink;

class ReferenceLinkController extends Controller {


    public function destroy( $id ) {
        // Add logic to find the resource by its ID
        $resource = ReferenceLink::find( $id ); // Replace ResourceModel with the appropriate model name

        if ( ! $resource ) {
            return response()->json( [ 'message' => 'Resource not found' ], 404 );
        }

        // Attempt to delete the resource
        $resource->delete();

        return response()->json( [ 'message' => 'Resource deleted successfully' ], 200 );
    }

}
