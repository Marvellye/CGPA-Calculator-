<!DOCTYPE html>
<html>
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LWMFHFNMYM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LWMFHFNMYM');
</script>
    <title>CGPA Calculator</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
        }
        h1 {
            color: brown;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type="number"] {
            width: 80%;
            max-width: 300px;
            height: 40px;
            margin-bottom: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 80%;
            max-width: 300px;
            height: 40px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        p {
            margin-top: 20px;
        }
        .checkbox {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }
        .checkbox input[type="checkbox"] {
            margin-right: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CGPA Calculator</h1>
        <form method="post">
            <?php
            $num_courses = isset($_GET['num_courses']) ? intval($_GET['num_courses']) : 8;
            for ($i = 1; $i <= $num_courses; $i++) {
                echo '<input type="number" name="score[]" placeholder="Score ' . $i . '" min="0" max="100" required>';
            }
            ?>
            <div class="checkbox">
                <input type="checkbox" id="extra_course" name="extra_course" <?php if ($num_courses == 9) echo 'checked'; ?>>
                <label for="extra_course">I offer 9 courses</label>
            </div>
            <input type="submit" name="submit" value="Calculate">
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $scores = $_POST['score'];
            $total = 0;
            $count = 0;
            foreach ($scores as $score) {
                if ($score >= 70) {
                    $total += 4.5;
                } elseif ($score >= 60) {
                    $total += 3.5;
                } elseif ($score >= 50) {
                    $total += 2.5;
                } elseif ($score >= 45) {
                    $total += 1.5;
                } elseif ($score >= 40) {
                    $total += 1.0;
                }
                $count++;
            }
            $average_cgpa = $total / $count;
            echo '<p>Average CGPA: ' . number_format($average_cgpa, 2) . '</p>';
            if ($average_cgpa >= 4.0) {
                echo '<p>Grade: A</p>';
            } elseif ($average_cgpa >= 3.0) {
                echo '<p>Grade: B</p>';
            } elseif ($average_cgpa >= 2.0) {
                echo '<p>Grade: C</p>';
            } else {
                echo '<p>Grade: E</p>';
            }
        }
        ?>
    </div>
    <script>
        document.getElementById("extra_course").addEventListener("change", function() {
            if (this.checked) {
                window.location.href = "index.php?num_courses=9";
            } else {
                window.location.href = "index.php?num_courses=8";
            }
        });
    </script>
</body>
</html>
