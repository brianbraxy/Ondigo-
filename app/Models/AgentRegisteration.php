<?php

namespace App\Models;

use App\Models\{
  User,
};

class AgentRegisteration extends Model
{

  protected $fillable = [
    'agent_id',
    'user_id',
    'user_type',
    'status',
    'detail',
  ];

  protected $table = 'agent_registerations';

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
