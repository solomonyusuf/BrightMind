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
                        'chat-bg': '#212121',
                        'sidebar-bg': '#181818',
                        'chat-input': '#303030',
                        'user-bg': '#343541',
                        'ai-bg': '#444654'
                    }
                }
            }
        }
    </script>
        <link
        href="{{ asset('css/supreme.css') }}"
        rel="stylesheet" />
    <style>
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: thin;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #080808;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #555;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #777;
        }
        body
        {
            font-family: 'Supreme-Regular', sans-serif;
            
        }
    </style>
    @livewireStyles
</head>
<body class="bg-chat-bg text-white  overflow-hidden">
    @include('sweetalert::alert')
    <div class="flex h-screen">
        <!-- Sidebar -->
        @livewire('shared.sidebar')

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col bg-chat-bg">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-600">
                <div class="flex items-center space-x-3">
                    {{-- <button id="toggleSidebar" class="p-2 hover:bg-gray-700 rounded-lg transition-colors md:hidden">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button> --}}
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gray-500 py-4 px-2 rounded-full flex items-center justify-center">
                            <img src="{{ asset('icon.png') }}" style="height:30px;" />
                        </div>
                        <div>
                            <h1 class="text-lg font-semibold">BrightMind</h1>
                            <p class="text-sm text-gray-400">AI Course Recommender</p>
                        </div>
                    </div>
                </div>
               <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="p-2 hover:bg-gray-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 top-full mt-2 w-40 bg-white rounded-md shadow-lg z-50">
                        <a href="{{ route('logout') }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Logout
                        </a>
                      
                    </div>
                </div>

            </div>

            {{ $slot }}
        </div>
        
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

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

        // function addMessage(content, isUser = false) {
        //     const messageDiv = document.createElement('div');
        //     messageDiv.className = `flex space-x-3 ${isUser ? 'justify-end' : ''}`;
            
        //     if (isUser) {
        //         messageDiv.innerHTML = `
        //             <div class="bg-blue-600 p-4 rounded-lg max-w-3xl">
        //                 <p class="text-white">${content}</p>
        //             </div>
        //             <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                 <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                     <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
        //                 </svg>
        //             </div>
        //         `;
        //     } else {
        //         messageDiv.innerHTML = `
        //             <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                 <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                     <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        //                 </svg>
        //             </div>
        //             <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
        //                 <p class="text-gray-100">${content}</p>
        //             </div>
        //         `;
        //     }
            
        //     chatContainer.appendChild(messageDiv);
            
        //     // Store message in current chat
        //     if (!chatData[currentChatId]) {
        //         chatData[currentChatId] = [];
        //     }
        //     chatData[currentChatId].push({ content, isUser });
            
        //     setTimeout(scrollToBottom, 100);
        // }

        // function simulateAIResponse() {
        //     const responses = [
        //         "I'd be happy to help you with that! Could you provide more details about what you're looking for?",
        //         "That's an interesting question. Let me break this down for you...",
        //         "Based on what you've asked, here are some key points to consider:",
        //         "I understand what you're asking. Here's my take on this topic:",
        //         "Great question! This is something that many people wonder about."
        //     ];
            
        //     const randomResponse = responses[Math.floor(Math.random() * responses.length)];
            
        //     // Simulate typing delay
        //     setTimeout(() => {
        //         addMessage(randomResponse, false);
        //     }, 1000 + Math.random() * 1000);
        // }

        // function sendMessage() {
        //     const message = messageInput.value.trim();
        //     if (message) {
        //         addMessage(message, true);
        //         messageInput.value = '';
        //         simulateAIResponse();
        //     }
        // }

        // function loadChat(chatId) {
        //     // Clear current chat
        //     chatContainer.innerHTML = '';
            
        //     // Load chat data or show welcome message
        //     if (chatId === 'current') {
        //         // Load default messages
        //         chatContainer.innerHTML = `
        //             <div class="flex space-x-3">
        //                 <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                     <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                         <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        //                     </svg>
        //                 </div>
        //                 <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
        //                     <p class="text-gray-100">Hello! I'm your AI assistant. How can I help you today?</p>
        //                 </div>
        //             </div>
        //             <div class="flex space-x-3 justify-end">
        //                 <div class="bg-blue-600 p-4 rounded-lg max-w-3xl">
        //                     <p class="text-white">Can you explain quantum computing in simple terms?</p>
        //                 </div>
        //                 <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                     <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                         <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
        //                     </svg>
        //                 </div>
        //             </div>
        //             <div class="flex space-x-3">
        //                 <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                     <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                         <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        //                     </svg>
        //                 </div>
        //                 <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
        //                     <p class="text-gray-100 mb-3">Quantum computing is like having a super-powered calculator that can explore many possibilities at once, rather than checking them one by one like traditional computers.</p>
        //                     <p class="text-gray-100 mb-3">Here's a simple analogy: Imagine you're in a maze trying to find the exit. A regular computer would try one path at a time until it finds the way out. A quantum computer could explore all possible paths simultaneously and find the best route much faster.</p>
        //                     <p class="text-gray-100">The key is that quantum computers use "qubits" instead of regular bits, which can exist in multiple states at once, allowing for this parallel processing power.</p>
        //                 </div>
        //             </div>
        //         `;
        //     } else {
        //         // Show placeholder for other chats
        //         chatContainer.innerHTML = `
        //             <div class="flex space-x-3">
        //                 <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                     <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                         <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        //                     </svg>
        //                 </div>
        //                 <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
        //                     <p class="text-gray-100">This is a previous chat. Start typing to continue the conversation!</p>
        //                 </div>
        //             </div>
        //         `;
        //     }
            
        //     // Load stored messages for this chat
        //     if (chatData[chatId]) {
        //         chatData[chatId].forEach(msg => {
        //             const messageDiv = document.createElement('div');
        //             messageDiv.className = `flex space-x-3 ${msg.isUser ? 'justify-end' : ''}`;
                    
        //             if (msg.isUser) {
        //                 messageDiv.innerHTML = `
        //                     <div class="bg-blue-600 p-4 rounded-lg max-w-3xl">
        //                         <p class="text-white">${msg.content}</p>
        //                     </div>
        //                     <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                         <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                             <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
        //                         </svg>
        //                     </div>
        //                 `;
        //             } else {
        //                 messageDiv.innerHTML = `
        //                     <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                         <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                             <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        //                         </svg>
        //                     </div>
        //                     <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
        //                         <p class="text-gray-100">${msg.content}</p>
        //                     </div>
        //                 `;
        //             }
        //             chatContainer.appendChild(messageDiv);
        //         });
        //     }
            
        //     scrollToBottom();
        // }

        // function createNewChat() {
        //     const newChatId = 'chat_' + Date.now();
        //     currentChatId = newChatId;
            
        //     // Clear chat container
        //     chatContainer.innerHTML = `
        //         <div class="flex space-x-3">
        //             <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
        //                 <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        //                     <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        //                 </svg>
        //             </div>
        //             <div class="bg-ai-bg p-4 rounded-lg max-w-3xl">
        //                 <p class="text-gray-100">Hello! I'm your AI assistant. How can I help you today?</p>
        //             </div>
        //         </div>
        //     `;
            
        //     // Update active chat in sidebar
        //     chatItems.forEach(item => item.classList.remove('active', 'bg-gray-700'));
            
        //     scrollToBottom();
        // }

        // Event listeners
        //sendButton.addEventListener('click', sendMessage);

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
        
    <script>
        class ChatSSE {
            constructor() {
                this.eventSource = null;
                this.currentMessageElement = null;
                this.isStreaming = false;
                this.init();
            }

            init() {
                const sendButton = document.getElementById('sendButton');
                const messageInput = document.getElementById('messageInput');
                
                sendButton.addEventListener('click', () => this.sendMessage());
                messageInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        this.sendMessage();
                    }
                });

                // Auto-resize textarea
                messageInput.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                });
            }

            sendMessage() {
                const messageInput = document.getElementById('messageInput');
                const message = messageInput.value.trim();
                
                if (!message || this.isStreaming) return;

                this.isStreaming = true;
                this.updateSendButton(true);

                // Hide welcome message
                const welcomeMessage = document.getElementById('welcomeMessage');
                if (welcomeMessage) {
                    welcomeMessage.style.display = 'none';
                }

                // Add user message to chat
                this.addUserMessage(message);
                
                // Clear input
                messageInput.value = '';
                messageInput.style.height = 'auto';

                // Start SSE connection
                this.startSSEStream(message);
            }

            addUserMessage(message) {
                const chatContainer = document.getElementById('chatContainer');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'flex justify-end mb-4';
                messageDiv.innerHTML = `
                    <div class="max-w-3xl bg-blue-600 text-white p-4 rounded-lg">
                        <div class="whitespace-pre-wrap">${this.escapeHtml(message)}</div>
                    </div>
                `;
                chatContainer.appendChild(messageDiv);
                this.scrollToBottom();
            }

            startSSEStream(message) {
                // Create AI message container
                this.createAIMessageContainer();

                // Establish SSE connection
                this.eventSource = new EventSource(`/stream-ai-response?message=${encodeURIComponent(message)}`);

                this.eventSource.addEventListener('stream-start', (event) => {
                    console.log('Stream started:', JSON.parse(event.data));
                });

                this.eventSource.addEventListener('message-chunk', (event) => {
                    const data = JSON.parse(event.data);
                    this.appendToAIMessage(data.content);
                });

                this.eventSource.addEventListener('stream-end', (event) => {
                    console.log('Stream ended:', JSON.parse(event.data));
                    this.closeSSEStream();
                });

                this.eventSource.addEventListener('error', (event) => {
                    console.error('SSE Error:', event);
                    const data = JSON.parse(event.data);
                    this.showError(data.message);
                    this.closeSSEStream();
                });

                this.eventSource.onerror = (event) => {
                    console.error('Connection error:', event);
                    this.closeSSEStream();
                };
            }

            createAIMessageContainer() {
                const chatContainer = document.getElementById('chatContainer');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'flex justify-start mb-4';
                messageDiv.innerHTML = `
                    <div class="max-w-3xl bg-gray-700 text-white p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-300">BrightMind</span>
                        </div>
                        <div id="ai-message-content" class="">
                            <span class="typing-indicator whitespace-pre-wrap">●●●</span>
                        </div>
                    </div>
                `;
                chatContainer.appendChild(messageDiv);
                const elements = document.querySelectorAll('[id="ai-message-content"]');
                this.currentMessageElement = elements[elements.length - 1];
                this.scrollToBottom();
            }

            appendToAIMessage(content) {
                if (!this.currentMessageElement) return;

                // Remove typing indicator on first content
                const typingIndicator = this.currentMessageElement.querySelector('.typing-indicator');
                if (typingIndicator) {
                    typingIndicator.remove();
                }

                // Append new content
                this.currentMessageElement.innerHTML += (' ' + content);
                this.scrollToBottom();
            }

            showError(message) {
                if (this.currentMessageElement) {
                    this.currentMessageElement.innerHTML = `
                        <div class="text-red-400">
                            <span class="text-sm">Error: ${this.escapeHtml(message)}</span>
                        </div>
                    `;
                }
            }

            closeSSEStream() {
                if (this.eventSource) {
                    this.eventSource.close();
                    this.eventSource = null;
                }
                this.isStreaming = false;
                this.updateSendButton(false);
                this.currentMessageElement = null;
            }

            updateSendButton(disabled) {
                const sendButton = document.getElementById('sendButton');
                const messageInput = document.getElementById('messageInput');
                
                sendButton.disabled = disabled;
                messageInput.disabled = disabled;
                
                if (disabled) {
                    sendButton.classList.add('opacity-50', 'cursor-not-allowed');
                    messageInput.classList.add('opacity-50');
                } else {
                    sendButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    messageInput.classList.remove('opacity-50');
                }
            }

            scrollToBottom() {
                const chatContainer = document.getElementById('chatContainer');
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }

            escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
        }

        // Initialize chat when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ChatSSE();
        });
    </script>
    
</body>
</html>