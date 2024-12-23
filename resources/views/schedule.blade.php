<x-layout>
    <div x-data="{ 
            sidebarOpen: false, 
            activeMenu: 'schedule', 
            showAddModal: false, 
            showEditModal: false, 
            editingSchedule: null,
            editingScheduleName: '',
            editingScheduleDate: ''
        }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        
        <x-sidebar></x-sidebar>

        <div class="flex flex-col flex-1 overflow-hidden">
            <x-header></x-header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-4 sm:px-6 lg:px-8 py-8 mx-auto">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                        <h3 class="text-2xl sm:text-3xl font-medium text-gray-700 mb-4 sm:mb-0">Table Schedule</h3>
                        <button @click="showAddModal = true" class="w-full sm:w-auto px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">Add Schedule</button>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div >
                        <table class="w-full ">
            <thead class="bg-gray-50">
                <tr>
                    @php
                        $columns = [
                            	'id'=> 'id',    
			    	            'name'=>'name',
				                'effective_date' =>'effective_date'
                        ];
                    @endphp
                    @foreach($columns as $column => $label)
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-x-2">
                                <a href="{{ route('schedule.index', array_merge(request()->query(), [
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
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($schedules as $schedule)
                <tr class="hover:bg-gray-50">
                    <td class="px-6py-4 whitespace-nowrap text-center">
                        {{($schedules->currentPage()-1) *$schedules->perPage()+$loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $schedule->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $schedule->effective_date }}
                    </td>

                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('schedule.show', $schedule->id) }}" class="bg-purple-500 hover:bg-purple-600 text-white py-1 px-3 rounded text-sm w-full sm:w-auto text-center">Assign</a>
                    <button 
                            @click="showEditModal = true; editingschedule = {{ json_encode($schedule) }}" 
                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                                Edit
                    </button>
                        <form action="{{ route('schedule.destroy', $schedule) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-300">
                            Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        No schedules found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
                        </div>
                        <div class="bg-white px-4 sm:px-6 py-3 border-t border-gray-200">
                            @if($schedules->count() > 0)
                                <div class="text-sm text-gray-700">
                                    Showing {{ $schedules->firstItem() }} to {{ $schedules->lastItem() }} of {{ $schedules->total() }} entries
                                </div>
                                {{ $schedules->links() }}
                            @else
                                <div class="text-sm text-gray-700">
                                    No schedules found
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>

            <!-- Modal Add Schedule -->
             <div x-show="showAddModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="add-modal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium">Add Schedule</h3>
                        <div class="mt-2 px-7 py-3">
                            <input type="text" name="name" placeholder="Schedule Name..." class="w-full px-3 py-2 border rounded-md mb-3" required>
                            <input type="date" name="effective_date" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button type="button" @click="showAddModal = false" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 mr-2">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-24">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

            <!-- Modal Edit Schedule -->
             <div x-show="showEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="edit-modal">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <form :action="'/schedule/' + editingSchedule" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-3 text-center">
                            <h3 class="text-lg leading-6 font-medium">Edit Schedule</h3>
                            <div class="mt-2 px-7 py-3">
                            <input type="text" name="name" x-model="editingScheduleName" placeholder="Schedule Name..." class="w-full px-3 py-2 border rounded-md mb-3" required>
                            <input type="date" name="effective_date" x-model="editingScheduleDate" class="w-full px-3 py-2 border rounded-md" required>
                            </div>
                            <div class="items-center px-4 py-3">
                                <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 mr-2">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-24">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </div>
</x-layout>