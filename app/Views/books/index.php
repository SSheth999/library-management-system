<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <div class="container">
        <header>
            <h1>Library Book Management</h1>
            <a href="<?= base_url('books/create') ?>" class="btn btn-primary">Add New Book</a>
        </header>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <main>
            <h2><?= esc($title) ?></h2>
            
            <?php if (empty($books)): ?>
                <p class="no-books">No books found. <a href="<?= base_url('books/create') ?>">Add your first book</a>.</p>
            <?php else: ?>
                <table class="books-table">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Publication Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td class="cover-cell">
                                    <?php if (!empty($book['cover_image'])): ?>
                                        <img src="<?= base_url('uploads/books/' . esc($book['cover_image'])) ?>" 
                                             alt="<?= esc($book['title']) ?>" 
                                             class="book-cover">
                                    <?php else: ?>
                                        <img src="<?= base_url('assets/images/placeholder.png') ?>" 
                                             alt="No cover" 
                                             class="book-cover placeholder">
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($book['title']) ?></td>
                                <td><?= esc($book['author']) ?></td>
                                <td><?= esc($book['genre'] ?: 'N/A') ?></td>
                                <td><?= esc($book['publication_year']) ?></td>
                                <td class="actions">
                                    <a href="<?= base_url('books/edit/' . $book['id']) ?>" class="btn btn-sm btn-edit">Edit</a>
                                    <a href="<?= base_url('books/delete/' . $book['id']) ?>" 
                                       class="btn btn-sm btn-delete" 
                                       onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>


