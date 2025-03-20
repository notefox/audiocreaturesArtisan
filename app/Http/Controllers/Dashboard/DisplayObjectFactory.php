<?php

namespace App\Http\Controllers\Dashboard;

class DisplayObjectFactory {

    public static function createDisplayObject($datatype, $entries, string $template): DisplayObject {
        $label = str_replace('_', ' ', $datatype);
        $label = ucwords($label);

        $referenceObject = new DisplayObject();

        $referenceObject->label = $label;
        $referenceObject->datatype = $datatype;
        $referenceObject->entries = $entries;
        $referenceObject->template = $template;

        return $referenceObject;
    }

}
