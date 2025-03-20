<?php

namespace App\Http\Controllers\Datatypes;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\JsonResponse;

class PlatformController extends Controller {


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy( int $id ): JsonResponse {
        $platform = Platform::find( $id );

        if ( ! $platform ) {
            return response()->json( [ 'message' => 'Platform not found' ], 404 );
        }

        $platform->delete();

        return response()->json( [ 'message' => 'Platform deleted successfully' ], 200 );
    }

}
