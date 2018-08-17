<?php

namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    protected $keywords = [
        'yahoo customer support'
    ];

    public function detect($body)
    {
        collect($this->keywords)->each(function ($keyword) use ($body) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception("Your reply contains spam");
            }
        });
    }
}
