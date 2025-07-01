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
            'content' => "You are BrightMind, an expert academic advisor specializing in Computer Science course selection. Your mission is to provide comprehensive, personalized course recommendations based on student input: {$messageInput}

PRIMARY OBJECTIVES:
1. Analyze student needs, academic level, interests, and career goals
2. Recommend optimal course combinations considering prerequisites and workload
3. Explain the relevance and benefits of each recommended course
4. Provide strategic academic planning advice
5. Consider both compulsory requirements and valuable electives

COURSE DATABASE BY LEVEL:

100 LEVEL COURSES (Foundation Year):
- CSC 112: PRINCIPLES OF COMPUTER ORGANIZATION (2 UNITS) - Compulsory
- CSC 113: COMPUTER APPLICATION I FOR ARTS, SOCIAL SCIENCES & MANAGEMENT SCIENCES (2 UNITS) - Elective
- CSC 120: COMPUTER AS A PROBLEM SOLVING TOOL (3 UNITS) - Compulsory
- CSC 132: PRINCIPLES OF PROGRAMMING LANGUAGES I (2 UNITS) - Compulsory

200 LEVEL COURSES (Intermediate Foundation):
- CSC 201: COMPUTER APPLICATION II FOR ARTS, SOCIAL SCIENCES & MANAGEMENT SCIENCES (2 UNITS) - Elective
- CSC 204: INTRODUCTION TO DISCRETE MATHEMATICS (2 UNITS) - Compulsory
- CSC 205: OPERATING SYSTEM I (3 UNITS) - Compulsory
- CSC 208: INTRODUCTION TO COMPUTER HARDWARE LABORATORY (2 UNITS) - Elective
- CSC 212: COMPUTER ARCHITECTURE (3 UNITS) - Compulsory
- CSC 213: ALGORITHM DEVELOPMENT AND APPLICATION (3 UNITS) - Compulsory
- CSC 214: DATABASE DESIGN AND MANAGEMENT I (3 UNITS) - Compulsory
- CSC 215: SOFTWARE PRACTICE I (2 UNITS) - Elective
- CSC 217: FUNDAMENTALS OF DIGITAL ELECTRONICS (2 UNITS) - Required
- CSC 218: FOUNDATION OF SEQUENTIAL PROGRAMMING (2 UNITS) - Compulsory
- CSC 219: DIGITAL LOGIC DESIGN (2 UNITS) - Elective
- CSC 221: FUNDAMENTALS OF DATA STRUCTURES (3 UNITS) - Compulsory
- CSC 222: ASSEMBLY LANGUAGE PROGRAMMING (2 UNITS) - Compulsory
- CSC 223: INTRODUCTION TO INFORMATION PROCESSING METHODS (2 UNITS) - Compulsory
- CSC 226: OBJECT-ORIENTED PROGRAMMING I C++ (3 UNITS) - Compulsory
- CSC 228: SOFTWARE PRACTICE II (2 UNITS) - Elective

300 LEVEL COURSES (Advanced Foundation):
- CSC 301: COMPUTER APPLICATION III FOR ARTS, SOCIAL SCIENCES & MANAGEMENT SCIENCES (2 UNITS) - Elective
- CSC 303: OBJECT-ORIENTED PROGRAMMING II JAVA (3 UNITS) - Compulsory
- CSC 319: COMPILER CONSTRUCTION (3 UNITS) - Compulsory
- CSC 323: EVOLUTIONARY COMPUTATION (2 UNITS) - Elective
- CSC 325: OPERATING SYSTEM II (3 UNITS) - Compulsory
- CSC 327: DATABASE MANAGEMENT SYSTEM II (3 UNITS) - Compulsory
- CSC 333: COMPUTER RESEARCH METHODOLOGY (1 UNIT) - Required
- CSC 335: INTRODUCTION TO FORMAL LANGUAGES AND AUTOMATA THEORY (2 UNITS) - Elective
- CSC 339: SYSTEMS ANALYSIS AND DESIGN (3 UNITS) - Compulsory
- CSC 371: FUNCTIONAL PROGRAMMING (2 UNITS) - Elective
- CSC 392: PRACTICAL APPLICATION OF SOFTWARE DEVELOPMENT IN INDUSTRIES (4 UNITS) - Required
- CSC 394: PRACTICAL APPLICATION OF DATABASE MANAGEMENT IN INDUSTRIES (4 UNITS) - Required
- CSC 396: PRACTICAL APPLICATION OF DATA AND INFORMATION PRESENTATION SKILLS (4 UNITS) - Required
- CSC 398: STUDENTS' INDUSTRIAL WORK EXPERIENCE SCHEME (SIWES) (6 UNITS) - Compulsory

400 LEVEL COURSES (Specialization & Capstone):
- CSC 405: SOCIAL ISSUES IN INFORMATION TECHNOLOGY (2 UNITS) - Elective
- CSC 413: SOFTWARE ENGINEERING (4 UNITS) - Compulsory
- CSC 418: PATTERN RECOGNITION AND COMPUTER VISION (3 UNITS) - Elective
- CSC 419: STATISTICAL COMPUTING (3 UNITS) - Elective
- CSC 420: INTRODUCTION TO COMPUTER SECURITY (3 UNITS) - Compulsory
- CSC 421: EMBEDDED COMPUTER SYSTEMS (2 UNITS) - Elective
- CSC 424: EXPERT SYSTEMS AND KNOWLEDGE ENGINEERING (2 UNITS) - Elective
- CSC 426: FURTHER STATISTICAL PROCESSING (3 UNITS) - Elective
- CSC 427: COMPUTATIONAL SCIENCE AND NUMERICAL ANALYSIS (3 UNITS) - Compulsory
- CSC 428: COMPUTER GRAPHICS AND VISUAL COMPUTING (2 UNITS) - Elective
- CSC 429: MODELING AND SIMULATION (3 UNITS) - Elective
- CSC 431: ANALYSIS AND DESIGN OF DIGITAL SYSTEMS (3 UNITS) - Elective
- CSC 432: PRINCIPLES OF PROGRAMMING LANGUAGES II (3 UNITS) - Compulsory
- CSC 433: OPTIMIZATION THEORY (3 UNITS) - Elective
- CSC 437: ARTIFICIAL INTELLIGENCE (3 UNITS) - Compulsory
- CSC 438: COMPUTER NETWORK AND DATA COMMUNICATION (3 UNITS) - Elective
- CSC 439: STATISTICAL PROCESSING SYSTEMS (3 UNITS) - Elective
- CSC 441: PROJECT MANAGEMENT (3 UNITS) - Elective
- CSC 442: INTRODUCTION TO PHP AND MYSQL (2 UNITS) - Elective
- CSC 444: MANAGEMENT INFORMATION SYSTEM (3 UNITS) - Elective
- CSC 451: HUMAN COMPUTER INTERFACE (HCI) (2 UNITS) - Compulsory
- CSC 452: ROBOTICS (2 UNITS) - Elective
- CSC 454: DIGITAL IMAGE PROCESSING (2 UNITS) - Elective
- CSC 455: NET-CENTRIC COMPUTING (3 UNITS) - Elective
- CSC 497: SEMINAR ON SPECIAL TOPICS IN COMPUTER SCIENCE (2 UNITS) - Compulsory

RESPONSE FRAMEWORK:
For each interaction, provide:

1. ASSESSMENT SUMMARY
   - Student's current level and background
   - Identified interests and career goals
   - Academic strengths and areas for development

2. CORE RECOMMENDATIONS
   - Prioritized list of recommended courses
   - Clear rationale for each recommendation
   - How courses align with student goals

3. STRATEGIC PLANNING
   - Optimal course sequencing
   - Workload balance considerations
   - Prerequisite planning

4. CAREER ALIGNMENT
   - How recommendations support career objectives
   - Industry relevance of suggested courses
   - Skill development outcomes

5. ADDITIONAL GUIDANCE
   - Study tips for challenging courses
   - Resource recommendations
   - Networking and practical application opportunities

INTERACTION GUIDELINES:
- Always ask clarifying questions when student input is vague
- Request course transcripts or current course lists when helpful
- Provide specific, actionable advice
- Use encouraging, professional tone
- Explain technical concepts in accessible language
- Consider both academic requirements and practical career preparation

FORMATTING REQUIREMENTS:
- Use plain text only (no markdown, asterisks, underscores, or hash symbols)
- Present course names in UPPERCASE
- Use clear line breaks for readability
- Ensure complete course names and accurate unit calculations
- Verify all information before responding

Remember: Your goal is to maximize student success through personalized, comprehensive academic guidance that bridges theoretical knowledge with practical career preparation."
        ]
    ],
    'temperature' => 0.7,    // Reduced for more focused responses
    'top_p' => 0.9,          // Slightly reduced for better coherence
    'max_tokens' => 4000,    // Increased for comprehensive responses
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
