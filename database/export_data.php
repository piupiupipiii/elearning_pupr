<?php
// Export data from SQLite to JSON files

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Material;
use App\Models\Question;
use App\Models\UserProgress;
use App\Models\QuizScore;
use App\Models\UserAnswer;

$exportDir = __DIR__ . '/exports';

// Export each model
$exports = [
    'users' => User::all(),
    'materials' => Material::all(),
    'questions' => Question::all(),
    'user_progress' => UserProgress::all(),
    'quiz_scores' => QuizScore::all(),
    'user_answers' => UserAnswer::all(),
];

foreach ($exports as $name => $data) {
    $json = json_encode($data->toArray(), JSON_PRETTY_PRINT);
    file_put_contents("$exportDir/$name.json", $json);
    echo "Exported $name: " . $data->count() . " records\n";
}

echo "\nAll data exported to database/exports/\n";
