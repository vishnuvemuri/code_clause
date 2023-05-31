<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CAPTCHA
    if (isset($_POST["captcha"]) && $_SESSION["captcha_code"] === $_POST["captcha"]) {
        // CAPTCHA validation passed
        // Process the contact form data and send email

        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        // ... Perform necessary validations and processing ...
        // ... Send email with the form data ...

        // Redirect to a success page
        header("Location: success.html");
        exit;
    } else {
        // CAPTCHA validation failed
        $captcha_error = "Invalid CAPTCHA code. Please try again.";
    }
}

// Generate new CAPTCHA code
$captcha_code = substr(md5(uniqid(rand(), true)), 0, 6);
$_SESSION["captcha_code"] = $captcha_code;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form with CAPTCHA</title>
</head>
<body>
    <h2>Contact Form</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <div>
            <label for="captcha">CAPTCHA:</label>
            <input type="text" id="captcha" name="captcha" required>
            <img src="securimage_show.php" alt="CAPTCHA Image">
        </div>
        <?php if (isset($captcha_error)) echo "<p>$captcha_error</p>"; ?>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
