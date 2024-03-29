<div x-data="{type:'all'}" class="flex flex-col h-full overflow-hidden transition-all">
    <header class="sticky top-0 z-10 w-full px-3 py-2 bg white">
        <div class="flex items-center justify-between pb-2 border-b">

            <div class="flex items-center gap-2">
                <h5 class="text-2xl font-extrabold">Chats</h5>
            </div>
            <button>
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path
                        d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5m0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5m0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5" />
                </svg>
            </button>

        </div>

        {{-- filters --}}
        <div class="flex items-center gap-3 p-2 overflow-x-scroll bg-white">

            <button @click="type='all'" :class="{'bg-emerald-200 border-0 text-black':type=='all'}"
                class="inline-flex items-center justify-center px-3 py-1 font-medium border rounded-full gap-x-1 lg:px-5 lg:py-1">
                All
            </button>

            <button @click="type='deleted'" :class="{'bg-zinc-200 border-0 text-black':type=='deleted'}"
                class="inline-flex items-center justify-center px-3 py-1 font-medium border rounded-full gap-x-1 lg:px-5 lg:py-1">
                Deleted
            </button>

        </div>

    </header>

    <main class="relative h-full overflow-hidden overflow-y-scroll grow " style="contain:content">
        {{-- Chat List --}}
        <ul class="grid w-full p-2 spacey-y-2">

            @if ($conversations)

            @foreach ($conversations as $key => $conversation)

            <li
                class="relative flex w-full gap-4 px-2 py-3 transition-colors duration-150 cursor-pointer hover:bg-gray-50 rounded-2xl dark:hover:bg-gray-700/70'bg-gray-100/70 {{$conversation->id == $selectedConversation?->id ? 'bg-gray-100': ''}}">
                <a href="#" class="shrink-0">
                    <x-avatar src="https://source.unsplash.com/500x500?face-{{$key}}" />
                </a>

                <aside class="grid w-full grid-cols-12">

                    <a href="{{route('chat', $conversation->id)}}"
                        class="relative w-full col-span-11 p-1 pb-2 overflow-hidden leading-5 truncate border-b border-gray-200 flex-nowrap">
                        {{-- Chat Name and Date --}}
                        <div class="flex items-center justify-between w-full">
                            <h6 class="font-medium tracking-wider text-gray-900 truncate">
                                {{$conversation->getReceiver()->name}}
                            </h6>
                            <small
                                class="text-gray-700">{{$conversation->messages?->last()?->created_at->diffForHumans()
                                }}</small>
                        </div>

                        {{-- Chat Message --}}
                        <div class="flex items-center gap-x-2">

                           
                            @if ($conversation->messages?->last()?->sender_id == auth()->id())

                            @if ($conversation->isLastMessageReadByUser())
                            {{-- double tick --}}
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check2-all" viewBox="0 0 16 16">
                                    <path
                                        d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                                </svg>
                            </span>
                            @else
                            {{-- single tick --}}
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check2" viewBox="0 0 16 16">
                                    <path
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                                </svg>
                            </span>
                                
                            @endif
                                
                            @endif
                            

                            
                            <p class="grow truncate text-sm font-[100]">
                                {{$conversation->messages?->last()?->body?? 'Start a conversation...'}}
                            </p>

                            {{--- unread count --}}
                            @if ($conversation->unreadMessagesCount() > 0)
                            <span class="px-2 text-xs font-bold text-white rounded-full shrink-0 bg-emerald-700">
                                {{$conversation->unreadMessagesCount()}}
                            </span>
                            @endif
                            



                        </div>

                    </a>

                    {{-- dropdown --}}
                    <div class="flex flex-col col-span-1 my-auto text-center">

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="w-6 h-6 text-gray-700 bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>

                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <div class="w-full p-1">
                                    <button
                                        class="flex items-center w-full gap-3 px-4 py-2 text-sm leading-5 text-left text-gray-500 transition-all duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100">

                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                            </svg>
                                        </span>

                                        View Profile

                                    </button>

                                    <button
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    wire:click="deleteByUser('{{encrypt($conversation->id)}}')"
                                        class="flex items-center w-full gap-3 px-4 py-2 text-sm leading-5 text-left text-gray-500 transition-all duration-150 ease-in-out hover:bg-rose-100 focus:outline-none focus:bg-gray-100">

                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                            </svg>
                                        </span>

                                        Delete

                                    </button>
                                </div>


                            </x-slot>
                        </x-dropdown>

                    </div>

                </aside>

            </li>

            @endforeach

            @else

            @endif



        </ul>

    </main>

</div>