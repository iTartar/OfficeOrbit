<x-layout>
    <div>    
        <div x-data="{ sidebarOpen: false, activeMenu: 'schedule_user' }" class="flex h-screen bg-gray-200">
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
            <x-sidebar></x-sidebar>
            <div class="flex flex-col flex-1 overflow-hidden">
                <x-header></x-header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-8 mx-auto">
                        <h3 class="text-3xl font-medium text-gray-700">Calendar</h3>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden mx-6">
                        <!-- @foreach($shifts as $key => $shift)
                            <div class="shift-item">
                                {{ $shift['employee'] }}
                            </div>
                        @endforeach -->
                    <div 
                        id="evoCalendar" 
                        class="evoCalendar border w-full dark"
                    ></div>
                    <!-- Requried Jquery -->
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/tailwindcss-calendar/dist/js/evo-calendar.js"></script>
                    <!-- Options -->

                    <script>
                        const shifts = @json($shifts);
                        const employee = shifts.map(shift => shift.employee);
                        // const user = shifts.map(shift => shift.user);
                        const data = [];
                        

                        shifts.forEach((item, index) => {
                            var color = 'red';
                            var name = item.employee.name;
                            if(name == 'Pagi' || name == 'Siang' || name == 'Full Time') {
                                color = 'blue';
                            }
                            
                            data.push({
                                id: item.id,              // Mengambil ID dari shift atau index jika tidak tersedia
                                name: name,     // Nama berdasarkan employee atau default "Unknown"
                                date: item.date,      // Tanggal default jika tidak tersedia
                                type: item.type,            // Default "work" jika tipe tidak tersedia
                                everyYear: item.everyYear || false,   // Default false jika tidak tersedia
                                color: color  ,         // Default warna "blue" jika tidak tersedia
                            });
                        });
                        console.log(data);
                                const shift = [
                                    {
                                            id          : '1',              // Event's ID (required)
                                            name        : "pagi",       // Event name (required)
                                            date        : "2024-12-02", // Event date (required)
                                            type        : "holiday",        // Event type (required)
                                            everyYear   : true,             // Same event every year (optional)
                                            color       : "pink"            // optional
                                        },
                                        {
                                            id          : '2',
                                            name        : "Event Name Event Name Event Name",
                                            date        : ["October/13/2022", "October/15/2022"], // Date range
                                            description : "Description",
                                            badge       : "3Days",
                                            type        : "event",
                                            color       : "red"
                                        }
                                ];
                        console.log(shifts);
                        console.log(employee);
                    </script>
                    <script>
                        $("#evoCalendar").evoCalendar(
                        {
                            language                : 'en', // km
                            sidebarDisplayDefault   : true, // false
                            calendarEvents: data,
                        });
                    </script>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-layout>