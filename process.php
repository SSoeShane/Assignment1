<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input); 
    return $input;
}

$errors = [];
$data = []; 

// Check if the form was actually submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // First Name
    if (empty($_POST["fname"])) {
        $errors["fname"] = "First Name is required.";
    } else {
        $data["fname"] = sanitize_input($_POST["fname"]);
    }

    // Last Name
    if (empty($_POST["lname"])) {
        $errors["lname"] = "Last Name is required.";
    } else {
        $data["lname"] = sanitize_input($_POST["lname"]);
    }

    // Father's Name
    if (empty($_POST["father"])) {
        $errors["father"] = "Father's Name is required.";
    } else {
        $data["father"] = sanitize_input($_POST["father"]);
    }

    $dob_day = $_POST["day"];
    $dob_month = $_POST["month"];
    $dob_year = $_POST["year"];

    if (empty($dob_day) || empty($dob_month) || empty($dob_year)) {
        $errors["dob"] = "Day, Month, and Year are required for Date of Birth.";
    } else {
        $data["dob"] = sanitize_input($dob_day) . "-" . sanitize_input($dob_month) . "-" . sanitize_input($dob_year);
    }

    // Mobile Number
    if (empty($_POST["mobile"])) {
        $errors["mobile"] = "Mobile Number is required.";
    } else {
        $data["mobile"] = sanitize_input($_POST["mobile"]);
    }

    // Email
    if (empty($_POST["email"])) {
        $errors["email"] = "Email is required.";
    } else {
        $data["email"] = sanitize_input($_POST["email"]);
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Invalid email format.";
        }
    }

    // Password
    if (empty($_POST["password"])) {
        $errors["password"] = "Password is required.";
    } else {
        $data["password_display"] = "********";
    }

    // Gender 
    $gender_value = $_POST["gender"]; 

    if (empty($gender_value)) {
        $errors["gender"] = "Gender is required.";
    } else {
        $data["gender"] = sanitize_input($gender_value);
    }

    // Department
    $department_value = $_POST["department"]; 

    if (empty($department_value)) {
        $errors["department"] = "Department is required.";
    } else {
        $data["department"] = sanitize_input($department_value);
    }

    // Course
    if (empty($_POST["course"])) {
        $errors["course"] = "Course is required.";
    } else {
        $data["course"] = sanitize_input($_POST["course"]);
    }

    // City
    if (empty($_POST["city"])) {
        $errors["city"] = "City is required.";
    } else {
        $data["city"] = sanitize_input($_POST["city"]);
    }

    // Address
    if (empty($_POST["address"])) {
        $errors["address"] = "Address is required.";
    } else {
        $data["address"] = sanitize_input($_POST["address"]);
    }

} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Submission Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Form Submission Result</h1>
        <?php if (!empty($errors)):?>
            <?php
            
            foreach ($errors as $error_key => $error_message) {
                echo "<p class=\"error\">" . ucfirst($error_message) . "</p>";
            }
            echo "<br>";

            echo "<div class=\"result-item\">Name: " . (isset($data["fname"]) ? $data["fname"] : "") . " " . (isset($data["lname"]) ? $data["lname"] : "") . "</div>";
            echo "<div class=\"result-item\">Father's Name: " . (isset($data["father"]) ? $data["father"] : "") . "</div>";
            echo "<div class=\"result-item\">DOB: " . (isset($data["dob"]) && !empty($data["dob"]) ? $data["dob"] : "") . "</div>";
            echo "<div class=\"result-item\">Mobile: " . (isset($data["mobile"]) ? "+95-" . $data["mobile"] : "+95-") . "</div>";
            echo "<div class=\"result-item\">Email: " . (isset($data["email"]) ? $data["email"] : "") . "</div>";
            echo "<div class=\"result-item\">Password: " . (isset($data["password_display"]) ? $data["password_display"] : "") . "</div>";
            echo "<div class=\"result-item\">Gender: " . (isset($data["gender"]) ? $data["gender"] : "") . "</div>";
            echo "<div class=\"result-item\">Department: " . (isset($data["department"]) ? $data["department"] : "") . "</div>";
            echo "<div class=\"result-item\">Course: " . (isset($data["course"]) ? $data["course"] : "") . "</div>";
            echo "<div class=\"result-item\">City: " . (isset($data["city"]) ? $data["city"] : "") . "</div>";
            echo "<div class=\"result-item\">Address: " . (isset($data["address"]) ? $data["address"] : "") . "</div>";

        else: //
            ?>
            <div class="result-item">Name: <?php echo $data["fname"] . " " . $data["lname"]; ?></div>
            <div class="result-item">Father's Name: <?php echo $data["father"]; ?></div>
            <div class="result-item">DOB: <?php echo $data["dob"]; ?></div>
            <div class="result-item">Mobile: +95-<?php echo $data["mobile"]; ?></div>
            <div class="result-item">Email: <?php echo $data["email"]; ?></div>
            <div class="result-item">Gender: <?php echo $data["gender"]; ?></div>
            <div class="result-item">Department: <?php echo $data["department"]; ?></div>
            <div class="result-item">Course: <?php echo $data["course"]; ?></div>
            <div class="result-item">City: <?php echo $data["city"]; ?></div>
            <div class="result-item">Address: <?php echo $data["address"]; ?></div>
            <div class="result-item">Password: <?php echo $data["password_display"]; ?></div>
        <?php endif; ?>

        <div class="back-button-container">
            <a href="index.php" class="go-back-button">Go Back</a>
        </div>
    </div>
</body>
</html>