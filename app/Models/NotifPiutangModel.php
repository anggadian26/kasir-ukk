<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifPiutangModel extends Model
{
    protected $table = 'notif_piutang';
    protected $primaryKey = 'notif_piutang_id';

    protected $guarded = [];
}
