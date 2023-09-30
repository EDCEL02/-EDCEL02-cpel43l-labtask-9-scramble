<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Jumbler</title>
    <!-- Optional: Bootstrap theme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="img/favicon.jpg">
</head>

<body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>WORD SCRAMBBLER</h1>
        <div class="form-group">
            <label for="word1">WORD 1:</label>
            <input type="text" class="form-control" id="word1" name="word1">
        </div>
        <div class="form-group">
            <label for="word2">WORD 2:</label>
            <input type="text" class="form-control" id="word2" name="word2">
        </div>
        <div class="form-group">
            <label for="word3">WORD 3:</label>
            <input type="text" class="form-control" id="word3" name="word3">
        </div>
        <div class="form-group">
            <label for="word4">WORD 4:</label>
            <input type="text" class="form-control" id="word4" name="word4">
        </div>
        
        <div class = "buttons">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <button type="reset" class="btn btn-secondary">Clear Form</button>
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();

        // Validate each word
        foreach (array('word1', 'word2', 'word3', 'word4') as $word) {
            if (empty($_POST[$word])) {
                $errors[$word] = "This field is required";
            } elseif (!preg_match('/^[a-zA-Z]+$/', $_POST[$word])) {
                $errors[$word] = "Only letters are allowed";
            } elseif (strlen($_POST[$word]) < 4 || strlen($_POST[$word]) > 7) {
                $errors[$word] = "Word length must be between 4 and 7 characters";
            }
        }

        // If no errors, jumble the words
        if (empty($errors)) {
            $jumbledWords = array();
            foreach (array('word1', 'word2', 'word3', 'word4') as $word) {
                $jumbledWords[$word] = strtoupper(str_shuffle($_POST[$word]));
            }

            // Display the jumbled words
            echo "<div class='output'>";
            foreach ($jumbledWords as $key => $value) {
                echo "<p>{$key}: {$value}</p>";
            }
            echo "</div>";
        } else {
            // Display error messages
            echo "<div class='error'>";
            foreach ($errors as $key => $value) {
                echo "Error for \"$key\": $value<br>";
            }
            echo "Please use the 'Back' button to re-enter the data.";
            echo "</div>";
        }
    }
    ?>

</body>
</html>