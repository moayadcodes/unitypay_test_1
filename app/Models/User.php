<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function isPartOfCompany($company)
    {
        return $company->users->contains($this);
    }
}
