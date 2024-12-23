<x-layout>
    <div>    
        <div x-data="{ 
            sidebarOpen: false, 
            activeMenu: 'schedule', 
            showModal: false,
            showEditModal: false,
            formData: {
                date: '',
                shift: ''
            },
            editFormData: {
                id: '',
                shift: ''
            }
        }" class="flex h-screen bg-gray-200">
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
            <x-sidebar></x-sidebar>
            <div class="flex flex-col flex-1 overflow-hidden">
                <x-header></x-header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-8 mx-auto">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-3xl font-medium text-gray-700">Schedule Details</h3>
                            <button @click="showModal = true" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Add Schedule
                            </button>
                        </div>
                        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                            <h4 class="text-xl font-medium text-gray-700 mb-4">{{ $schedule->name }} - Effective Date: {{ $schedule->effective_date }}</h4>
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($scheduleDetails as $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-center">{{ $detail->date }}</td>
                                        <td class="px-6 py-4 text-center">{{ $detail->employee->name}}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <button @click="editFormData.id = '{{ $detail->id }}'; editFormData.shift = '{{ $detail->shift }}'; showEditModal = true" 
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded">
                                                    Edit
                                                </button>
                                                <form action="{{ route('schedule-details.destroy', $detail->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Add Modal -->
                        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="fixed inset-0 bg-black opacity-50"></div>
                                
                                <div class="relative bg-white rounded-lg w-full max-w-md p-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-medium">Add Schedule Detail</h3>
                                    </div>
                                    
                                    <form action="{{ route('schedule-details.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                            <input type="date" name="date" x-model="formData.date" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Shift</label>
                                            <select id="scheduleSelect" name="employee_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                <option value="" disabled selected>Select Shift</option>
                                                @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="flex justify-end space-x-3">
                                            <button type="button" @click="showModal = false"
                                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-500 text-white rounded-md text-sm font-medium hover:bg-blue-600">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="fixed inset-0 bg-black opacity-50"></div>
                                
                                <div class="relative bg-white rounded-lg w-full max-w-md p-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-medium">Edit Schedule Detail</h3>
                                    </div>
                                    
                                    <form x-bind:action="'/schedule-details/' + editFormData.id" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Shift</label>
                                            <select id="scheduleSelect" name="employee_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                <option value="" disabled selected>Select Shift</option>
                                                @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="flex justify-end space-x-3">
                                            <button type="button" @click="showEditModal = false"
                                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-500 text-white rounded-md text-sm font-medium hover:bg-blue-600">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-layout>