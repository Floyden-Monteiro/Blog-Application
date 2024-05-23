<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .card-container {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        .card {
            transition: transform 0.3s;
            margin: 10px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .modal-footer .btn+.btn {
            margin-left: 10px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <a class="navbar-brand" href="<?= base_url('welcome') ?>">Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card-container">
            <div class="card text-white bg-primary mb-5" style="max-width: 18rem;">
                <div class="card-header">Number Of Records</div>
                <div class="card-body">
                    <h1 class="card-title text-center"><?php echo count($articles) ?></h1>
                </div>
            </div>
        </div>

        <div class="text-right mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Create New Article
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($articles) > 0) {
                        $count = 0;
                        foreach ($articles as $article) { ?>
                            <tr>
                                <th scope="row"><?php echo $count + 1 ?></th>
                                <td><img src="<?php echo base_url($article->image); ?>" alt="image" width="100"></td>
                                <td><?php echo $article->title; ?></td>
                                <td><?php echo $article->content; ?></td>
                                <td>
                                    <a href="<?php echo base_url('dashboard/deleteArticle/') . $article->sno; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                    <button class="btn btn-warning btn-sm bi-pencil" data-id="<?php echo $article->sno; ?>" data-title="<?php echo $article->title; ?>" data-content="<?php echo $article->content; ?>"></button>
                                </td>
                            </tr>
                        <?php $count++;
                        }
                    } else { ?>
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Article Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url('dashboard/createArticle'); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Content:</label>
                            <textarea class="form-control" id="message-text" name="content" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Article Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url('dashboard/updateArticle'); ?>">
                        <input type="hidden" id="update-id" name="id">
                        <div class="form-group">
                            <label for="update-title" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="update-title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="update-content" class="col-form-label">Content:</label>
                            <textarea class="form-control" id="update-content" name="content" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data inserted successfully.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.bi-pencil').click(function() {
                var id = $(this).data('id');
                var title = $(this).data('title');
                var content = $(this).data('content');

                $('#update-id').val(id);
                $('#update-title').val(title);
                $('#update-content').val(content);

                $('#updateModal').modal('show');
            });
        });
    </script>

</body>

</html>