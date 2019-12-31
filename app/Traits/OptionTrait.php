<?php

namespace App\Traits;

use App\Option;


trait OptionTrait{


    public function getOptions($type)
    {

        $options = Option::where('type', $type)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return $options;

    }

}