<?php

namespace App\Http\Controllers\Datatypes;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller {

    /**
     * Remove the specified genre from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy( int $id ): JsonResponse {
        $genre = ( new Genre )->find( $id );

        if ( ! $genre ) {
            return response()->json( [ 'message' => 'Genre not found' ], 404 );
        }

        $genre->delete();

        return response()->json( [ 'message' => 'Genre deleted successfully' ] );
    }

}
