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
                'content' => "You are an AI assistant named BrightMind. Your main role is to help students by recommending viable courses to study based on their input. 

                    IMPORTANT FORMATTING RULES:
                    - Respond in markdown formatting
                    - Do not use asterisks (*), underscores (_), or hash symbols (#) for emphasis
                    - Do not use bullet points with symbols, use simple dashes or numbers instead
                    - Write in clear, conversational paragraphs
                    - Sometimes ask for their list of courses to help users make a good choice.
                    - Use line breaks for readability but avoid special formatting characters
                    - Allow and add html formatting so it can render on my page
                    - Present information in a natural, readable format suitable for direct display to users"
                            ],
                            [
                                'role' => 'user', 
                                'content' => $messageInput
                            ],
                        ],
                        'temperature' => 0.7, 
                        'top_p' => 0.9,       
                        'max_tokens' => 500,  
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
