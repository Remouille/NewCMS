<?php

class Template extends Eloquent
{
    public $timestamps = false;

    public function pages()
    {
        return $this->hasMany('Page');
    }

}