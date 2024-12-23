<x-layout>
    <div x-data="{ 
        sidebarOpen: false, 
        activeMenu: 'schedule_user',
        showAddModal: false,
        showEditModal: false,
        editingproject: false,
    }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        
        <x-sidebar></x-sidebar>
        
        <div class="flex flex-col flex-1 overflow-hidden">
            <x-header></x-header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-medium text-gray-700">Table Schedule</h3>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-left">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left">{{ $user->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left">
                                    {{ $user->schedule_id ? $user->schedule->name : 'Belum Terassign ke Schedule' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button onclick="openModal({{ $user->id }})" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        Assign
                                    </button>
                                    <a href="{{ route('calendar.show', $user->id) }}" class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600">
                                        Show
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal -->
    <div id="scheduleModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="bg-white p-6 rounded-md shadow-lg w-full max-w-md relative">
            <h2 class="text-lg font-medium mb-4">Assign Schedule</h2>
            <!-- <form id="assignForm" onsubmit="return assignSchedule(event)"> -->
            <form action="{{ route('schedule-user.assign') }}" method="POST">
                @csrf
                <input type="hidden" id="userId" name="user_id" value="">
                <div class="mb-4">
                    <label for="schedule" class="block font-medium mb-2">Schedule</label>
                    <select id="scheduleSelect" name="schedule_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select Schedule</option>
                        @foreach($schedules as $schedule)
                        <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Assign
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(userId) {
            document.getElementById('scheduleModal').classList.remove('hidden');
            document.getElementById('userId').value = userId;
        }

        function closeModal() {
            document.getElementById('scheduleModal').classList.add('hidden');
            document.getElementById('scheduleSelect').value = '';
        }

        async function assignSchedule(event) {
            event.preventDefault();
            
            const userId = document.getElementById('userId').value;
            const scheduleId = document.getElementById('scheduleSelect').value;
            
            if (!scheduleId) {
                alert('Please select a schedule');
                return false;
            }

            try {
                const response = await fetch('/assign-schedule', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        schedule_id: scheduleId
                    })
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Failed to assign schedule');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while assigning schedule');
            }

            closeModal();
            return false;
        }
    </script>
</x-layout>