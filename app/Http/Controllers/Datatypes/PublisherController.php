<?php

namespace App\Http\Controllers\Datatypes;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;

class PublisherController extends Controller {

    public function destroy( $id ): JsonResponse {
        // Find the publisher by ID
        $publisher = ( new Publisher )->find( $id );

        if ( ! $publisher ) {
            return response()->json( [ 'message' => 'Publisher not found' ], 404 );
        }

        // Delete the publisher
        $publisher->delete();

        return response()->json( [ 'message' => 'Publisher deleted successfully' ], 200 );
    }
}
