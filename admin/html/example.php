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
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    <?php include('aside.php') ?>

    <div class="body-wrapper">
        <?php include('header.php') ?>

        <div class="container-fluid">
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $target_dir = "assets/img/demo/";
                $file_name = basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $file_name;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Validate image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check === false) {
                    echo "<p class='alert alert-danger'>❌ Uploaded file is not an image.</p>";
                } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif", "webp", "svg"])) {
                    echo "<p class='alert alert-danger'>❌ Only JPG, JPEG, PNG, GIF, WEBP, and SVG are allowed.</p>";
                } elseif (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "<p class='alert alert-danger'>❌ Error uploading image.</p>";
                } else {
                    // Sanitize inputs
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
                    $persons = mysqli_real_escape_string($conn, $_POST['persons']);
                    $places_covered = mysqli_real_escape_string($conn, $_POST['places_covered']);

                    // Itineraries
                    $itinerary = [];
                    for ($i = 1; $i <= 17; $i++) {
                        $heading = mysqli_real_escape_string($conn, $_POST["itinery_heading_$i"] ?? '');
                        $desc = mysqli_real_escape_string($conn, $_POST["itinery_description_$i"] ?? '');
                        $itinerary["itinery_heading_$i"] = $heading;
                        $itinerary["itinery_description_$i"] = $desc;
                    }

                    // Highlights
                    $highlights = [];
                    for ($i = 1; $i <= 5; $i++) {
                        $highlight = mysqli_real_escape_string($conn, $_POST["highlight_$i"] ?? '');
                        $highlights["highlight_$i"] = $highlight;
                    }

                    // Prepare the INSERT query
                    $columns = "title, image, description, duration, persons, places_covered";
                    $values = "'$title', '$target_file', '$description', '$duration', '$persons', '$places_covered'";

                    foreach ($itinerary as $key => $val) {
                        $columns .= ", $key";
                        $values .= ", '$val'";
                    }

                    foreach ($highlights as $key => $val) {
                        $columns .= ", $key";
                        $values .= ", '$val'";
                    }

                    $query = "INSERT INTO pilgrimage_package ($columns) VALUES ($values)";

                    if (mysqli_query($conn, $query)) {
                        echo "<p class='alert alert-success'>✅ Record inserted successfully.</p>";
                    } else {
                        echo "<p class='alert alert-danger'>❌ Error: " . mysqli_error($conn) . "</p>";
                    }
                }
            }
            ?>

            <!-- Form Section -->
            <form method="POST" action="" enctype="multipart/form-data" class="bg-white p-4 shadow rounded mb-5">
                <h4 class="mb-3">Add New Pilgrimage Package</h4>

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

                <!-- Itinerary Fields -->
                <h5 class="mt-4">Itinerary</h5>
                <?php for ($i = 1; $i <= 17; $i++): ?>
                    <div class="mb-2">
                        <label class="form-label">Heading <?= $i ?></label>
                        <input type="text" name="itinery_heading_<?= $i ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description <?= $i ?></label>
                        <textarea name="itinery_description_<?= $i ?>" class="form-control" rows="2"></textarea>
                    </div>
                <?php endfor; ?>

                <!-- Highlight Fields -->
                <h5 class="mt-4">Highlights</h5>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="mb-3">
                        <label class="form-label">Highlight <?= $i ?></label>
                        <textarea name="highlight_<?= $i ?>" class="form-control" rows="2"></textarea>
                    </div>
                <?php endfor; ?>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Submit Package</button>
                </div>
            </form>

            <!-- Existing Packages -->
            <h4>Existing Packages</h4>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM pilgrimage_package ORDER BY id DESC");
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td>
                                <?php if (!empty($row['image'])): ?>
                                    <img src="<?= htmlspecialchars($row['image']) ?>" width="100" alt="Image">
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
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</body>
</html>
