<?php
namespace App\Inspections;

use Exceptions;

use App\Inspections\Inspections;

class InvalidKeywords implements Inspections
{
    protected $keywords = [
        'Spam'
    ];

    public function detect($body)
    {
        foreach($this->keywords as $keyword)
        {
          return !str_contains($body, $keyword);
        }
    }
}