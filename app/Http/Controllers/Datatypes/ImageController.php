<?php

namespace App\Http\Controllers\Datatypes;

use App\Http\Controllers\Controller;
use App\Models\Images;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller {

	public static function getAllParents() {
        return Images::all()->where('parent', null);
    }


	public function destroy( int $id ): JsonResponse {

        $baseImage = Images::find($id);

        if( ! $baseImage ) {
            return response()->json( [ 'message' => 'Image not found' ], 404 );
        }

        if ( ! $baseImage->isOriginal() ) {
            return response()->json( [ 'message' => 'Image is not original (use destroyAlt function)' ], 400 );
        }

        $children = ( new Images )->children( $id);

        $children->each(function($child) {
            $child->delete();
        });

        $baseImage->delete();

        return response()->json( [ 'message' => 'Image deleted successfully' ] );
    }

    public function destroyAlt( int $id ): JsonResponse {
        $image = Images::find($id);

        if( ! $image ) {
            return response()->json( [ 'message' => 'Image not found' ], 404 );
        }

        if( $image->isOriginal() ) {
            return response()->json( [ 'message' => 'Image is original (use normal destroy function)' ], 400 );
        }

        $image->delete();

        return response()->json( [ 'message' => 'Alt Image deleted successfully' ] );
    }

}
