<x-layouts.dashboard>

    <!-- STATS -->
    <div class="grid grid-cols-4 gap-6 mb-6">

        <div class="bg-white rounded-xl shadow-sm  overflow-hidden">
            <div class="p-5 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-orange-400">Rp 50.000.000</h2>
                    <p class="text-gray-500 text-sm mt-1">Total Semua Pendapatan</p>
                </div>
                <span class="iconify text-orange-400 text-3xl" data-icon="mdi:currency-usd-circle"></span>
            </div>
            <div class="h-1.5 bg-orange-400"></div>
        </div>

        <div class="bg-white rounded-xl shadow-sm  overflow-hidden">
            <div class="p-5 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-red-500">145</h2>
                    <p class="text-gray-500 text-sm mt-1">Stok Barang</p>
                </div>
                <span class="iconify text-red-500 text-3xl" data-icon="mdi:file-document-outline"></span>
            </div>
            <div class="h-1.5 bg-red-500"></div>
        </div>

        <div class="bg-white rounded-xl shadow-sm  overflow-hidden">
            <div class="p-5 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-green-500">290+</h2>
                    <p class="text-gray-500 text-sm mt-1">Barang Telah Terjual</p>
                </div>
                <span class="iconify text-green-500 text-3xl" data-icon="mdi:file-check-outline"></span>
            </div>
            <div class="h-1.5 bg-green-500"></div>
        </div>

        <div class="bg-white rounded-xl shadow-sm  overflow-hidden">
            <div class="p-5 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-blue-500">5</h2>
                    <p class="text-gray-500 text-sm mt-1">Kategori Barang</p>
                </div>
                <span class="iconify text-blue-500 text-3xl" data-icon="mdi:thumb-up"></span>
            </div>
            <div class="h-1.5 bg-blue-500"></div>
        </div>

    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-3 gap-6">

        <!-- COLUMN 1: LINE CHART + SMALL STATS -->
        <div class="flex flex-col gap-6">

            <div class="bg-blue-600 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 pb-2">
                    <div class="flex justify-between items-center mb-2">
                        <p class="font-semibold text-white">Penjualan per Bulan</p>
                        <span class="text-xs bg-blue-500/60 text-white px-2 py-0.5 rounded-full flex items-center gap-1">
                            <span class="iconify" data-icon="mdi:trending-up"></span> 3%
                        </span>
                    </div>
                    <div id="salesChart"></div>
                </div>

                <div class="bg-white flex justify-between px-6 py-4 text-sm">
                    <div>
                        <p class="font-bold text-gray-800">Rp 1.000.000</p>
                        <p class="text-gray-400 text-xs">Total Pendapatan Hari ini</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">321</p>
                        <p class="text-gray-400 text-xs">Transaksi</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="bg-white p-5 rounded-xl shadow-sm ">
                    <p class="text-sm text-gray-500 mb-1">Stok Habis</p>
                    <h2 class="text-xl font-bold text-red-500">3</h2>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm ">
                    <p class="text-sm text-gray-500 mb-1">Barang Terjual</p>
                    <h2 class="text-xl font-bold text-green-500">200</h2>
                </div>
            </div>

        </div>

        <!-- COLUMN 2: BEST SELLER DONUT -->
        <div class="bg-white p-6 rounded-xl shadow-sm ">
            <div class="flex justify-between mb-4">
                <p class="font-semibold">Best Seller</p>
                <span class="iconify text-gray-400 text-xl" data-icon="mdi:chart-donut"></span>
            </div>

            <div id="donutChart"></div>

            <div class="grid grid-cols-3 text-center mt-4 text-sm">
                <div>
                    <p class="font-semibold text-gray-700">Strawberry</p>
                    <p class="text-blue-500 font-bold">500</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Bluebery</p>
                    <p class="text-green-500 font-bold">300</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Melon</p>
                    <p class="text-orange-400 font-bold">100</p>
                </div>
            </div>
        </div>

        <!-- COLUMN 3: STOK BARANG -->
        <div class="bg-white p-6 rounded-xl shadow-sm ">
            <div class="flex justify-between mb-6">
                <p class="font-semibold">Stok Barang</p>
                <span class="iconify text-gray-400 text-xl" data-icon="mdi:clipboard-list"></span>
            </div>

            <div class="space-y-5">

                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Sunstar Fresh Melon Juice</span>
                        <span class="font-semibold text-gray-700">80</span>
                    </div>
                    <div class="w-full bg-gray-200 h-1 rounded">
                        <div class="bg-slate-700 h-1 rounded" style="width: 80%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Sunstar Fresh Fruit Juice</span>
                        <span class="font-semibold text-gray-700">50</span>
                    </div>
                    <div class="w-full bg-gray-200 h-1 rounded">
                        <div class="bg-slate-700 h-1 rounded" style="width: 50%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Sunstar Fresh Strawberry Juice</span>
                        <span class="font-semibold text-gray-700">20</span>
                    </div>
                    <div class="w-full bg-gray-200 h-1 rounded">
                        <div class="bg-slate-700 h-1 rounded" style="width: 20%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Sunstar Fresh Banana Juice</span>
                        <span class="font-semibold text-gray-700">60</span>
                    </div>
                    <div class="w-full bg-gray-200 h-1 rounded">
                        <div class="bg-slate-700 h-1 rounded" style="width: 60%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Chocolate</span>
                        <span class="font-semibold text-gray-700">40</span>
                    </div>
                    <div class="w-full bg-gray-200 h-1 rounded">
                        <div class="bg-slate-700 h-1 rounded" style="width: 40%"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // LINE CHART
            const salesChart = new ApexCharts(document.querySelector("#salesChart"), {
                chart: {
                    type: 'line',
                    height: 180,
                    toolbar: { show: false },
                    background: 'transparent'
                },
                stroke: { curve: 'smooth', width: 3 },
                colors: ['#ffffff'],
                series: [{
                    name: 'Pendapatan',
                    data: [1200000, 900000, 1500000, 800000, 1700000, 1300000]
                }],
                grid: { show: false },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    labels: { show: false },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: { show: false },
                tooltip: {
                    y: {
                        formatter: val => 'Rp ' + val.toLocaleString()
                    }
                }
            });

            salesChart.render();

            // DONUT CHART
            const donutChart = new ApexCharts(document.querySelector("#donutChart"), {
                chart: {
                    type: 'donut',
                    height: 250
                },
                series: [500, 300, 100],
                labels: ['Youtube', 'Facebook', 'Twitter'],
                colors: ['#ef4444', '#3b82f6', '#22d3ee'],
                legend: {
                    position: 'bottom'
                }
            });

            donutChart.render();

        });
    </script>
    @endpush

</x-layouts.dashboard>