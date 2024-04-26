<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Brygada+1918:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/tiny-slider.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/flatpickr.min.css">
    <link rel="stylesheet" href="css/glightbox.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
        }

        .container {
            margin-top: 50px;
            text-align: center;
        }

        h2 {
            color: #007bff;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

<div class="container" data-aos="fade-up" data-aos-delay="200" style="text-align: center; padding: 50px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); position: relative; overflow: hidden;">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have established a MySQLi connection
    $host = "localhost";
    $username = "mintu";
    $password = "mintu@15";
    $database = "mintu";

    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the selected class from the form
    $selected_class = $_POST["tourist_class"];

    // Map class values to labels (adjust as per your data)
    $class_labels = [
        '0' => 'South India',
        '2' => 'North India',
        '4' => 'East India',
        '5' => 'West India',
        // Add more mappings as needed
    ];

    // Get the corresponding label for the selected class
    $selected_class_label = isset($class_labels[$selected_class]) ? $class_labels[$selected_class] : $selected_class;
    $top_count = isset($_POST['top_count']) ? intval($_POST['top_count']) : 5; // Default to 5 if not provided
    // Query to fetch top 5 places according to popularity for the selected class
    $sql = "SELECT `COL 1`, `COL 2`,`COL 5`, `COL 8` FROM clustered_data_with_images WHERE `COL 7` = '$selected_class' ORDER BY `COL 2` DESC LIMIT $top_count";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display the top 5 places with images
        echo "<h2>Top $top_count Places to visit in $selected_class_label:</h2>";
        echo "<ul>";
        $index = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li data-aos='fade-up' data-aos-delay='" . (200 * $index) . "'>";
            echo "<strong>{$row['COL 1']}</strong>, {$row['COL 5']} <br>";
            echo "<img src='{$row['COL 8']}' alt='{$row['COL 1']} Image' width='2000' ><br>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No results found for the selected class.";
    }

    mysqli_close($conn);
}
?>
    </div>

    <!-- AOS JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        AOS.init();
    </script>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/rellax.js"></script>
    <script src="js/flatpickr.js"></script>
    <script src="js/glightbox.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
