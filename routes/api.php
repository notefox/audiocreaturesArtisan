<?php

    use App\Http\Controllers\Datatypes\GenreController;
    use App\Http\Controllers\Datatypes\PlatformController;
    use App\Http\Controllers\Datatypes\ProjectController;
    use App\Http\Controllers\Datatypes\ProjectTypeController;
    use App\Http\Controllers\Datatypes\PublisherController;
    use App\Http\Controllers\Datatypes\ReferenceLinkController;

    use App\Repositories\ImageRepository;

    use Illuminate\Support\Facades\Route;

    Route::middleware( 'auth')->group(function () {
        Route::delete('/publisher/{id}', [PublisherController::class, 'destroy'])->name('publisher.destroy');
        Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
        Route::delete('/reference_link/{id}', [ReferenceLinkController::class, 'destroy'])->name('reference-link.destroy');
        Route::delete('/genre/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');
        Route::delete('/platform/{id}', [PlatformController::class, 'destroy'])->name('platform.destroy');
        Route::delete('/project_type/{id}', [ProjectTypeController::class, 'destroy'])->name('project-type.destroy');
        Route::delete('/image/{id}', [ImageRepository::class, 'destroy'])->name('images.destroy');
    });
