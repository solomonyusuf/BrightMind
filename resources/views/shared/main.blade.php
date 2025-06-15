<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrightMind Chat Interface</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'chat-bg': '#343541',
                        'sidebar-bg': '#202123',
                        'chat-input': '#40414f',
                        'user-bg': '#343541',
                        'ai-bg': '#444654'
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #2d2d30;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #555;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #777;
        }
    </style>
    @livewireStyles
</head>
<body class="bg-chat-bg text-white font-sans overflow-hidden">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-sidebar-bg border-r border-gray-600 flex flex-col transition-transform duration-300 ease-in-out">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-gray-600">
                <button id="newChatBtn" class="w-full flex items-center justify-center space-x-2 bg-transparent border border-gray-600 hover:bg-gray-700 text-white p-3 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>New Chat</span>
                </button>
            </div>

            <!-- Chat History -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                <div class="space-y-1" id="chatHistory">
                    <!-- Recent Chats -->
                    <div class="text-xs font-semibold text-gray-400 px-3 py-2">Recent</div>
                    <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors active" data-chat-id="current">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">Quantum Computing Explanation</span>
                        </div>
                    </div>
                    <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors" data-chat-id="chat1">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">JavaScript Best Practices</span>
                        </div>
                    </div>
                    <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors" data-chat-id="chat2">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">Recipe for Chocolate Cake</span>
                        </div>
                    </div>

                    <!-- Yesterday -->
                    <div class="text-xs font-semibold text-gray-400 px-3 py-2 mt-4">Yesterday</div>
                    <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors" data-chat-id="chat3">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">Python Data Analysis</span>
                        </div>
                    </div>
                    <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors" data-chat-id="chat4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">Travel Planning Tips</span>
                        </div>
                    </div>

                    <!-- Previous 7 days -->
                    <div class="text-xs font-semibold text-gray-400 px-3 py-2 mt-4">Previous 7 days</div>
                    <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors" data-chat-id="chat5">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">Machine Learning Basics</span>
                        </div>
                    </div>
                    <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors" data-chat-id="chat6">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">CSS Grid Layout Guide</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-gray-600">
                <div class="flex items-center space-x-3 p-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">User</p>
                        <p class="text-xs text-gray-400">Free Plan</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Main Chat Area -->
        {{ $slot }}
    </div>

    @livewireScripts
    <script>
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const chatContainer = document.getElementById('chatContainer');
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const newChatBtn = document.getElementById('newChatBtn');
        const chatItems = document.querySelectorAll('.chat-item');

        // Chat data storage
        const chatData = {};
        let currentChatId = 'current';

        function scrollToBottom() {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function addMessage(content, isUser = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex space-x-3 ${isUser ? 'justify-end' : ''}`;
            
            if (isUser) {
                messageDiv.innerHTML = `
                    <div class="bg-blue-600 p-4 rounded-lg max-w-3xl">
                        <p class="text-white">${content}</p>
                    </div>
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
                        <p class="text-gray-100">${content}</p>
                    </div>
                `;
            }
            
            chatContainer.appendChild(messageDiv);
            
            // Store message in current chat
            if (!chatData[currentChatId]) {
                chatData[currentChatId] = [];
            }
            chatData[currentChatId].push({ content, isUser });
            
            setTimeout(scrollToBottom, 100);
        }

        function simulateAIResponse() {
            const responses = [
                "I'd be happy to help you with that! Could you provide more details about what you're looking for?",
                "That's an interesting question. Let me break this down for you...",
                "Based on what you've asked, here are some key points to consider:",
                "I understand what you're asking. Here's my take on this topic:",
                "Great question! This is something that many people wonder about."
            ];
            
            const randomResponse = responses[Math.floor(Math.random() * responses.length)];
            
            // Simulate typing delay
            setTimeout(() => {
                addMessage(randomResponse, false);
            }, 1000 + Math.random() * 1000);
        }

        function sendMessage() {
            const message = messageInput.value.trim();
            if (message) {
                addMessage(message, true);
                messageInput.value = '';
                simulateAIResponse();
            }
        }

        function loadChat(chatId) {
            // Clear current chat
            chatContainer.innerHTML = '';
            
            // Load chat data or show welcome message
            if (chatId === 'current') {
                // Load default messages
                chatContainer.innerHTML = `
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
                `;
            } else {
                // Show placeholder for other chats
                chatContainer.innerHTML = `
                    <div class="flex space-x-3">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
                            <p class="text-gray-100">This is a previous chat. Start typing to continue the conversation!</p>
                        </div>
                    </div>
                `;
            }
            
            // Load stored messages for this chat
            if (chatData[chatId]) {
                chatData[chatId].forEach(msg => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `flex space-x-3 ${msg.isUser ? 'justify-end' : ''}`;
                    
                    if (msg.isUser) {
                        messageDiv.innerHTML = `
                            <div class="bg-blue-600 p-4 rounded-lg max-w-3xl">
                                <p class="text-white">${msg.content}</p>
                            </div>
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        `;
                    } else {
                        messageDiv.innerHTML = `
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
                                <p class="text-gray-100">${msg.content}</p>
                            </div>
                        `;
                    }
                    chatContainer.appendChild(messageDiv);
                });
            }
            
            scrollToBottom();
        }

        function createNewChat() {
            const newChatId = 'chat_' + Date.now();
            currentChatId = newChatId;
            
            // Clear chat container
            chatContainer.innerHTML = `
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
            `;
            
            // Update active chat in sidebar
            chatItems.forEach(item => item.classList.remove('active', 'bg-gray-700'));
            
            scrollToBottom();
        }

        // Event listeners
        sendButton.addEventListener('click', sendMessage);

        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        messageInput.addEventListener('input', function() {
            sendButton.disabled = !this.value.trim();
        });

        // Sidebar toggle for mobile
        toggleSidebar.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
        });

        // New chat button
        newChatBtn.addEventListener('click', createNewChat);

        // Chat item clicks
        chatItems.forEach(item => {
            item.addEventListener('click', function() {
                const chatId = this.dataset.chatId;
                currentChatId = chatId;
                
                // Update active state
                chatItems.forEach(ci => ci.classList.remove('active', 'bg-gray-700'));
                this.classList.add('active', 'bg-gray-700');
                
                // Load the selected chat
                loadChat(chatId);
            });
        });

        // Initial state
        sendButton.disabled = true;
        scrollToBottom();

        // Responsive sidebar handling
        function handleResize() {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Initial call
    </script>
</body>
</html>