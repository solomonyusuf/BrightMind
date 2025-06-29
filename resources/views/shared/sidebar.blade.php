<div id="sidebar" class="hidden md:block w-64 bg-sidebar-bg border-r border-gray-600 flex flex-col transition-transform duration-300 ease-in-out">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-gray-600">
                <a wire:navigate href="{{ route('dashboard') }}" class="w-full flex items-center justify-center space-x-2 bg-transparent border border-gray-600 hover:bg-gray-700 text-white p-3 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>New Chat</span>
                </a>
            </div>

            <!-- Chat History -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                <div class="space-y-1" id="chatHistory">
                   
                    @if(isset($recent))
                    <!-- Recent Chats -->
                    <div class="text-xs font-semibold text-gray-400 px-3 py-2">Recent</div>
                   @foreach ($recent as $data)
                        <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors active" data-chat-id="current">
                        <a wire:navigate href="{{ route('chat', $data->id) }}" class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">{{ Str::limit(json_decode($data->messages)?->payload, 30,'...') }}</span>
                        </a>
                    </div>
                   @endforeach
                   @endif
                    
                    

                    @if(isset($yesterday))
                    <!-- Yesterday -->
                    <div class="text-xs font-semibold text-gray-400 px-3 py-2 mt-4">Yesterday</div>
                     @foreach ($yesterday as $data)
                        <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors active" data-chat-id="current">
                        <a wire:navigate href="{{ route('chat', $data->id) }}" class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">{{ Str::limit(json_decode($data->messages)?->payload, 30,'...') }}</span>
                        </a>
                    </div>
                   @endforeach
                    @endif
                    
                   @if(isset($previous))
                    <!-- Previous 7 days -->
                    <div class="text-xs font-semibold text-gray-400 px-3 py-2 mt-4">Previous 7 days</div>
                     @foreach ($previous as $data)
                        <div class="chat-item px-3 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors active" data-chat-id="current">
                        <a wire:navigate href="{{ route('chat', $data->id) }}" class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.97 8.97 0 01-4.906-1.455L3 21l2.455-5.094A8.97 8.97 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"/>
                            </svg>
                            <span class="text-sm truncate">{{ Str::limit(json_decode($data->messages)?->payload, 30,'...') }}</span>
                        </a>
                    </div>
                   @endforeach
                   @endif
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-gray-600">
              <div x-data="{ open: false }" class="relative">
                <div @click="open = !open" class="flex items-center space-x-3 p-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-colors">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <img src="{{ asset($user->image) }}" class="w-8 h-8 rounded-full object-cover" />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">{{ $user->first_name.' '.$user->last_name}}</p>
                        <p class="text-xs text-gray-400">User Account</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false" 
                    class="absolute right-0 top-0 w-40 bg-white rounded-md shadow-lg z-50"
                    style="transform: translateY(-100%);">
                    <a href="{{ route('logout') }}" 
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Logout
                    </a>
                  
                </div>
            </div>


            </div>
        </div>
