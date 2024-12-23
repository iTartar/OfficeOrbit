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