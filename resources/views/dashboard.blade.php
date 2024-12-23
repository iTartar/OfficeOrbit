<x-layout>
    <div>
        <div x-data="{sidebarOpen: false, activeMenu: 'dashboard' }" class="flex h-screen bg-gray-200">
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        
            <x-sidebar></x-sidebar>
            <div class="flex flex-col flex-1 overflow-hidden">
                <x-header></x-header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-8 mx-auto">
                        <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>
        
                        <div class="mt-4">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                                <!-- Informasi 1 -->
                                <div class="bg-white rounded-md shadow-sm">
                                    <div class="flex items-center justify-between px-4 py-6">
                                        <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                                                <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"></path>
                                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="mx-4">
                                            <h4 class="text-2xl font-semibold text-gray-700">
                                            <p> 
                                                {{ $users->total() }} 
                                                {{ $users->links()->withQuery([]) }}
                                            </p>
                                            </h4>
                                            <div class="text-gray-500">Total Users</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi 2 -->
                                <div class="bg-white rounded-md shadow-sm">
                                    <div class="flex items-center justify-between px-4 py-6">
                                        <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                                                <path fill-rule="evenodd" d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="mx-4">
                                            <h4 class="text-2xl font-semibold text-gray-700">
                                            {{ $projects->total() }} 
                                                {{ $projects->links()->withQuery([]) }}
                                            </h4>
                                            <div class="text-gray-500">Project Planning</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi 3 -->
                                <div class="bg-white rounded-md shadow-sm">
                                    <div class="flex items-center justify-between px-4 py-6">
                                        <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                                                <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm-.293 9.293a1 1 0 0 1 0 1.414L9.414 14l1.293 1.293a1 1 0 0 1-1.414 1.414l-2-2a1 1 0 0 1 0-1.414l2-2a1 1 0 0 1 1.414 0Zm2.586 1.414a1 1 0 0 1 1.414-1.414l2 2a1 1 0 0 1 0 1.414l-2 2a1 1 0 0 1-1.414-1.414L14.586 14l-1.293-1.293Z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="mx-4">
                                            <h4 class="text-2xl font-semibold text-gray-700">
                                                {{ $planning }} {{-- Menampilkan total planning --}}
                                                {{ $projects->links()->withQuery([]) }} {{-- Untuk pagination --}}
                                            </h4>
                                            <div class="text-gray-500">Project Ongoing</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi 4 (Baru) -->
                                <div class="bg-white rounded-md shadow-sm">
                                    <div class="flex items-center justify-between px-4 py-6">
                                        <div class="p-3 bg-blue-600 bg-opacity-75 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 0 0-1 1H6a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2a1 1 0 0 0-1-1H9Zm1 2h4v2h1a1 1 0 1 1 0 2H9a1 1 0 0 1 0-2h1V4Zm5.707 8.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="mx-4">
                                            <h4 class="text-2xl font-semibold text-gray-700">
                                                {{ $completed }} {{-- Menampilkan total planning --}}
                                                {{ $projects->links()->withQuery([]) }} {{-- Untuk pagination --}}
                                            </h4>                                            
                                            <div class="text-gray-500">Project Done</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="mt-8">
        
                        </div>
        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                            <div class="bg-gray bg-opacity-80 p-4 rounded-lg shadow">
                                <h2 class="text-lg font-semibold mb-4">Total users by gender</h2>
                                <div style="height: 300px; width: 100%;">
                                    <canvas id="genderChart">{{ $laki }}</canvas>
                                </div>
                            </div>
                            <!-- <div class="bg-gray bg-opacity-80 p-4 rounded-lg shadow">
                                <h2 class="text-lg font-semibold mb-4">Number of Projects Per Years</h2>
                                <div style="height: 300px; width: 100%;">
                                    <canvas id="projectChart">{{ $perempuan}}</canvas>
                                </div>
                            </div> -->
                        </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Data for gender chart
    var genderData = {
        labels: ['Men', 'Women'],
        datasets: [{
            data: [2, 0],
            backgroundColor: ['rgba(51, 102, 204, 0.8)', 'rgba(220, 57, 18, 0.8)']
        }]
    };


            // Membuat chart gender
            var genderCtx = document.getElementById('genderChart').getContext('2d');
            new Chart(genderCtx, {
                type: 'doughnut',
                data: genderData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 10,
                                padding: 5,
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });

            // Data untuk chart proyek
            // var projectData = {
            //     labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            //     datasets: [{
            //         label: 'Total Proyek',
            //         data: [65, 59, 80, 81, 56, 55, 40, 70, 75, 85, 90, 100],
            //         backgroundColor: 'rgba(0, 128, 128, 0.8)'
            //     }]
            // };

            // Membuat chart proyek
            var projectCtx = document.getElementById('projectChart').getContext('2d');
            new Chart(projectCtx, {
                type: 'bar',
                data: projectData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    barThickness: 20
                }
            });
        });
    </script>
</x-layout>
