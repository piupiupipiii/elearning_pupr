<?php
// Import data from JSON files to MySQL

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$exportDir = __DIR__ . '/exports';

// Disable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=0');

// Import users
$users = json_decode(file_get_contents("$exportDir/users.json"), true);
foreach ($users as $user) {
    DB::table('users')->insert($user);
}
echo "Imported users: " . count($users) . " records\n";

// Import materials
$materials = json_decode(file_get_contents("$exportDir/materials.json"), true);
foreach ($materials as $material) {
    DB::table('materials')->insert($material);
}
echo "Imported materials: " . count($materials) . " records\n";

// Import questions
$questions = json_decode(file_get_contents("$exportDir/questions.json"), true);
foreach ($questions as $question) {
    // Convert options array to JSON string if needed
    if (is_array($question['options'])) {
        $question['options'] = json_encode($question['options']);
    }
    DB::table('questions')->insert($question);
}
echo "Imported questions: " . count($questions) . " records\n";

// Import user_progress
$progress = json_decode(file_get_contents("$exportDir/user_progress.json"), true);
foreach ($progress as $p) {
    DB::table('user_progress')->insert($p);
}
echo "Imported user_progress: " . count($progress) . " records\n";

// Import quiz_scores
$scores = json_decode(file_get_contents("$exportDir/quiz_scores.json"), true);
foreach ($scores as $score) {
    DB::table('quiz_scores')->insert($score);
}
echo "Imported quiz_scores: " . count($scores) . " records\n";

// Import user_answers
$answers = json_decode(file_get_contents("$exportDir/user_answers.json"), true);
foreach ($answers as $answer) {
    DB::table('user_answers')->insert($answer);
}
echo "Imported user_answers: " . count($answers) . " records\n";

// Re-enable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=1');

echo "\nAll data imported to MySQL!\n";
