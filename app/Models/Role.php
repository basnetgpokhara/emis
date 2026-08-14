<?php
namespace App\Models;

use Zizaco\Entrust\EntrustRole;


class Role extends EntrustRole
{
    protected $fillable = [ 'created_at','updated_at','name', 'display_name', 'description'];

}