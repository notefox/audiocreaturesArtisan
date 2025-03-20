<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Dashboard\DisplayObject;
    use App\Http\Controllers\Dashboard\DisplayObjectFactory;
    use App\Http\Controllers\Datatypes\ImageController;
    use App\Http\Controllers\Datatypes\ProjectController;
    use App\Models\Genre;
    use App\Models\Images;
    use App\Models\Platform;
    use App\Models\Project;
    use App\Models\ProjectType;
    use App\Models\Publisher;
    use App\Models\ReferenceLink;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Foundation\Application;
    use Illuminate\Support\Facades\Request;

    class DashboardController extends Controller {
        public function render(): View|Application|Factory {
            $current_user = Request::user();

            $datatypes = [
                'project' => Project::all(),
                'publisher' => Publisher::all(),
                'reference_link' => ReferenceLink::all(),
                'genre' => Genre::all(),
                'platform' => Platform::all(),
                'project_type' => ProjectType::all(),

                'images' => Images::all(),
//                'images' => ImageController::getAllParents(),
            ];

            $map_datatype_to_key = function ($datatype) use (&$datatypes) {
                $isImage = $datatype === 'images';

                // TODO: refactor later (for now only used for single datatype)
                $templateToUse = $isImage ? 'livewire.grid-image-entries' : 'livewire.list-datatype-entries';

                $datatypes[$datatype] = DisplayObjectFactory::createDisplayObject($datatype, $datatypes[$datatype], $templateToUse);
            };

            array_foreach(array_keys($datatypes), $map_datatype_to_key);

            return view('dashboard.dashboard', ['user' => $current_user, 'datatypes' => $datatypes]);
        }
    }
