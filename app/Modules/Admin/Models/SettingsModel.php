<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'value_store';
    protected $primaryKey = 'id'; // change if your PK is different
    protected $returnType = 'array';

    public function getValueStores()
    {
        return $this->findAll(); // CI4 built-in method for "SELECT *"
    }
}