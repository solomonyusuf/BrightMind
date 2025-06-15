<div class="flex-1 flex flex-col bg-sidebar-bg">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-600">
                <div class="flex items-center space-x-3">
                    <button id="toggleSidebar" class="p-2 hover:bg-gray-700 rounded-lg transition-colors md:hidden">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gray-500 py-4 px-2 rounded-full flex items-center justify-center">
                            <img src="{{ asset('icon.png') }}" style="height:50px;" />
                        </div>
                        <div>
                            <h1 class="text-lg font-semibold">BrightMind</h1>
                            <p class="text-sm text-gray-400">AI Course Recommender</p>
                        </div>
                    </div>
                </div>
                <button class="p-2 hover:bg-gray-700 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>
                </button>
            </div>

            <!-- Chat Messages Container -->
            <div id="chatContainer" class="flex-1 overflow-y-auto custom-scrollbar p-4 space-y-4">
                <!-- Welcome Message -->
                <div class="flex space-x-3">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
                        <p class="text-gray-100">Hello! I'm your AI assistant. How can I help you today?</p>
                    </div>
                </div>

                <!-- Sample User Message -->
                <div class="flex space-x-3 justify-end">
                    <div class="bg-blue-600 p-4 rounded-lg max-w-3xl">
                        <p class="text-white">Can you explain quantum computing in simple terms?</p>
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
                        <p class="text-gray-100 mb-3">Quantum computing is like having a super-powered calculator that can explore many possibilities at once, rather than checking them one by one like traditional computers.</p>
                        <p class="text-gray-100 mb-3">Here's a simple analogy: Imagine you're in a maze trying to find the exit. A regular computer would try one path at a time until it finds the way out. A quantum computer could explore all possible paths simultaneously and find the best route much faster.</p>
                        <p class="text-gray-100">The key is that quantum computers use "qubits" instead of regular bits, which can exist in multiple states at once, allowing for this parallel processing power.</p>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-4 border-t border-gray-600">
                <div class="flex space-x-4">
                    <div class="flex-1 relative">
                        <input 
                            type="text" 
                            id="messageInput"
                            placeholder="Send a message..." 
                            class="w-full bg-chat-input text-white p-4 pr-12 rounded-lg border border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all"
                        >
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