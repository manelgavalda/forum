<?php

namespace App\Inspections;

class Spam
{
    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    public function detect($body)
    {
        collect($this->inspections)->each(function ($inspection) use ($body) {
            app($inspection)->detect($body);
        });

        return false;
    }
}
