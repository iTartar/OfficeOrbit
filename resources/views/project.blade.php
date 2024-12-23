<x-layout>
    <div x-data="{ 
        sidebarOpen: false, 
        activeMenu: 'project',
        showAddModal: false,
        showEditModal: false,
        editingproject: false,
    }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        
        <!-- Sidebar - Tidak diubah -->
        <x-sidebar></x-sidebar>
        
        <div class="flex flex-col flex-1 overflow-hidden">
            <x-header></x-header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-medium text-gray-700">Tabel Project</h3>
                        <button @click="showAddModal = true" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">Add Project</button>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="flex justify-center w-full">
                    <div class="overflow-x-auto w-full">
        <table class="w-full ">
            <thead class="bg-gray-50">
                <tr>
                    @php
                        $columns = [
                            'id'=> 'id',    
                            'projek' => 'project',
                            'description' => 'description',
                            'value' => 'value',
                            'start_date' => 'Start date',
                            'end_date' => 'End date',
                            'priority' => 'Priority',
                            'status' => 'status',
                        ];
                    @endphp

                    @foreach($columns as $column => $label)
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-x-2">
                                <a href="{{ route('project.index', array_merge(request()->query(), [
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
                @forelse($projects as $project)
                <tr class="hover:bg-gray-50">
                    <td class="px-6py-4 whitespace-nowrap text-center">
                        {{($projects->currentPage()-1) *$projects->perPage()+$loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $project->projek }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $project->description }}</div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $project->value }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $project->start_date }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $project->end_date }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $project->priority }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $project->status }}
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                    <button 
                            @click="showEditModal = true; editingproject = {{ json_encode($project) }}" 
                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                                Edit
                    </button>
                        <form action="{{ route('project.destroy', $project) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this project?');">
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
                        No projects found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>                        
        <div class="px-6 py-4 bg-gray-100">
                            <p>Showing {{ ($projects->currentPage() - 1) * $projects->perPage() + 1 }} to {{ ($projects->currentPage() - 1) * $projects->perPage() + count($projects) }} of {{ $projects->total() }} entries</p>
                            {{ $projects->links()->withQuery([]) }}
                        </div>
                    </div>
                </div>
            </main>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Fungsi untuk membersihkan URL
                    function cleanURL() {
                        let currentURL = window.location.href;
                        let url = new URL(currentURL);
                        
                        // Jika halaman adalah 1, hapus parameter page
                        if(url.searchParams.get('page') === '1') {
                            url.searchParams.delete('page');
                            
                            // Update URL tanpa me-refresh halaman
                            window.history.pushState({}, '', url.toString());
                        }
                    }

                    // Jalankan fungsi saat halaman dimuat
                    cleanURL();

                    // Tambahkan event listener untuk tombol pagination
                    document.querySelectorAll('.pagination a').forEach(function(link) {
                        link.addEventListener('click', function(e) {
                            // Biarkan link bekerja seperti biasa
                            setTimeout(function() {
                                // Setelah URL berubah, bersihkan lagi
                                cleanURL();
                            }, 100);
                        });
                    });
                    function changePagination() {
                        const perPage = document.getElementById('per_page').value;
                        fetch(`{{ route('project.index') }}?per_page=${perPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('projects-table').innerHTML = html;
                        });
                    }
                });
                </script>
        </div>
<!-- Modal Tambah Karyawan -->
<div x-show="showAddModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- ... (previous backdrop and positioning code) ... -->
        <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah Karyawan</h3>
                <form action="{{ route('project.store') }}" method="POST">
                @csrf
                    <div class="mt-2">
                        <label for="projek" class="block text-sm font-medium text-gray-700">Projek</label>
                        <input type="text" name="projek" id="projek" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" id="user_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">-Pilih User-</option>
                            @foreach($users as $user)
                                <option value="{{ $user->nama }}">{{ $user->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                    <label for="end_date">Tanggal Selesai</label>
                        <input type="date" id="end_date" name="end_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                        <input type="number" name="value" id="value" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                    <label for="priority">Prioritas</label>
                    <select  id="priority" name="priority" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="low" >Rendah</option>
                        <option value="medium" >Sedang</option>
                        <option value="high" >Tinggi</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="status">Status</label>
                    <select  id="status" name="status" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="planning" >Perencanaan</option>
                        <option value="ongoing"  >Sedang Berjalan</option>
                        <option value="completed" >Selesai</option>
                        <option value="on_hold" >Ditunda</option>
                    </select>
                    <div class="mt-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                    </div>
                    </form>
                <div class="mt-3">
                    <button type="button" @click="showAddModal = false" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Modal Edit Karyawan -->
        <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- ... (previous backdrop and positioning code) ... -->
        <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Project</h3>
                <form method="POST" x-bind:action="'/project/' + editingproject.id" >
                        @csrf
                        @method('PUT')
                    <div class="mt-2">
                        <label for="edit_projek" class="block text-sm font-medium text-gray-700">Projek</label>
                        <input type="text" name="projek" id="edit_projek" x-model="editingproject.projek"class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="edit_user_id" class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" id="edit_user_id" x-model="editingproject.user_id"class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">-Pilih User-</option>
                            @foreach($projects as $user)
                                <option value="{{ $user->nama }}">{{ $user->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2">
                        <label for="edit_start_date">Tanggal Mulai</label>
                        <input type="date" id="edit_start_date" name="start_date" x-model="editingproject.start_date"class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                    <label for="end_date">Tanggal Selesai</label>
                        <input type="date" id="edit_end_date" name="end_date" x-model="editingproject.end_date"class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="edit_value" class="block text-sm font-medium text-gray-700">Value</label>
                        <input type="number" name="value" id="edit_value" x-model="editingproject.value"class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                    <label for="edit_priority">Prioritas</label>
                    <select  id="edit_priority" name="edit_priority" x-model="editingproject.priority"required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="low" >Rendah</option>
                        <option value="medium" >Sedang</option>
                        <option value="high" >Tinggi</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="edit_status">Status</label>
                    <select  id="edit_status" name="status" x-model="editingproject.status"required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="planning" >Perencanaan</option>
                        <option value="ongoing"  >Sedang Berjalan</option>
                        <option value="completed" >Selesai</option>
                        <option value="on_hold" >Ditunda</option>
                    </select>
                    <div class="mt-2">
                        <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="edit_description" rows="3" x-model="editingproject.description"class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
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