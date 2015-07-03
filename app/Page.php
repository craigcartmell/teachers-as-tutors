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

    protected $appends = ['content_formatted'];

    protected $casts = ['is_enabled' => 'boolean'];

    public function getContentFormattedAttribute()
    {
        $parsedown = new \Parsedown();

        return $parsedown->text($this->content);
    }
}
