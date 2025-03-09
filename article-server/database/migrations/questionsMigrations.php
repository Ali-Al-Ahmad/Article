<?php

$sql = "CREATE TABLE IF NOT EXISTS questions (
      id INT AUTO_INCREMENT PRIMARY KEY,
      question TEXT NOT NULL,
      answer TEXT NOT NULL
);
";

if (!$conn->query($sql)) {
  echo "Error creating questions table: " . $conn->error . "\n";
}
