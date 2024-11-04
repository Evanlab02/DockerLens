<?php

namespace App\Models;

class Container
{
    public $id;
    public $name;
    public $image;
    public $state;
    public $status;

    public function __construct($id, $name, $image, $state, $status)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->state = $state;
        $this->status = $status;
    }
}
