<?php

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Str;

    /**
     * allows a callback foreach through the given array, similar to array_map, but without creating a copy and returning an array
     *
     * @param array $array input array
     * @param string|Closure $callback the callback getting run on every entry in the loop (only one argument)
     *
     * @return void
     */
    function array_foreach(array $array, string|Closure $callback): void {
        foreach ($array as $entry) {
            $callback($entry);
        }
    }

    /**
     * this function is similar to array_search, but with the option to use a self-defined function
     *
     * @param array $array input array
     * @param string|Closure $callback the callback, the input array will get filtered by
     */
    function array_find(array $array, string|Closure $callback) {
        $foundData = array_filter($array, $callback);

        return !empty($foundData)
            ? $foundData[array_key_first($foundData)]
            : null;
    }

    /**
     * generates a label by replacing all `_` with spaces and capitalizes all words
     *
     * @param string $string
     *
     * @return string
     */
    function generateLabel(string $string): string {
        return ucwords(str_replace('_', ' ', $string));
    }
