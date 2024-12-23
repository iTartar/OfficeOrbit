<x-layout>
    <div x-data="{ 
        sidebarOpen: false, 
        activeMenu: 'notification',
        showAddModal: false,
        showEditModal: false,
        editingnotification: null,
    }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        
        <x-sidebar></x-sidebar>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">        
        <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
        <div class="flex flex-col flex-1 overflow-hidden">
            <x-header></x-header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-medium text-gray-700">Tabel Notification</h3>
                        <button @click="showAddModal = true" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">Add notification</button>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    @php
                                    $columns = [
                                        'id' => 'id',
                                        'nama' => 'nama',
                                        'type'=> 'type',
                                        'message'=> 'message'
                                    ];
                                    @endphp
                                    @foreach($columns as $column => $label)
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <div class="flex items-center gap-x-2">
                                                <a href="{{ route('notification.index', array_merge(request()->query(), [
                                                    'order_column' => $column,
                                                    'order_direction' => request('order_column') == $column && request('order_direction') == 'asc' ? 'desc' : 'asc'
                                                ])) }}"
                                                class="group inline-flex items-center gap-x-1">
                                                    {{ $label }}
                                                    <span class="ml-2 flex-none rounded text-blue-400">
                                                        @if(request('order_column') == $column)
                                                            @if(request('order_direction') == 'asc')
                                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                                                                </svg>
                                                            @else
                                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                                                </svg>
                                                            @endif
                                                        @else
                                                            <svg class="h-5 w-5 opacity-0 group-hover:opacity-100" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                                                            </svg>
                                                        @endif
                                                    </span>
                                                </a>
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($notifications as $notification)
                                @foreach ($users as  $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{ ($notifications->currentPage() - 1) * $notifications->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $user->nama }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $notification->type }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $notification->message }}</div>
                                        </td>
                                    </tr>
                                    @endforeach

                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-4 bg-gray-100">
                            <p>Showing {{ ($notifications->currentPage() - 1) * $notifications->perPage() + 1 }} to {{ ($notifications->currentPage() - 1) * $notifications->perPage() + count($notifications) }} of {{ $notifications->total() }} entries</p>
                            {{ $notifications->links()->withQuery([]) }}
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Modal Add notification -->
        <div x-show="showAddModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add Notification</h3>
                        <form action="{{ route('notification.store') }}" method="POST">
                            @csrf
                            <div class="mt-2">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                                <select class="js-example-basic-multiple" name="user_id" id="user_id" multiple="multiple" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                <select name="type" id="type" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Select Type</option>
                                    <option value="Announcement">Announcement</option>
                                    <option value="Notification">Notification</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                <textarea name="message" id="message" required rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                                <button type="button" @click="showAddModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                
        <script>
            new MultiSelectTag('user_id')
        </script></script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Clean URL function
            function cleanURL() {
                let currentURL = window.location.href;
                let url = new URL(currentURL);
                
                if(url.searchParams.get('page') === '1') {
                    url.searchParams.delete('page');
                    window.history.pushState({}, '', url.toString());
                }
            }

            cleanURL();

            document.querySelectorAll('.pagination a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    setTimeout(function() {
                        cleanURL();
                    }, 100);
                });
            });

            function changePagination() {
                const perPage = document.getElementById('per_page').value;
                fetch(`{{ route('notification.index') }}?per_page=${perPage}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('notifications-table').innerHTML = html;
                });
            }
        });
        </script>
    </div>
</x-layout>