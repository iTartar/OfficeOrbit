<x-layout>
    <div x-data="{ 
        sidebarOpen: false, 
        activeMenu: 'user',
        showAddModal: false,
        showEditModal: false,
        editinguser: false,
    }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Sidebar - Tidak diubah -->
        <x-sidebar></x-sidebar>
        
        <div class="flex flex-col flex-1 overflow-hidden">
            <x-header></x-header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-medium text-gray-700">Tabel User</h3>
                        <button @click="showAddModal = true" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">Add User</button>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="flex justify-center w-full">
    <div class="overflow-x-auto w-full">
        <table class="w-full" id="table-user">
            <thead>
                <tr class="bg-gray-100">
                @php
                        $columns = [
                            'id'=> 'id',
                            'nama' => 'Nama',
                            'email' => 'Email',
                            'role' => 'Role',
                            'ttl' => 'TTL',
                            'gender' => 'Gender',
                            'notelp' => 'No. Telp',
                            'namalengkap' => 'Nama Lengkap',
                            'agama' => 'Agama',

                        ];
                    @endphp
                </tr>
                
                @foreach($columns as $column => $label)
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-x-2">
                                <a href="{{ route('user.index', array_merge(request()->query(), [
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
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $user->nama }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $user->ttl }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $user->gender }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $user->notelp }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $user->namalengkap }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $user->agama }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex justify-center space-x-2">
                            <button 
                                @click="showEditModal = true; editinguser = {{ json_encode($user) }}" 
                                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                                Edit
                            </button>
                            <form action="{{ route('user.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-300">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
                        <div class="px-6 py-4 bg-gray-100">
                            <p>Showing {{ ($users->currentPage() - 1) * $users->perPage() + 1 }} to {{ ($users->currentPage() - 1) * $users->perPage() + count($users) }} of {{ $users->total() }} entries</p>
                            {{ $users->links()->withQuery([]) }}
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
                        fetch(`{{ route('user.index') }}?per_page=${perPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('users-table').innerHTML = html;
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
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="mt-2">
                        <label for="namalengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="namalengkap" id="namalengkap" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="nama" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role" id="role" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">Select Role</option>
                            <option value="Super_Admin">Super Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="ttl" class="block text-sm font-medium text-gray-700">TTL</label>
                        <input type="date" name="ttl" id="ttl" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" id="gender" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">Select Gender</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="notelp" class="block text-sm font-medium text-gray-700">No. Telp</label>
                        <input type="number" name="notelp" id="notelp" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                        <select name="agama" id="agama" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">Select Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="joindate" class="block text-sm font-medium text-gray-700">Join Date</label>
                        <input type="date" name="joindate" id="joindate" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mt-2">
                        <label for="enddate" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="enddate" id="enddate" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Karyawan</h3>
                        <form x-bind:action="'/user/' + editinguser.id" method="POST">
                            @csrf
                            @method('PUT')
                        <div>    
                            <label for="edit_namalengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="edit_namalengkap" id="edit_namalengkap" x-model="editinguser.namalengkap" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="edit_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="edit_nama" x-model="editinguser.nama" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="edit_email" x-model="editinguser.email" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="edit_role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="edit_role" x-model="editinguser.role" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Select Role</option>
                                <option value="Super_Admin">Super Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <div>
                            <label for="edit_ttl" class="block text-sm font-medium text-gray-700">TTL</label>
                            <input type="date" name="ttl" id="edit_ttl" x-model="editinguser.ttl" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="edit_gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" id="edit_gender" x-model="editinguser.gender" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Select Gender</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="edit_notelp" class="block text-sm font-medium text-gray-700">No. Telp</label>
                            <input type="number" name="notelp" id="edit_notelp" x-model="editinguser.notelp"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="edit_agama" class="block text-sm font-medium text-gray-700">Agama</label>
                            <select name="agama" id="edit_agama" x-model="editinguser.agama" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Select Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div>
                            <label for="edit_joindate" class="block text-sm font-medium text-gray-700">joindate</label>
                            <input type="date" name="joindate" id="edit_joindate" x-model="editinguser.joindate" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="edit_enddate" class="block text-sm font-medium text-gray-700">enddate</label>
                            <input type="date" name="enddate" id="edit_enddate" x-model="editinguser.enddate" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
        <script>
            @if(Session::has('success'))
                satisfiestoastr.success("{{ Session::get('success') }}");
            @endif
        </script>
</x-layout>