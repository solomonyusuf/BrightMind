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

        $query = Course::get();

        if ($category) {
                $array = $this->generateCourse($category, $query);

                $this->videos = []; // initialize as empty array

                foreach ($array as $data) {
                    $course = Course::find($data['id']);
                    if ($course) {
                        $this->videos[] = $course; // append to the videos array
                    }
                }
            } else {
                $this->videos = $query;
            }

    }

    public function generateCourse($category, $courses)
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
    You are an expert course recommender. From the given course list below, return only courses that match the category or level: {$category}.
    If none match, return an empty JSON array.

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
            'temperature' => 0.7,
            'top_p' => 0.9,
            'max_tokens' => 1000,
            'stream' => false // Turn OFF streaming for easy parsing
        ];

        try {
            $response = Http::withToken($apiKey)
                ->post($endpoint, $payload);

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
