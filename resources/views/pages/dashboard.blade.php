<div>
    <!-- Chat Messages Container -->
<div id="chatContainer" class="flex-1 overflow-y-auto custom-scrollbar p-4 space-y-4">
    <!-- Welcome Message -->
    <div class="flex flex-row justify-center mt-5">
        <div class="max-w-3xl">
            <img src="{{ asset('logo.png') }}" class="py-3 px-3 bg-gray-600 rounded-xl" style="height:80px;" />
            <h3 style="font-family: 'Supreme-Bold' ;" class="text-gray-100 text-2xl mt-2">Hello! I'm your AI assistant. How can I help you today?</h3>
        </div>
    </div>
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