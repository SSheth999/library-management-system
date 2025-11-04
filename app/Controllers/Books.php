<?php

namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\HTTP\ResponseInterface;

class Books extends BaseController
{
    protected $bookModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    /**
     * Display a list of all books
     */
    public function index(): string
    {
        $data = [
            'title' => 'List of Books',
            'books' => $this->bookModel->findAll(),
        ];

        return view('books/index', $data);
    }

    /**
     * Show the form for creating a new book
     */
    public function create(): string
    {
        $data = [
            'title' => 'Add Book',
            'validation' => \Config\Services::validation(),
        ];

        return view('books/create', $data);
    }

    /**
     * Store a newly created book in the database
     */
    public function store()
    {
        // Validation rules
        $rules = [
            'title' => [
                'rules' => 'required|min_length[1]|max_length[255]',
                'errors' => [
                    'required' => 'The book title is required.',
                    'min_length' => 'The book title must be at least 1 character long.',
                ],
            ],
            'author' => [
                'rules' => 'required|min_length[1]|max_length[255]',
                'errors' => [
                    'required' => 'The author name is required.',
                    'min_length' => 'The author name must be at least 1 character long.',
                ],
            ],
            'genre' => [
                'rules' => 'permit_empty|max_length[100]',
            ],
            'publication_year' => [
                'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[' . (date('Y') + 1) . ']',
                'errors' => [
                    'required' => 'The publication year is required.',
                    'numeric' => 'The publication year must be a valid number.',
                    'greater_than' => 'The publication year must be greater than 0.',
                ],
            ],
            'cover_image' => [
                'rules' => 'uploaded[cover_image]|max_size[cover_image,2048]|is_image[cover_image]|mime_in[cover_image,image/jpeg,image/jpg,image/png,image/gif]',
                'errors' => [
                    'max_size' => 'The image file size must not exceed 2MB.',
                    'is_image' => 'The uploaded file must be an image.',
                    'mime_in' => 'The image must be in JPEG, PNG, or GIF format.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $coverImage = $this->request->getFile('cover_image');
        $coverImageName = null;

        if ($coverImage && $coverImage->isValid() && !$coverImage->hasMoved()) {
            $coverImageName = $coverImage->getRandomName();
            $coverImage->move(ROOTPATH . 'public/uploads/books', $coverImageName);
        }

        // Prepare data for insertion
        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre') ?? '',
            'publication_year' => $this->request->getPost('publication_year'),
            'cover_image' => $coverImageName,
        ];

        // Insert the book
        if ($this->bookModel->insert($data)) {
            session()->setFlashdata('success', 'Book successfully added!');
            return redirect()->to('/books');
        } else {
            session()->setFlashdata('error', 'Failed to add book. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing a book
     */
    public function edit($id): string
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Book',
            'book' => $book,
            'validation' => \Config\Services::validation(),
        ];

        return view('books/edit', $data);
    }

    /**
     * Update a book record in the database
     */
    public function update($id)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Validation rules
        $rules = [
            'title' => [
                'rules' => 'required|min_length[1]|max_length[255]',
                'errors' => [
                    'required' => 'The book title is required.',
                    'min_length' => 'The book title must be at least 1 character long.',
                ],
            ],
            'author' => [
                'rules' => 'required|min_length[1]|max_length[255]',
                'errors' => [
                    'required' => 'The author name is required.',
                    'min_length' => 'The author name must be at least 1 character long.',
                ],
            ],
            'genre' => [
                'rules' => 'permit_empty|max_length[100]',
            ],
            'publication_year' => [
                'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[' . (date('Y') + 1) . ']',
                'errors' => [
                    'required' => 'The publication year is required.',
                    'numeric' => 'The publication year must be a valid number.',
                    'greater_than' => 'The publication year must be greater than 0.',
                ],
            ],
            'cover_image' => [
                'rules' => 'uploaded[cover_image]|max_size[cover_image,2048]|is_image[cover_image]|mime_in[cover_image,image/jpeg,image/jpg,image/png,image/gif]',
                'errors' => [
                    'max_size' => 'The image file size must not exceed 2MB.',
                    'is_image' => 'The uploaded file must be an image.',
                    'mime_in' => 'The image must be in JPEG, PNG, or GIF format.',
                ],
            ],
        ];

        // Make cover_image validation optional if no file is uploaded
        if (!$this->request->getFile('cover_image')->isValid()) {
            unset($rules['cover_image']);
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $coverImage = $this->request->getFile('cover_image');
        $coverImageName = $book['cover_image']; // Keep existing image by default

        if ($coverImage && $coverImage->isValid() && !$coverImage->hasMoved()) {
            // Delete old image if it exists
            if (!empty($book['cover_image'])) {
                $oldImagePath = ROOTPATH . 'public/uploads/books/' . $book['cover_image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new image
            $coverImageName = $coverImage->getRandomName();
            $coverImage->move(ROOTPATH . 'public/uploads/books', $coverImageName);
        }

        // Prepare data for update
        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre') ?? '',
            'publication_year' => $this->request->getPost('publication_year'),
            'cover_image' => $coverImageName,
        ];

        // Update the book
        if ($this->bookModel->update($id, $data)) {
            session()->setFlashdata('success', 'Book successfully updated!');
            return redirect()->to('/books');
        } else {
            session()->setFlashdata('error', 'Failed to update book. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete a book record from the database
     */
    public function delete($id)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Delete the cover image if it exists
        if (!empty($book['cover_image'])) {
            $imagePath = ROOTPATH . 'public/uploads/books/' . $book['cover_image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the book record
        if ($this->bookModel->delete($id)) {
            session()->setFlashdata('success', 'Book successfully deleted!');
        } else {
            session()->setFlashdata('error', 'Failed to delete book. Please try again.');
        }

        return redirect()->to('/books');
    }
}


