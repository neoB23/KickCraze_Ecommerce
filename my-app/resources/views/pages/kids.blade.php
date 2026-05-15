@include('components.lastnav')
@extends('layout.app')
@vite('resources/css/app.css')
@section('title', 'KickCraze - Kids\' Shoes')
@section('content')

<div class="max-w-[1500px] mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-8">

    <x-shop-hero
        index="03"
        eyebrow="Kids' Collection"
        title="Kids'"
        subtitle="Footwear"
        description="Built for growing feet and full-throttle play. Comfort-first construction without sacrificing the style they actually want to wear."
        accent="amber"
        :total-count="$filterOptions['totalCount']" />

    <div class="flex flex-col lg:flex-row gap-8">
        <x-shop-sidebar :filter-options="$filterOptions" category="Kids" />

        <div class="flex-1 min-w-0">
            <x-shop-toolbar :count="count($products)" :total-count="$filterOptions['totalCount']" />

            @if(count($products) === 0)
                @include('components.shop-empty', ['clearRoute' => 'kids'])
            @else
                <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <x-shop-card :product="$product" :wishlisted-ids="$wishlistedIds ?? []" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@include('components.shop-grid-toggle')

@endsection
