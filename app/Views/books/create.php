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
            <a href="<?= base_url('books') ?>" class="btn btn-secondary">Back to List</a>
        </header>

        <main>
            <h2><?= esc($title) ?></h2>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php 
            $errors = session()->getFlashdata('errors');
            if ($errors && is_array($errors)): 
                foreach ($errors as $error): 
                    if (is_array($error)):
                        foreach ($error as $msg): ?>
                            <div class="alert alert-error"><?= esc($msg) ?></div>
                        <?php endforeach;
                    else: ?>
                        <div class="alert alert-error"><?= esc($error) ?></div>
                    <?php endif;
                endforeach;
            endif; 
            ?>

            <?php if ($validation && $validation->hasErrors()): ?>
                <?php foreach ($validation->getErrors() as $error): ?>
                    <div class="alert alert-error"><?= esc($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form action="<?= base_url('books/store') ?>" method="post" enctype="multipart/form-data" class="book-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="title">Title <span class="required">*</span></label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="form-control <?= ($validation && $validation->hasError('title')) ? 'error' : '' ?>" 
                           value="<?= old('title') ?>" 
                           required>
                    <?php if ($validation && $validation->hasError('title')): ?>
                        <span class="error-message"><?= esc($validation->getError('title')) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="author">Author <span class="required">*</span></label>
                    <input type="text" 
                           name="author" 
                           id="author" 
                           class="form-control <?= ($validation && $validation->hasError('author')) ? 'error' : '' ?>" 
                           value="<?= old('author') ?>" 
                           required>
                    <?php if ($validation && $validation->hasError('author')): ?>
                        <span class="error-message"><?= esc($validation->getError('author')) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" 
                           name="genre" 
                           id="genre" 
                           class="form-control" 
                           value="<?= old('genre') ?>">
                </div>

                <div class="form-group">
                    <label for="publication_year">Publication Year <span class="required">*</span></label>
                    <input type="number" 
                           name="publication_year" 
                           id="publication_year" 
                           class="form-control <?= ($validation && $validation->hasError('publication_year')) ? 'error' : '' ?>" 
                           value="<?= old('publication_year') ?>" 
                           min="1" 
                           max="<?= date('Y') + 1 ?>" 
                           required>
                    <?php if ($validation && $validation->hasError('publication_year')): ?>
                        <span class="error-message"><?= esc($validation->getError('publication_year')) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="cover_image">Book Cover Image (Optional)</label>
                    <input type="file" 
                           name="cover_image" 
                           id="cover_image" 
                           class="form-control" 
                           accept="image/jpeg,image/jpg,image/png,image/gif">
                    <small class="form-text">Maximum file size: 2MB. Supported formats: JPEG, PNG, GIF</small>
                    <?php if ($validation && $validation->hasError('cover_image')): ?>
                        <span class="error-message"><?= esc($validation->getError('cover_image')) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?= base_url('books') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </main>
    </div>
</body>
</html>


