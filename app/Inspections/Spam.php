<?php

namespace App\Inspections;

class Spam
{
    protected $detections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    public function check($body, $model)
    {
        foreach ($this->detections as $detection)
        {
          $detection = new $detection();

          if($detection->detect($body, $model) == false)
          {
            return false;
          }
          
        }

        return true;
    }
}