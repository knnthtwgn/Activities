<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Face App</h1>

    <form method="post" action="">
        <label for="photoSize">Selected Photo Size:</label>
        <input type="range" id="photoSize" name="photoSize" min="10" max="100" value="60" step="10" 
               oninput="document.getElementById('sizeOutput').value = this.value">
        <output id="sizeOutput">60</output><br><br>

        <label for="borderColor">Selected Border Color:</label>
        <input type="color" id="borderColor" name="borderColor" value="#000000"><br><br>

        <input type="submit" name="process" value="Process">
    </form>

    <?php
    // Use the selected photo size to scale from 150px as a default base size
    $baseSize = 150;  // Default base size
    $photoSize = isset($_POST['photoSize']) ? (int)$_POST['photoSize'] : 60;  // Retrieve slider value
    $finalSize = $baseSize * ($photoSize / 60);  // Scale based on default value of 60
    $borderColor = isset($_POST['borderColor']) ? htmlspecialchars($_POST['borderColor']) : '#000000';
    ?>

    <!-- Display the image preview with container size and color applied after form submission -->
    <div id="image-preview" style="border: 3px solid <?php echo $borderColor; ?>; 
        width: <?php echo $finalSize; ?>px; 
        height: <?php echo $finalSize; ?>px; 
        display: flex; align-items: center; justify-content: center; margin-top: 50px;">
        <img src="images/Profile.jpeg" alt="Static Image" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

</body>
</html>
