<x-layout>
    <div x-data="{ 
        sidebarOpen: false, 
        activeMenu: 'employee',
        showAddModal: false,
        showEditModal: false,
        editingEmployee: false,
    }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        
        <!-- Sidebar - Tidak diubah -->
        <x-sidebar></x-sidebar>
        
        <div class="flex flex-col flex-1 overflow-hidden">
            <x-header></x-header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-medium text-gray-700">Tabel Shift</h3>
                        <button @click="showAddModal = true" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">Add Shift</button>
                    </div>

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAME</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">START HOUR</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">END HOUR</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($employees as $index => $employee)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employees->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->start_hour }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->end_hour }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button @click="showEditModal = true; editingEmployee = {{ json_encode($employee) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-sm">Edit</button>
                                        <form action="{{ route('employee.destroy', $employee) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">No employees found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            @if($employees->count() > 0)
                                <div class="text-sm text-gray-700">
                                    Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} entries
                                </div>
                                {{ $employees->links() }}
                            @else
                                <div class="text-sm text-gray-700">
                                    No employees found
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Modal Tambah Karyawan -->
        <div x-show="showAddModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah Karyawan</h3>
                        <form action="{{ route('employee.store') }}" method="POST">
                            @csrf
                            <div class="mt-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                                <input type="text" name="name" id="name" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="mt-2">
                                <label for="start_hour" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                <input type="time" name="start_hour" id="start_hour" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="mt-2">
                                <label for="end_hour" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                <input type="time" name="end_hour" id="end_hour" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Simpan</button>
                                <button type="button" @click="showAddModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit Karyawan -->
        <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Karyawan</h3>
                        <form x-bind:action="'/employee/' + editingEmployee.id" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mt-2">
                                <label for="edit_name" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                                <input type="text" name="name" id="edit_name" x-bind:value="editingEmployee.name" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="mt-2">
                                <label for="edit_start_hour" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                <input type="time" name="start_hour" id="edit_start_hour" x-bind:value="editingEmployee.start_hour" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="mt-2">
                                <label for="edit_end_hour" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                <input type="time" name="end_hour" id="edit_end_hour" x-bind:value="editingEmployee.end_hour" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Update</button>
                            </div>
                        </form>
                        <div class="mt-3">
                            <button type="button" @click="showEditModal = false" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</x-layout>