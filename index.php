<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kalkulator Cinta</title>
</head>
<body>
    <div class="container">
        <h1>Kalkulator Cinta</h1>

        <form method="POST" action="">
            <label for="name1">Nama Anda:</label>
            <input type="text" id="name1" name="name1" required>
            
            <label for="name2">Nama Pasangan:</label>
            <input type="text" id="name2" name="name2" required>
            
            <button type="submit">Hitung Kecocokan</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name1 = strtolower(trim($_POST['name1']));
            $name2 = strtolower(trim($_POST['name2']));

            // Menghitung skor kecocokan
            $score = calculateLoveScore($name1, $name2);
            $message = getLoveMessage($score);
            echo "<h2>Hasil Kecocokan: $score%</h2>";
            echo "<p>$message</p>";
        }

        function calculateLoveScore($name1, $name2) {
            // Hitung bobot huruf
            $weight = [
                'a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5,
                'f' => 6, 'g' => 7, 'h' => 8, 'i' => 9, 'j' => 10,
                'k' => 11, 'l' => 12, 'm' => 13, 'n' => 14, 'o' => 15,
                'p' => 16, 'q' => 17, 'r' => 18, 's' => 19, 't' => 20,
                'u' => 21, 'v' => 22, 'w' => 23, 'x' => 24, 'y' => 25,
                'z' => 26
            ];

            // Hitung skor berdasarkan bobot huruf
            $score1 = calculateWeightedScore($name1, $weight);
            $score2 = calculateWeightedScore($name2, $weight);

            // Gabungkan kedua skor
            $finalScore = ($score1 + $score2) % 100;
            return round($finalScore);
        }

        function calculateWeightedScore($name, $weight) {
            $score = 0;
            for ($i = 0; $i < strlen($name); $i++) {
                $char = $name[$i];
                if (isset($weight[$char])) {
                    $score += $weight[$char];
                }
            }
            return $score;
        }

        function getLoveMessage($score) {
            if ($score >= 80) {
                return "Cinta sejati! Anda berdua sangat cocok!";
            } elseif ($score >= 60) {
                return "Cocok! Ada banyak kesamaan di antara kalian.";
            } elseif ($score >= 40) {
                return "Ada potensi, tetapi perlu usaha lebih.";
            } else {
                return "Mungkin perlu dipikirkan kembali. Cinta tidak selalu mudah!";
            }
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <p id="credit">&copy; 2025 <a href="https://www.instagram.com/bayu_ritonga">Bayu Ritonga</a>.</p>
    </footer>

    <script>
        document.getElementById('credit').contentEditable = false;
    </script>
</body>
</html>