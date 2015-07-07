<?php

namespace TeachersAsTutors;

class Page extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'uri', 'content', 'enabled'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = ['content_formatted', 'hero_text_formatted', 'children_paginated'];

    protected $casts = ['is_enabled' => 'boolean'];

    protected $parsedown;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->parsedown = new \Parsedown();
    }

    public function getContentFormattedAttribute()
    {
        return $this->parsedown->text($this->content);
    }

    public function getHeroTextFormattedAttribute()
    {
        return $this->parsedown->text($this->hero_text);
    }

    // TODO: Check relationship works
    public function parent()
    {
        return $this->belongsTo('TeachersAsTutors\Page', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('TeachersAsTutors\Page', 'parent_id', 'id');
    }

    public function getChildrenPaginatedAttribute()
    {
        return $this->children()->paginate(5);
    }
}
