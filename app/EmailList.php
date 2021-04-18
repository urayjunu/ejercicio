<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{
       protected $table = 'emails';
       protected $fillable = [
        	'user_id', 'asunto', 'mensaje','email_to','estado',
		];

}
