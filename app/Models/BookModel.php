<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'author', 'genre', 'publication_year', 'cover_image'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title'            => 'required|min_length[1]|max_length[255]',
        'author'           => 'required|min_length[1]|max_length[255]',
        'genre'            => 'permit_empty|max_length[100]',
        'publication_year' => 'required|numeric|greater_than[0]|less_than_equal_to[' . (date('Y') + 1) . ']',
        'cover_image'      => 'permit_empty|max_length[255]',
    ];
    protected $validationMessages   = [
        'title' => [
            'required' => 'The book title is required.',
            'min_length' => 'The book title must be at least 1 character long.',
        ],
        'author' => [
            'required' => 'The author name is required.',
            'min_length' => 'The author name must be at least 1 character long.',
        ],
        'publication_year' => [
            'required' => 'The publication year is required.',
            'numeric' => 'The publication year must be a valid number.',
            'greater_than' => 'The publication year must be greater than 0.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}


