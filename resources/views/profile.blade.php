<x-layout>
    <div>    
        <div x-data="{ sidebarOpen: false, activeMenu: '' }" class="flex h-screen bg-gray-200">
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
                <x-sidebar></x-sidebar>
                <div class="flex flex-col flex-1 overflow-hidden">
                    <x-header></x-header>
                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                        <div class="container px-6 py-8 mx-auto">
                            <h3 class="text-3xl font-medium text-gray-700">Edit Profile</h3>
                            
                            
                        </div>
                    </main>
                </div>
        </div>
    </div>
</x-layout>

