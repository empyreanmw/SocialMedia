<?php
namespace App\Inspections;

use Exceptions;

use App\Inspections\Inspections;

class InvalidKeywords implements Inspections
{
    protected $keywords = [
        'Spam',
        'Test'
    ];

    public function detect($body, $model)
    {
        foreach($this->keywords as $keyword)
        {
         if(str_contains($body, $keyword))
         {
            return false;
         }
        }
        return true;
    }
}