<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
        .signup-container input, .signup-container select {
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
        <form action="#">
            <label>
                <input type="radio" name="userType" value="citizen" onclick="toggleFormFields()"> Citizen
            </label>
            <label>
                <input type="radio" name="userType" value="expat" onclick="toggleFormFields()"> Expat
            </label>
            <div id="citizenFields" style="display:none;">
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
                <input type="text" name="tin" placeholder="TIN" required>
            </div>
            <div id="expatFields" style="display:none;">
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
                <input type="text" name="tin" placeholder="TIN" required>
                <input type="text" name="passport_number" placeholder="Passport Number" required>
            </div>
            <button type="submit">Update</button>
        </form>
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
