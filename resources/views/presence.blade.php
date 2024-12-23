<x-layout>
    <div>    
        <div x-data="{ sidebarOpen: false, activeMenu: 'presence' }" class="flex h-screen bg-gray-200">
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
            <x-sidebar></x-sidebar>
            <div class="flex flex-col flex-1 overflow-hidden">
                <x-header></x-header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-8 mx-auto">
                        <h3 class="text-3xl font-medium text-gray-700">Table Presence</h3>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden mx-6">
                        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Attendance Date</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Check IN</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Check OUT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4 text-center text-sm text-black-500">1</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">Aqil</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">30 September 2024</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">02:00:04</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">Belum melakukan absen pulang.</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4 text-center text-sm text-black-500">2</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">iTartar</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">1 Oktober 2024</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">09:26:12</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">Belum melakukan absen pulang.</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4 text-center text-sm text-black-500">3</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">Tomo</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">14 September 2024</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">09:10:10</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">Belum melakukan absen pulang.</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4 text-center text-sm text-black-500">4</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">Rara</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">26 June 2024</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">09:23:24</td>
                                    <td class="px-6 py-4 text-center text-sm text-black-500">Belum melakukan absen pulang.</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="px-6 py-4 bg-white border-t border-gray-200">
                            <p class="text-sm text-gray-700">Showing 1 to 4 of 4 entries</p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-layout>