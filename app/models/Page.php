<?php

class Page extends Eloquent
{
    public $timestamps = false;

    public function website()
    {
        return $this->belongsTo('Website');
    }

    public function contents()
    {
        return $this->hasMany('Content');
    }

    public function template()
    {
        return $this->belongsTo('Template');
    }

}