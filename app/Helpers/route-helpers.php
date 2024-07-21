<?php

    use Illuminate\Support\Facades\Request;

    function current_page_path_name(): string {
        return strtoupper(Request::route()->getName() . ' - ' . config('app.name', 'AudioCreatures'));
    }


