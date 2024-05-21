<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'userid';
    protected $allowedFields = ['username', 'email', 'password', 'token'];
    protected $useAutoIncrement = true;
}
