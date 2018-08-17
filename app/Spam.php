<?php

namespace App;

class Spam
{
    public function detect($body)
    {
        // Detect invalid keywords
        $this->detectInvalidKeywords($body);

        return false;
    }

    protected function detectInvalidKeywords($body)
    {
        $invalidKeywords = [
            'yahoo customer support'
        ];

        collect($invalidKeywords)->each(function ($keyword) use ($body) {
            if (stripos($body, $keyword) !== false) {
                throw new \Exception("Your reply contains spam");
            }
        });
    }
}
