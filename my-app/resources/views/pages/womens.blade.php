@include('components.lastnav')
@extends('layout.app')
@vite('resources/css/app.css')
@section('title', 'KickCraze - Women\'s Shoes')
@section('content')

<div class="max-w-[1500px] mx-auto pt-10 pb-16 px-4 sm:px-6 lg:px-8">

    <div class="mb-10 flex flex-col items-start">
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-zinc-800 to-zinc-500 tracking-tight uppercase">
            Women's Footwear Collection
        </h1>
        <div class="h-1 w-24 bg-gradient-to-r from-zinc-500 to-zinc-800 mt-4 rounded-full"></div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <x-shop-sidebar :filter-options="$filterOptions" category="Women's" />

        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-6">
                <p class="text-sm text-zinc-500 font-medium">
                    Showing <span class="font-bold text-zinc-900">{{ count($products) }}</span> result(s)
                </p>
            </div>

            @if(count($products) === 0)
                <div class="bg-white border border-zinc-100 rounded-2xl p-16 text-center">
                    <p class="text-zinc-500 font-medium">No products match your filters.</p>
                    <a href="{{ route('womens') }}" class="inline-block mt-3 text-sm font-bold text-zinc-900 underline">Clear filters</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        @include('components.shop-card', ['product' => $product])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
