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
                include('auth.php');
                include('connection.php');

                if (!isset($_GET['id'])) {
                    die("ID not provided.");
                }

                $id = (int) $_GET['id'];
                $result = mysqli_query($conn, "SELECT * FROM tajmahal_tours WHERE id = $id");
                if (!$result || mysqli_num_rows($result) == 0) {
                    die("Record not found.");
                }
                $row = mysqli_fetch_assoc($result);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
                    $persons = mysqli_real_escape_string($conn, $_POST['persons']);
                    $places_covered = mysqli_real_escape_string($conn, $_POST['places_covered']);

                    // Optional image update
                    $image = $row['image'];
                    if (!empty($_FILES["image"]["name"])) {
                        $target_dir = "assets/img/packages/";
                        $file_name = basename($_FILES["image"]["name"]);
                        $target_file = $target_dir . $file_name;

                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $image = $target_file;
                        }
                    }

                    for ($i = 1; $i <= 17; $i++) {
                        ${"itinery_heading_$i"} = mysqli_real_escape_string($conn, $_POST["itinery_heading_$i"] ?? '');
                        ${"itinery_description_$i"} = mysqli_real_escape_string($conn, $_POST["itinery_description_$i"] ?? '');
                    }

                    for ($i = 1; $i <= 5; $i++) {
                        ${"highlight_$i"} = mysqli_real_escape_string($conn, $_POST["highlight_$i"] ?? '');
                    }

                    $update = "UPDATE tajmahal_tours SET
        title='$title',
        image='$image',
        description='$description',
        duration='$duration',
        persons='$persons',
        places_covered='$places_covered',";

                    for ($i = 1; $i <= 17; $i++) {
                        $update .= "itinery_heading_$i='${"itinery_heading_$i"}',
                    itinery_description_$i='${"itinery_description_$i"}',";
                    }

                    for ($i = 1; $i <= 5; $i++) {
                        $update .= "highlight_$i='${"highlight_$i"}',";
                    }

                    // Remove last comma
                    $update = rtrim($update, ',') . " WHERE id=$id";

                    if (mysqli_query($conn, $update)) {
                        echo "<p class='alert alert-success'>✅ Package updated successfully.</p>";
                        $result = mysqli_query($conn, "SELECT * FROM tajmahal_tours WHERE id = $id");
                        $row = mysqli_fetch_assoc($result);
                    } else {
                        echo "<p class='alert alert-danger'>❌ Error: " . mysqli_error($conn) . "</p>";
                    }
                }
                ?>

                <div class="container-fluid">
                    <form method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                value="<?= htmlspecialchars($row['title']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image Upload</label>
                            <input type="file" name="image" class="form-control">
                            <p>Current: <img src="<?= $row['image'] ?>" alt="" width="80"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"
                                rows="4"><?= htmlspecialchars($row['description']) ?></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Duration</label>
                                <input type="text" name="duration" class="form-control"
                                    value="<?= htmlspecialchars($row['duration']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Persons</label>
                                <input type="text" name="persons" class="form-control"
                                    value="<?= htmlspecialchars($row['persons']) ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Places Covered</label>
                            <textarea name="places_covered"
                                class="form-control"><?= htmlspecialchars($row['places_covered']) ?></textarea>
                        </div>

                        <h5 class="mt-4">Itinerary</h5>
                        <?php for ($i = 1; $i <= 17; $i++): ?>
                            <div class="mb-3">
                                <label class="form-label">Itinerary Heading <?= $i ?></label>
                                <input type="text" name="itinery_heading_<?= $i ?>" class="form-control"
                                    value="<?= htmlspecialchars($row["itinery_heading_$i"]) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Itinerary Description <?= $i ?></label>
                                <textarea name="itinery_description_<?= $i ?>" class="form-control"
                                    rows="3"><?= htmlspecialchars($row["itinery_description_$i"]) ?></textarea>
                            </div>
                        <?php endfor; ?>

                        <h5 class="mt-4">Highlights</h5>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="mb-3">
                                <label class="form-label">Highlight <?= $i ?></label>
                                <textarea name="highlight_<?= $i ?>" class="form-control"
                                    rows="2"><?= htmlspecialchars($row["highlight_$i"]) ?></textarea>
                            </div>
                        <?php endfor; ?>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Package</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container-fluid">

            </div>

        </div>

        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>