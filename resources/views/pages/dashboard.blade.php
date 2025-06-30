<div class="h-100">
     <style>
        .typing-indicator {
            animation: pulse 1.5s infinite;
            color: #9CA3AF;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

      
     </style>
     <div class="flex flex-col">
        <!-- Chat Messages Container -->
        <div id="chatContainer" style="max-height: 350px;overflow: scroll;" class="flex-1 overflow-y-auto overflow-x-hidden h-100 custom-scrollbar p-4 space-y-4">
            @if(!isset($chat))
                 <!-- Welcome Message -->
                <div id="welcomeMessage" class="flex flex-row justify-center mt-5">
                    <div class="max-w-3xl text-center">
                        <div class="py-3 px-3 bg-gray-600 rounded-xl inline-block mb-4">
                            <div class="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-gray-100 text-2xl font-bold">Hello! I'm your AI assistant. How can I help you today?</h3>
                    </div>
                </div>
                @else
                    <!-- Sample User Message -->
                    <div class="flex space-x-3 justify-end">
                        <div class="bg-blue-600 p-4 rounded-lg max-w-3xl">
                            <p class="text-white">{{ json_decode($chat->messages)?->payload}}</p>
                        </div>
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Sample AI Response -->
                    <div class="flex space-x-3">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
                            <p class="text-gray-100 mb-3">{{ json_decode($chat->messages)?->response}}</p>
                    </div>
            @endif
        </div>
        
        <!-- Input Area -->
        <div class="p-4 border-0 border-gray-600">
            <div class="flex space-x-4">
                <div class="flex-1 relative">
                    <textarea
                        type="text"
                        id="messageInput"
                        placeholder="Send a message..."
                        class="w-full bg-chat-input text-white p-4 pr-12 rounded-lg border border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all"
                        rows="1"
                        maxlength="600"
                    ></textarea>
                    <button
                        id="sendButton"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 p-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors disabled:bg-gray-600 disabled:cursor-not-allowed"
                    >
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2 text-center">AI can make mistakes. Consider checking important information.</p>
        </div>
    </div>

</div>
