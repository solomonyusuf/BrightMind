<?php

namespace App\Livewire\Pages;

use App\Models\Chat;
use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Dashboard extends Component
{
    public $id;
    public $chat;
    public $streamedContent;
    public $processing = false;
    public $messages = [];
    public $messageInput = '';

    protected $rules = [
        'messageInput' => 'required|string'
    ];

    public function mount($id = null)
    {
        $this->id = $id;
        if($id)
        {
            $this->chat = Chat::find($id);
        }
    }
    public function sendMessage()
{
    $this->validate();
   
    $this->processing = true;
   
    $userMessage = [
        'role' => 'user',
        'content' => $this->messageInput
    ];
    
    // Add user message to messages array
    $this->messages[] = $userMessage;
    
    // Clear input field immediately
    $messageInput = $this->messageInput;
    $this->messageInput = '';
    
    // Dispatch browser event to start SSE connection
    $this->dispatch('start-sse-stream', messageId: uniqid());
    
    // Start SSE streaming in a separate process/job
    $this->streamAIResponse();
}

public function streamAIResponse()
{
    $messageInput = request()?->message;
    //session()->put('new', false)
    // Set headers for SSE
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Cache-Control');
    
    // Prevent output buffering
    if (ob_get_level()) {
        ob_end_clean();
    }
    
    $endpoint = env('GITHUB_MODEL_ENDPOINT');
    $apiKey = env('GITHUB_MODEL_KEY');
    $model = env('GITHUB_MODEL_NAME');
    
    $payload = [
    'model' => $model,
    'messages' => [
        [
            'role' => 'system', 
            'content' => "You are an AI assistant named BrightMind. Your main role is to help students by recommending viable courses to study based on this input {$messageInput}. 
                SEE COURSES:
                    100 Level Courses

                        CSC 112: PRINCIPLES OF COMPUTER ORGANIZATION (2 UNITS) - C,
                        CSC 113: COMPUTER APPLICATION I FOR ARTS SOCIAL SCIENCES & MANAGEMENT SCIENCES (2 UNITS),
                        CSC 120: COMPUTER AS A PROBLEM SOLVING TOOL (3 UNITS) - C,
                        CSC 132: PRINCIPLES OF PROGRAMMING LANGUAGES I (2 UNITS) - C,

                        200 Level Courses

                        CSC 201: COMPUTER APPLICATION II FOR ARTS SOCIAL SCIENCES & MANAGEMENT SCIENCES (2 UNITS),
                        CSC 204: INTRODUCTION TO DISCRETE MATHEMATICS (2 UNITS) - C,
                        CSC 205: OPERATING SYSTEM I (3 UNITS) - C,
                        CSC 208: INTRODUCTION TO COMPUTER HARDWARE LABORATORY (2 UNITS) - E,
                        CSC 212: COMPUTER ARCHITECTURE (3 UNITS) - C,
                        CSC 213: ALGORITHM DEVELOPMENT AND APPLICATION (3 UNITS) – C,
                        CSC 214: DATABASE DESIGN AND MANAGEMENT I (3 UNITS) - C,
                        CSC 215: SOFTWARE PRACTICE (2 UNITS),
                        CSC 217: FUNDAMENTAL OF DIGITAL ELECTRONICS (2 UNITS) - R,
                        CSC 218: FOUNDATION OF SEQUENTIAL PROGRAM (2 UNITS) - C,
                        CSC 219: DIGITAL LOGIC DESIGN (2 UNITS) - E,
                        CSC 221: FUNDAMENTALS OF DATA STRUCTURES (3 UNITS) - C,
                        CSC 222: ASSEMBLY LANGUAGE PROGRAMMING (2 UNITS) - C,
                        CSC 223: INTRODUCTION TO INFORMATION PROCESSING METHODS (2 UNITS) - C,
                        CSC 226: OBJECT-ORIENTED PROGRAMMING I C++ (3 UNITS) - C,
                        CSC 228: SOFTWARE PRACTICE II (2 UNITS),

                        300 Level Courses

                        CSC 301: COMPUTER APPLICATION III FOR ARTS SOCIAL SCIENCES & MANAGEMENT SCIENCES (2 UNITS),
                        CSC 303: OBJECT-ORIENTED PROGRAMMING II Java (3 UNITS) - C,
                        CSC 319: COMPILER CONSTRUCTION (3 UNITS) - C,
                        CSC 323: EVOLUTIONARY COMPUTATION (2 UNITS) - E,
                        CSC 325: OPERATING SYSTEM II (3 UNITS) - C,
                        CSC 327: DATABASE MANAGEMENT SYSTEM II (3 UNITS) - C,
                        CSC 333: COMPUTER RESEARCH METHODOLOGY (1 Unit) - R,
                        CSC 335: INTRODUCTION TO FORMAL LANGUAGES AND AUTOMATA THEORY (2 UNITS) - E,
                        CSC 339: SYSTEMS ANALYSIS AND DESIGN (3 UNITS) - C,
                        CSC 371: FUNCTIONAL PROGRAMMING: (2 Units) - E,
                        CSC 392: PRACTICAL APPLICATION OF SOFTWARE DEVELOPMENT IN INDUSTRIES (4 UNITS) - R,
                        CSC 394: PRACTICAL APPLICATION OF DATABASE MANAGEMENT IN INDUSTRIES (4 UNITS) - R,
                        CSC 396: PRACTICAL APPLICATION OF DATA AND INFORMATION PRESENTATION SKILLS (4 UNITS) - R,
                        CSC 398: STUDENTS' INDUSTRIAL WORK EXPERIENCE SCHEME (SIWES) (6 UNITS) - C,

                        400 Level Courses

                        CSC 405: SOCIAL ISSUES IN INFORMATION TECHNOLOGY (2 UNITS) - E,
                        CSC 413: SOFTWARE ENGINEERING (4 UNITS) - C,
                        CSC 418: PATTERN RECOGNITION AND COMPUTER VISION (3 UNITS) - E,
                        CSC 419: STATISTICAL COMPUTING (3 UNITS) - E,
                        CSC 420: INTRODUCTION TO COMPUTER SECURITY (3 UNITS) - C,
                        CSC 421: EMBEDDED COMPUTER SYSTEMS (2 UNITS) - E,
                        CSC 424: EXPERT SYSTEMS AND KNOWLEDGE ENGINEERING (2 UNITS) - E,
                        CSC 426: FURTHER STATISTICAL PROCESSING (3 UNITS) - E,
                        CSC 427: COMPUTATIONAL SCIENCE AND NUMERICAL ANALYSIS (3 UNITS) - C,
                        CSC 428: COMPUTER GRAPHICS AND VISUAL COMPUTING (2 UNITS) - E,
                        CSC 429: MODELING AND SIMULATION (3 UNITS) - E,
                        CSC 431: ANALYSIS AND DESIGN OF DIGITAL SYSTEM (3 UNITS) - E,
                        CSC 432: PRINCIPLES OF PROGRAMMING LANGUAGES II (3 UNITS) - C,
                        CSC 433: OPTIMIZATION THEORY (3 UNITS) - E,
                        CSC 437: ARTIFICIAL INTELLIGENCE (3 UNITS) - C,
                        CSC 438: COMPUTER NETWORK AND DATA COMMUNICATION (3 UNITS) - E,
                        CSC 439: STATISTICAL PROCESSING SYSTEMS (3 UNITS) - E,
                        CSC 441: PROJECT MANAGEMENT (3 UNITS),
                        CSC 442: INTRODUCTION TO PHP AND MYSQL (2 UNITS) - E,
                        CSC 444: MANAGEMENT INFORMATION SYSTEM,
                        CSC 451: HUMAN COMPUTER INTERFACE (HCI) (2 UNITS) - C,
                        CSC 452: ROBOTICS: (2 UNITS) - E,
                        CSC 454: DIGITAL IMAGE PROCESSING (2 UNITS) - E,
                        CSC 455: NET-CENTRIC COMPUTING (3 UNITS) - E,
                        CSC 497: SEMINAR ON SPECIAL TOPICS IN COMPUTER SCIENCE (2 UNITS) - C,

                        Legend

                        C = Compulsory
                        E = Elective
                        R = Required

                IMPORTANT FORMATTING RULES:
                - Respond in plain text only, no markdown formatting
                - Do not use asterisks (*), underscores (_), or hash symbols (#) for emphasis
                - Dont make me wonder, accomplish and follow instructions
                - Sometimes ask for their list of courses to help users make a good choice.
                - Use line breaks for readability but avoid special formatting characters
                - Present information in a natural, readable format suitable for direct display to user
                - when writing the courses use Uppercase to write them
                - Before responding, verify All course names are complete, Unit calculations are correct , Sentences are properly formed
                - I do not need to recorrect or reinstruct you to do the right thing
                "
                        ]
                    ],
                    'temperature' => 1.0, 
                    'top_p' => 1.0,       
                    'max_tokens' => 2000,  
                    'stream' => true
                ];
    
    

    try {
        // Initialize cURL for streaming
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $endpoint,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
                'Accept: text/event-stream'
            ],
            CURLOPT_WRITEFUNCTION => [$this, 'handleStreamData'],
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        
        // Send initial event
        $this->sendSSEData('stream-start', ['status' => 'connected']);
        
        // Execute the streaming request
        curl_exec($ch);
           
        Chat::create([
                'user_id' => auth()?->user()?->id,
                'messages'=> json_encode([
                    'payload'=> $messageInput,
                    'response'=> $this->streamedContent
                ])
            ]);
            
        if (curl_error($ch)) {
            $this->sendSSEData('error', ['message' => curl_error($ch)]);
        }
        
        curl_close($ch);
        
        // Send completion event
        $this->sendSSEData('stream-end', ['status' => 'completed']);
     
       
    } catch (Exception $e) {
        $this->sendSSEData('error', ['message' => $e->getMessage()]);
    } finally {
        $this->processing = false;
    }
}

private function handleStreamData($ch, $data)
{
    // Parse the streaming data
    $lines = explode("\n", $data);
    
    foreach ($lines as $line) {
        $line = trim($line);
        
        if (strpos($line, 'data: ') === 0) {
            $jsonData = trim(substr($line, 6));
            
            if ($jsonData === '[DONE]') {
                return strlen($data);
            }
            
            $decoded = json_decode($jsonData, true);
            
            if (isset($decoded['choices'][0]['delta']['content'])) {
                $content = $decoded['choices'][0]['delta']['content'];
                  $this->streamedContent .= $content;
                // Send the content chunk via SSE
                $this->sendSSEData('message-chunk', [
                    'content' => $content,
                    'timestamp' => time()
                ]);
                
                // Flush output immediately
                flush();
            }
        }
    }
    
    return strlen($data);
}

private function sendSSEData($event, $data)
{
    echo "event: {$event}\n";
    echo "data: " . json_encode($data) . "\n\n";
    flush();
}

    public function render()
    {
        return view('pages.dashboard')->layout('shared.main');
    }
}
