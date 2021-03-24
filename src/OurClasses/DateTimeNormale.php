<?php

namespace App\OurClasses;

class DateTimeNormale extends DateTime implements JsonSerializable
{
    public function jsonSerialize()
    {
        return $this->format("Y-m-d H:i:s");
    }
}   