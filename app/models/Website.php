<?php

class Website extends Eloquent
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function pages()
    {
        return $this->hasMany('Page');
    }

}