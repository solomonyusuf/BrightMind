<?php

namespace App\Livewire\Pages;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Http;


class AllCourses extends Component
{
    public $videos;

    
    public function mount()
    {
        $category = request()?->category;
        $level = request()?->level;

        $query = Course::get();

        if ($category) {
                $array = $this->generateCourse($category, $level, $query);

                $this->videos = []; // initialize as empty array

                if(isset($array)){
                foreach ($array as $data) {
                    $course = Course::find($data['id']);
                    if ($course) {
                        $this->videos[] = $course; // append to the videos array
                    }
                }
            }
            } else {
                $this->videos = $query;
            }

    }

    public function generateCourse($category, $level, $courses)
    {
        $endpoint = env('GITHUB_MODEL_ENDPOINT');
        $apiKey = env('GITHUB_MODEL_KEY');
        $model = env('GITHUB_MODEL_NAME');

        // Prepare course titles
        $courseArray = $courses->map(function ($course) {
            return ['id' => $course->id, 'title' => $course->title];
        })->toArray();

        // Proper JSON encoding
        $courseJson = json_encode($courseArray);

       $payload = [
    'model' => $model,
    'messages' => [
        [
            'role' => 'system',
            'content' => "
                    You are an expert course recommender. From the given course list below, return only the courses that match either the category '{$category}' or the difficulty level '{$level}' (e.g., easy, medium, hard, difficult).

                    If no courses match, return an empty JSON array.

                    Course List:
                    {$courseJson}

                    Respond ONLY with a valid JSON array like:
                    [
                    {
                        \"id\": 123,
                        \"title\": \"Course Title\"
                    }
                    ]
                    "
                            ]
                        ],
                        'temperature' => 1.0,
                        'top_p' => 1.0,
                        'max_tokens' => 1000,
                        'stream' => false
                    ];

        try {
            
            $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                            ])->post($endpoint, $payload);

            if ($response->successful()) {
                $result = $response->json();
                $message = $result['choices'][0]['message']['content'] ?? '[]';
                return json_decode($message, true); // convert JSON string to array
            } else {
                logger()->error('Model API error', ['response' => $response->body()]);
                return [];
            }
        } catch (\Exception $e) {
            logger()->error('Model call failed', ['message' => $e->getMessage()]);
            return [];
        }
    }


    public function render()
    {
        return view('pages.all-courses')->layout('shared.main');
    }
}
