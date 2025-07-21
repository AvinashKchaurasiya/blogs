<?php 
    include 'includes/sidebar.php';
    include 'includes/header.php';
?>
<main style="margin-top: 58px">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="card" style="padding-left: 1rem;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>dashboard.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>blog.php">Blog</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION['success']) && $_SESSION['success'] == true) {
            $errorMessage = $_SESSION['message'];
            unset($_SESSION['success']);
            unset($_SESSION['message']);
        ?>
            <div id="success-message" class="alert alert-success">
                <?php echo $errorMessage; ?>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 5000);
            </script>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between;">
                        <span style="font-weight: bold;">Blogs</span>
                        <a href="<?= BASE_URL ?>create-blog.php" class="btn btn-sm btn-primary">Add Blog</a>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="blogTable" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>View</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn = 1;
                                $selectBlogQuery = "SELECT * FROM blogs ORDER BY created_at DESC";
                                $results = mysqli_query($conn, $selectBlogQuery);
                                if (mysqli_num_rows($results) > 0) {
                                    while ($selectBlogData = mysqli_fetch_assoc($results)) {
                                ?>
                                        <tr>
                                            <td><a href="javascript:void(0);" class="deleteStatus" data-id="<?= $selectBlogData['id'] ?>"><span class="bi bi-trash text-danger"></span></a></td>
                                            <td><?= $sn++; ?></td>
                                            <td><a href="<?= BASE_URL ?>edit-blog.php?id=<?= $selectBlogData['id'] ?>" style="text-decoration: none;"><?= $selectBlogData['title'] ?></a></td>
                                            <td><a href="<?= BASE_URL ?>blog-details-<?= $selectBlogData['url_slug']; ?>" target="_blank">Click Here</a></td>
                                            <td><?= $selectBlogData['orders'] ?></td>
                                            <td>
                                                <?php if ($selectBlogData['status'] == '1') { ?>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-success statusToggle" data-id="<?= $selectBlogData['id'] ?>">Active</a>
                                                <?php } else { ?>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger statusToggle" data-id="<?= $selectBlogData['id'] ?>">Inactive</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createBlogModal" tabindex="-1" aria-labelledby="createBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBlogModalLabel">Create Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="code/save_blog.php" id="blogForm" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="tags" class="mb-2 fw-2">Tags</label>
                                <div class="tags-input" id="tagsInput">
                                    <input type="text" name="tagInput" class="form-control" id="tagInput" placeholder="Add a tag">
                                </div>
                                <input type="hidden" name="tags" id="tagsHidden" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="title" class="mb-2 fw-2">Blog Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter blog Title..." />
                            </div>
                            <div class="col-sm-6">
                                <label for="category" class="mb-2 fw-2">Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Select Category</option>
                                    <?php
                                    $selectCategory = "SELECT * FROM categories where status = '1'";
                                    $selectCategoryQuery = mysqli_query($conn, $selectCategory);
                                    if (mysqli_num_rows($selectCategoryQuery) > 0) {
                                        while ($selectCategoryData = mysqli_fetch_assoc($selectCategoryQuery)) {
                                    ?>
                                            <option value="<?= $selectCategoryData['id'] ?>"><?= $selectCategoryData['title'] ?></option>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="NA" class="text-danger">No Category Found!</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="mb-2 fw-2" for="post-date">Post Date</label>
                                <input type="date" class="form-control" id="p-date" name="p-date" placeholder="Select post date" />
                            </div>
                            <div class="col-sm-6">
                                <label class="mb-2 fw-2" for="url-slug">URL Slug</label>
                                <input type="text" class="form-control" id="url-slug" name="url-slug" placeholder="Create url slug..." />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="description" class="mb-2 fw-2">Blog Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Write blog description..."></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="mb-2 fw-2" for="meta-title">Meta Title</label>
                                <input type="text" class="form-control" name="m-title" id="m-title" placeholder="Enter Meta Title..." />
                            </div>
                            <div class="col-sm-6">
                                <label class="mb-2 fw-2" for="meta-keyword">Meta Keyword</label>
                                <input type="text" class="form-control" name="m-keyword" id="m-keyword" placeholder="Enter Meta Keywords..." />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <label for="meta-description" class="mb-2 fw-2">Meta Description</label>
                                <textarea class="form-control" rows="3" name="m-description" id="m-description" placeholder="Write meta description..."></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 mb-2">
                                <label for="picture" class="mb-2 fw-2">Choose an image:</label>
                                <input type="file" class="form-control" name="picture" id="picture" onchange="previewImage();" />
                            </div>
                            <!-- Image Preview Section -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <img id="imagePreview" src="" alt="Image Preview" style="width: 100px; height: 100px; display: none;" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-check-label" for="inlineRadio1">Status : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="1">
                                    <label class="form-check-label" for="status1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status0" value="0">
                                    <label class="form-check-label" for="status0">Disable</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Sorting Order</span>
                                    <input type="number" class="form-control" name="s-order" id="s-order">
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
    include 'includes/footer.php';
?>