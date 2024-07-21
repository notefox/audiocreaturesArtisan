<?php

    namespace App\Http\Controllers;

    use App\Models\Genre;
    use App\Models\Platform;
    use App\Models\Project;
    use App\Models\ProjectType;
    use App\Models\Publisher;
    use App\Models\ReferenceLink;
    use Illuminate\Support\Facades\Request;

    class DashboardController extends Controller {
        public function create() {
            $current_user = Request::user();

            $datatypes = [
                'project' => Project::all(),
                'publisher' => Publisher::all(),
                'reference_link' => ReferenceLink::all(),
                'genre' => Genre::all(),
                'platform' => Platform::all(),
                'project_type' => ProjectType::all(),
            ];

            $map_datatype_to_key = function ($datatype) use (&$datatypes) {
                $label = str_replace('_', ' ', $datatype);
                $label = ucwords($label);

                $referenceObject = new \stdClass();

                $referenceObject->label = $label;
                $referenceObject->datatype = $datatype;
                $referenceObject->entries = $datatypes[$datatype];

                $datatypes[$datatype] = $referenceObject;
            };

            array_foreach(array_keys($datatypes), $map_datatype_to_key);

            return view('dashboard.dashboard', ['user' => $current_user, 'datatypes' => $datatypes]);
        }
    }
