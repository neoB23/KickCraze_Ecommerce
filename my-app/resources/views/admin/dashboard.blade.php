@extends('admin.layout')

@section('content')
<div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
    
    {{-- Left Column (Big Card + Mini Cards) --}}
    <div class="xl:col-span-8 flex flex-col gap-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Welcome Banner --}}
            <div class="rounded-2xl bg-zinc-950 p-8 text-white relative overflow-hidden shadow-lg flex flex-col justify-center min-h-[220px]">
                <!-- Abstract styling -->
                <div class="absolute right-[-10%] top-[-20%] w-48 h-48 border-[20px] border-white/5 rounded-full"></div>
                <div class="absolute right-[20%] bottom-[-20%] w-32 h-32 border-[15px] border-white/5 rounded-full"></div>
                <div class="absolute right-[5%] bottom-[10%] w-16 h-16 bg-white/5 rounded-full"></div>
                
                <div class="relative z-10 flex items-center justify-between mb-2">
                    <p class="text-white/80 text-sm font-medium uppercase tracking-widest whitespace-nowrap">Dashboard Overview</p>
                    <i data-lucide="zap" class="w-5 h-5 text-white/50"></i>
                </div>
                <div class="relative z-10">
                    <h2 class="text-4xl text-white font-black tracking-tight mb-2">Welcome Back, {{ explode(' ', Auth::user()->name ?? 'Admin')[0] }}!</h2>
                    <p class="text-zinc-400 text-sm max-w-sm leading-relaxed mt-2">Here's what's happening with your store today. Check your metrics, process new orders, and monitor inventory levels.</p>
                </div>
                <div class="relative z-10 mt-6 pt-2">
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-zinc-200 text-zinc-950 text-sm font-bold py-2.5 px-6 rounded-xl transition-colors shadow-sm">
                        <i data-lucide="package" class="w-4 h-4"></i>
                        Process Orders
                    </a>
                </div>
            </div>

            {{-- 4 Mini Cards Grid --}}
            <div class="grid grid-cols-2 gap-4">
                {{-- Green Card --}}
                <div class="bg-zinc-900 rounded-2xl p-5 text-white shadow-md flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i data-lucide="bookmark" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <p class="text-white/80 text-xs font-medium uppercase tracking-wide">Total Invoice</p>
                        <p class="text-3xl font-bold mt-1">135</p>
                    </div>
                </div>
                {{-- Blue Card --}}
                <div class="bg-blue-600 rounded-2xl p-5 text-white shadow-md flex flex-col justify-between" style="background-color: #4f46e5;">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i data-lucide="send" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <p class="text-white/80 text-xs font-medium uppercase tracking-wide">Invoice Sent</p>
                        <p class="text-3xl font-bold mt-1">357</p>
                    </div>
                </div>
                {{-- Purple Card --}}
                <div class="bg-purple-500 rounded-2xl p-5 text-white shadow-md flex flex-col justify-between"  style="background-color: #a855f7;">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i data-lucide="chevron-right-square" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <p class="text-white/80 text-xs font-medium uppercase tracking-wide">Paid Invoice</p>
                        <p class="text-3xl font-bold mt-1">246</p>
                    </div>
                </div>
                {{-- Red Card --}}
                <div class="bg-rose-500 rounded-2xl p-5 text-white shadow-md flex flex-col justify-between" style="background-color: #f43f5e;">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i data-lucide="x-circle" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <p class="text-white/80 text-xs font-medium uppercase tracking-wide">Unpaid Invoice</p>
                        <p class="text-3xl font-bold mt-1">468</p>
                    </div>
                </div>
            </div>
        </div>

        
        {{-- Graph Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-2">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest">Revenue Overview</h3>
                </div>
                <div class="flex-1 w-full h-[250px] relative">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest">Order Statistics</h3>
                </div>
                <div class="flex-1 w-full h-[250px] relative">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="mt-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-slate-800">Latest Invoice</h3>
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 cursor-pointer border rounded-full px-4 py-1.5 bg-white shadow-sm border-gray-200">
                    Recent
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="text-xs text-slate-500 font-bold border-b border-gray-50">
                        <tr>
                            <th class="py-4 px-4 font-semibold">ID Invoice</th>
                            <th class="py-4 px-4 font-semibold">Recipient</th>
                            <th class="py-4 px-4 font-semibold">Date</th>
                            <th class="py-4 px-4 font-semibold">Amount</th>
                            <th class="py-4 px-4 font-semibold">Email</th>
                            <th class="py-4 px-4 font-semibold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-600 font-medium">
                        <tr class="border-b border-gray-50/70 hover:bg-gray-50/50">
                            <td class="py-4 px-4 whitespace-nowrap"><i data-lucide="square" class="w-4 h-4 inline mr-3 text-slate-300"></i>INV-001-123</td>
                            <td class="py-4 px-4 text-slate-800 whitespace-nowrap">John Snow</td>
                            <td class="py-4 px-4 text-slate-400 font-normal whitespace-nowrap">March 21, 2026</td>
                            <td class="py-4 px-4 text-slate-800 whitespace-nowrap">$352</td>
                            <td class="py-4 px-4 text-slate-400 font-normal whitespace-nowrap">john@mail.com</td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <span class="bg-zinc-100/60 text-zinc-500 px-4 py-1.5 rounded-md font-bold text-[11px]">Paid</span>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-50/70 hover:bg-gray-50/50">
                            <td class="py-4 px-4 whitespace-nowrap"><i data-lucide="square" class="w-4 h-4 inline mr-3 text-slate-300"></i>INV-001-124</td>
                            <td class="py-4 px-4 text-slate-800 whitespace-nowrap">Rafif Adma</td>
                            <td class="py-4 px-4 text-slate-400 font-normal whitespace-nowrap">March 23, 2026</td>
                            <td class="py-4 px-4 text-slate-800 whitespace-nowrap">$456</td>
                            <td class="py-4 px-4 text-slate-400 font-normal whitespace-nowrap">rafif@mail.com</td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <span class="bg-zinc-100/60 text-zinc-500 px-4 py-1.5 rounded-md font-bold text-[11px]">Paid</span>
                            </td>
                        </tr>
                        <tr class="border-l-[3px] border-zinc-500 bg-gray-50/40 border-b border-gray-50/70 hover:bg-gray-50/50">
                            <td class="py-4 px-4 whitespace-nowrap text-slate-800"><i data-lucide="check-square" class="w-4 h-4 inline mr-3 text-zinc-500" fill="currentColor"></i>INV-001-125</td>
                            <td class="py-4 px-4 text-slate-800 whitespace-nowrap">Andrean</td>
                            <td class="py-4 px-4 text-slate-400 font-normal whitespace-nowrap">March 25, 2026</td>
                            <td class="py-4 px-4 text-slate-800 whitespace-nowrap">$546</td>
                            <td class="py-4 px-4 text-slate-400 font-normal whitespace-nowrap">andre@mail.com</td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <span class="bg-zinc-100/60 text-zinc-500 px-4 py-1.5 rounded-md font-bold text-[11px]">Paid</span>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-50/70 hover:bg-gray-50/50">
                            <td class="py-4 px-4 whitespace-nowrap"><i data-lucide="square" class="w-4 h-4 inline mr-3 text-slate-300"></i>INV-001-126</td>
                            <td class="py-4 px-4 text-slate-800 whitespace-nowrap">Adityawan</td>
                            <td class="py-4 px-4 text-slate-400 font-normal whitespace-nowrap">March 27, 2026</td>
                            <td class="py-4 px-4 text-slate-800 whitespace-nowrap">$535</td>
                            <td class="py-4 px-4 text-slate-400 font-normal whitespace-nowrap">adity@mail.com</td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <span class="bg-zinc-100/60 text-zinc-500 px-4 py-1.5 rounded-md font-bold text-[11px]">Paid</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- Right Column (Transfer History) --}}
    <div class="xl:col-span-4 flex flex-col gap-2">
        <h3 class="text-xl font-bold text-slate-800 mb-4 ml-1 mt-1">Transfer History</h3>
        <div class="bg-white rounded-2xl p-6 pt-2 shadow-sm border border-gray-100 flex-1 overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="text-xs text-slate-500 font-bold border-b border-gray-50">
                    <tr>
                        <th class="py-4 px-2 font-semibold"><i data-lucide="square" class="w-3.5 h-3.5 inline mr-1 text-slate-300"></i> Transfer Name</th>
                        <th class="py-4 px-2 font-semibold">Date</th>
                        <th class="py-4 px-2 font-semibold">Amount</th>
                        <th class="py-4 px-2 font-semibold text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 font-medium">
                    <tr class="border-b border-gray-50/70 hover:bg-gray-50/50">
                        <td class="py-4 px-2 whitespace-nowrap"><i data-lucide="square" class="w-3.5 h-3.5 inline mr-2 text-slate-300"></i>Youzup Premium</td>
                        <td class="py-4 px-2 text-slate-400 font-normal whitespace-nowrap">April 12, 2026</td>
                        <td class="py-4 px-2 text-slate-800 whitespace-nowrap">$245</td>
                        <td class="py-4 px-2 text-center whitespace-nowrap">
                            <span class="bg-rose-500 text-white px-3 py-1.5 rounded-md font-medium text-[10px]">Canceled</span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-50/70 hover:bg-gray-50/50">
                        <td class="py-4 px-2 whitespace-nowrap"><i data-lucide="square" class="w-3.5 h-3.5 inline mr-2 text-slate-300"></i>Dashe TV</td>
                        <td class="py-4 px-2 text-slate-400 font-normal whitespace-nowrap">April 14, 2026</td>
                        <td class="py-4 px-2 text-slate-800 whitespace-nowrap">$143</td>
                        <td class="py-4 px-2 text-center whitespace-nowrap">
                            <span class="bg-zinc-900 text-white px-3 py-1.5 rounded-md font-medium text-[10px]">Completed</span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-50/70 hover:bg-gray-50/50">
                        <td class="py-4 px-2 whitespace-nowrap text-slate-800"><i data-lucide="minus-square" class="w-3.5 h-3.5 mr-2 inline text-slate-400"></i>Samantha Liauw</td>
                        <td class="py-4 px-2 text-slate-400 font-normal whitespace-nowrap">April 16, 2026</td>
                        <td class="py-4 px-2 text-slate-800 whitespace-nowrap">$54</td>
                        <td class="py-4 px-2 text-center whitespace-nowrap">
                            <span class="bg-yellow-400 text-white px-3 py-1.5 rounded-md font-medium text-[10px]">Pending</span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-50/70 hover:bg-gray-50/50">
                        <td class="py-4 px-2 whitespace-nowrap"><i data-lucide="square" class="w-3.5 h-3.5 inline mr-2 text-slate-300"></i>Spotitaz</td>
                        <td class="py-4 px-2 text-slate-400 font-normal whitespace-nowrap">April 18, 2026</td>
                        <td class="py-4 px-2 text-slate-800 whitespace-nowrap">$323</td>
                        <td class="py-4 px-2 text-center whitespace-nowrap">
                            <span class="bg-zinc-900 text-white px-3 py-1.5 rounded-md font-medium text-[10px]">Completed</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Revenue Chart (Line)
        const ctxRev = document.getElementById('revenueChart');
        if(ctxRev) {
            new Chart(ctxRev, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Revenue ($)',
                        data: [1200, 1900, 1500, 2200, 1800, 2800, 2400],
                        borderColor: '#18181b', // zinc-900
                        backgroundColor: 'rgba(24, 24, 27, 0.05)',
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#18181b',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4] }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        // Orders Chart (Bar)
        const ctxOrd = document.getElementById('ordersChart');
        if(ctxOrd) {
            new Chart(ctxOrd, {
                type: 'bar',
                data: {
                    labels: ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
                    datasets: [{
                        label: 'Orders',
                        data: [45, 80, 50, 120, 15],
                        backgroundColor: [
                            '#facc15', // yellow-400
                            '#3b82f6', // blue-500
                            '#a855f7', // purple-500
                            '#18181b', // zinc-900
                            '#f43f5e'  // rose-500
                        ],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4] }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection

