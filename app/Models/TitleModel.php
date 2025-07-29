<?php

namespace App\Models;

use CodeIgniter\Model;

class TitleModel extends Model
{
    protected $table            = 'title';
    protected $primaryKey       = 'id';

    protected $allowedFields    = ['title', 'image', 'image2'];

    protected $useTimestamps    = true;
}