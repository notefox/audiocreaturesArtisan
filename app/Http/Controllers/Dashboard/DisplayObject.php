<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class DisplayObject {

    public string $label;
    public string $datatype;
    public Collection $entries;
    public string $template;

}
