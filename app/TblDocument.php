<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class TblDocument extends Model {
    public $incrementing = false;
    public $timestamps = true;
    protected $table = 'document';
}
