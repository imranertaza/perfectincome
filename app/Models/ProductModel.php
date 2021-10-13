<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model {
    protected $table = 'products';
    protected $primaryKey = 'pro_id';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['pro_id', 'Point', 'name', 'price', 'quantity', 'quality', 'model', 'men_id', 'cat_id', 'filter_id', 'colors', 'description', 'size', 'discount', 'special','main_image','additional_images','status','time','createdDtm','updatedBy','updatedDtm','deleted'];
    protected $useTimestamps = false;
    protected $createdField  = 'createdDtm';
    protected $updatedField  = 'updatedDtm';
    protected $deletedField  = 'deleted';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;


}