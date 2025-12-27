<?php
include('auth.php');
include('connection.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar -->
        <?php include('aside.php') ?>

        <!--  Main Content -->
        <div class="body-wrapper">

            <!--  Header -->
            <?php include('header.php') ?>

            <div class="container-fluid">
                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // File upload path
                    $target_dir = "assets/img/packages/";
                    $file_name = basename($_FILES["image"]["name"]);
                    $target_file = $target_dir . $file_name;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Validate image
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if ($check === false) {
                        die("Error: Uploaded file is not an image.");
                    }

                    $allowed = ["jpg", "jpeg", "png", "gif", "webp", "svg"];
                    if (!in_array($imageFileType, $allowed)) {
                        die("Error: Only JPG, JPEG, PNG, GIF, WEBP, and SVG files are allowed.");
                    }

                    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        die("Error uploading image.");
                    }

                    // Sanitize and insert into DB
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
                    $persons = mysqli_real_escape_string($conn, $_POST['persons']);
                    $places_covered = mysqli_real_escape_string($conn, $_POST['places_covered']);
                    for ($i = 1; $i <= 17; $i++) {
                        ${"itinery_heading_$i"} = mysqli_real_escape_string($conn, $_POST["itinery_heading_$i"] ?? '');
                        ${"itinery_description_$i"} = mysqli_real_escape_string($conn, $_POST["itinery_description_$i"] ?? '');
                    }
                    $itinery_description_1 = mysqli_real_escape_string($conn, $_POST['itinery_description_1']);

                    for ($i = 1; $i <= 5; $i++) {
                        ${"highlight_$i"} = mysqli_real_escape_string($conn, $_POST["highlight_$i"] ?? '');
                    }

                    // Prepare the query with placeholders for dynamic values
                    $query = "INSERT INTO golden_triangle (
    title, image, description, duration, persons, places_covered,
    itinery_heading_1, itinery_description_1, highlight_1,
    itinery_heading_2, itinery_description_2, highlight_2,
    itinery_heading_3, itinery_description_3, highlight_3,
    itinery_heading_4, itinery_description_4, highlight_4,
    itinery_heading_5, itinery_description_5, highlight_5,
    itinery_heading_6, itinery_description_6,
    itinery_heading_7, itinery_description_7,
    itinery_heading_8, itinery_description_8,
    itinery_heading_9, itinery_description_9,
    itinery_heading_10, itinery_description_10,
    itinery_heading_11, itinery_description_11,
    itinery_heading_12, itinery_description_12,
    itinery_heading_13, itinery_description_13,
    itinery_heading_14, itinery_description_14,
    itinery_heading_15, itinery_description_15,
    itinery_heading_16, itinery_description_16,
    itinery_heading_17, itinery_description_17
) VALUES (
    '$title', '$target_file', '$description', '$duration', '$persons', '$places_covered',
    '$itinery_heading_1', '$itinery_description_1', '$highlight_1',
    '$itinery_heading_2', '$itinery_description_2', '$highlight_2',
    '$itinery_heading_3', '$itinery_description_3', '$highlight_3',
    '$itinery_heading_4', '$itinery_description_4', '$highlight_4',
    '$itinery_heading_5', '$itinery_description_5', '$highlight_5',
    '$itinery_heading_6', '$itinery_description_6',
    '$itinery_heading_7', '$itinery_description_7',
    '$itinery_heading_8', '$itinery_description_8',
    '$itinery_heading_9', '$itinery_description_9',
    '$itinery_heading_10', '$itinery_description_10',
    '$itinery_heading_11', '$itinery_description_11',
    '$itinery_heading_12', '$itinery_description_12',
    '$itinery_heading_13', '$itinery_description_13',
    '$itinery_heading_14', '$itinery_description_14',
    '$itinery_heading_15', '$itinery_description_15',
    '$itinery_heading_16', '$itinery_description_16',
    '$itinery_heading_17', '$itinery_description_17'
)";


                    if (mysqli_query($conn, $query)) {
                        echo "<p class='alert alert-success'>✅ Record inserted successfully.</p>";
                    } else {
                        echo "<p class='alert alert-danger'>❌ Error: " . mysqli_error($conn) . "</p>";
                    }
                }
                ?>

                <div class="container-fluid">
                    <form method="POST" action="" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
                        <!-- Basic Info -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image Upload</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Duration</label>
                                <input type="text" name="duration" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Persons</label>
                                <input type="text" name="persons" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Places Covered</label>
                            <textarea name="places_covered" class="form-control" rows="2" required></textarea>
                        </div>

                        <!-- Itinerary -->
                        <h5 class="mt-4">Itinerary</h5>
                        <?php for ($i = 1; $i <= 17; $i++): ?>
                            <div class="mb-3">
                                <label class="form-label">Itinerary Heading <?= $i ?></label>
                                <input type="text" name="itinery_heading_<?= $i ?>" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Itinerary Description <?= $i ?></label>
                                <textarea name="itinery_description_<?= $i ?>" class="form-control" rows="3"
                                    ></textarea>
                            </div>
                        <?php endfor; ?>

                        <!-- Highlight -->
                        <h5 class="mt-4">Highlight</h5>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="mb-3">
                                <label class="form-label">Highlight <?= $i ?></label>
                                <textarea name="highlight_<?= $i ?>" class="form-control" rows="2" ></textarea>
                            </div>
                        <?php endfor; ?>


                        <!-- Submit -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit Form</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="container-fluid">
                <h3 class="mt-5">Existing Packages</h3>
                <?php
include('connection.php');
$result = mysqli_query($conn, "SELECT * FROM golden_triangle ORDER BY id DESC");
?>

<div class="table-responsive mt-4">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Duration</th>
                <th>Persons</th>
                <th>Places Covered</th>
                <th>Itinerary</th>
                <th>Highlights</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td>
                    <?php if (!empty($row['image'])): ?>
                        <img src="<?= htmlspecialchars($row['image']) ?>" alt="Image" width="100">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['duration']) ?></td>
                <td><?= htmlspecialchars($row['persons']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['places_covered'])) ?></td>
                <td>
                    <ul>
                        <?php for ($i = 1; $i <= 17; $i++): ?>
                            <?php
                                $head = htmlspecialchars($row["itinery_heading_$i"]);
                                $desc = nl2br(htmlspecialchars($row["itinery_description_$i"]));
                                if (!empty($head) || !empty($desc)):
                            ?>
                                <li><strong><?= $head ?>:</strong> <?= $desc ?></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                </td>
                <td>
                    <ul>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php $hl = nl2br(htmlspecialchars($row["highlight_$i"])); ?>
                            <?php if (!empty($hl)): ?>
                                <li><?= $hl ?></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                </td>
                <td>
                    <a href="edit-golden-triangle.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                    <a href="delete-golden-triangle.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>


            </div>

        </div>

        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>