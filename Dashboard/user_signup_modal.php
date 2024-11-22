<?php
require_once('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mysqli = connect();

    if (isset($_POST['register_citizen'])) {
        $user_name = $_SESSION['username'];
        $sql = "SELECT UserID FROM users WHERE username = '$user_name'";
        $user_id = $mysqli->query($sql)->fetch_assoc()['UserID'];


        $fullname = $_POST['fullname'];
        $dob = $_POST['dob'];
        $nationality = $_POST['nationality'];
        $maritalStatus = $_POST['marital_status'];
        $occupation = $_POST['occupation'];
        $presentAddress = $_POST['present_address'];
        $permanentAddress = $_POST['permanent_address'];
        $contactInfo = $_POST['contact_info'];
        $tin = $_POST['tin'];


        $sql = "INSERT INTO citizen (UserID, Fullname, DateOfBirth, Nationality, MaritalStatus, Occupation, addressPresent, addressPermanent, ContactInfo, TIN) VALUES ('$user_id', '$fullname', '$dob', '$nationality', '$maritalStatus', '$occupation', '$presentAddress', '$permanentAddress', '$contactInfo', '$tin')";

        if ($mysqli->query($sql) === TRUE) {

            $sql = "UPDATE users SET type = 'Citizen' WHERE UserID = '$user_id'";
            if ($mysqli->query($sql) === TRUE) {
                header('location: user.php');
            } else {
                echo "Error: " . $mysqli->error;
            }
        } else {
            echo "Error: " . $mysqli->error;
        }
    } else if (isset($_POST['register_expat'])) {
        $user_name = $_SESSION['username'];
        $sql = "SELECT UserID FROM users WHERE username = '$user_name'";
        $user_id = $mysqli->query($sql)->fetch_assoc()['UserID'];


        $fullname = $_POST['fullname'];
        $dob = $_POST['dob'];
        $nationality = $_POST['nationality'];
        $maritalStatus = $_POST['marital_status'];
        $occupation = $_POST['occupation'];
        $presentAddress = $_POST['present_address'];
        $permanentAddress = $_POST['permanent_address'];
        $contactInfo = $_POST['contact_info'];
        $tin = $_POST['tin'];
        $passportNumber = $_POST['passport_number'];


        $sql = "INSERT INTO citizen (UserID, Fullname, DateOfBirth, Nationality, MaritalStatus, Occupation, addressPresent, addressPermanent, ContactInfo, TIN) VALUES ('$user_id', '$fullname', '$dob', '$nationality', '$maritalStatus', '$occupation', '$presentAddress', '$permanentAddress', '$contactInfo', '$tin')";

        if ($mysqli->query($sql) === TRUE) {
            $sql = "INSERT INTO expat (UserID, PassportNumber) VALUES ('$user_id', '$passportNumber')";

            if ($mysqli->query($sql) === TRUE) {
                $sql = "UPDATE users SET type = 'Expat' WHERE UserID = '$user_id'";
                if ($mysqli->query($sql) === TRUE) {
                    header('location: user.php');
                } else {
                    echo "Error: " . $mysqli->error;
                }
            } else {
                echo "Error: " . $mysqli->error;
            }

            header('location: user.php');
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup Modal Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .signup-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .signup-container input,
        .signup-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .signup-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .signup-container button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <div>
            <label>
                <input type="radio" name="userType" value="citizen" onclick="toggleFormFields()"> Citizen
            </label>
            <label>
                <input type="radio" name="userType" value="expat" onclick="toggleFormFields()"> Expat
            </label>
            <form id="citizenFields" method="post" style="display:none;">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="date" name="dob" placeholder="Date of Birth" required>
                <input type="text" name="nationality" placeholder="Nationality" required>
                <select name="marital_status">
                    <option value="">Marital Status</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                </select>
                <input type="text" name="occupation" placeholder="Occupation" required>
                <input type="text" name="present_address" placeholder="Present Address" required>
                <input type="text" name="permanent_address" placeholder="Permanent Address" required>
                <input type="text" name="contact_info" placeholder="contact_info" required>
                <input type="text" name="tin" placeholder="TIN" required>
                <button type="submit" name="register_citizen">Update</button>
            </form>
            <form id="expatFields" method="post" style="display:none;">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="date" name="dob" placeholder="Date of Birth" required>
                <input type="text" name="nationality" placeholder="Nationality" required>
                <select name="marital_status">
                    <option value="">Marital Status</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                </select>
                <input type="text" name="occupation" placeholder="Occupation" required>
                <input type="text" name="present_address" placeholder="Present Address" required>
                <input type="text" name="permanent_address" placeholder="Permanent Address" required>
                <input type="text" name="contact_info" placeholder="contact_info" required>
                <input type="text" name="tin" placeholder="TIN" required>
                <input type="text" name="passport_number" placeholder="Passport Number" required>
                <button type="submit" name="register_expat">Update</button>
            </form>
        </div>
    </div>


    <script>
        function toggleFormFields() {
            var citizenFields = document.getElementById('citizenFields');
            var expatFields = document.getElementById('expatFields');

            if (document.querySelector('input[name="userType"]:checked').value === 'citizen') {
                citizenFields.style.display = 'block';
                expatFields.style.display = 'none';
            } else {
                citizenFields.style.display = 'none';
                expatFields.style.display = 'block';
            }
        }
    </script>
</body>

</html>