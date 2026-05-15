@include('components.lastnav')
@extends('layout.app')
@vite('resources/css/app.css')
@section('title', 'KickCraze - Men\'s shoes')
@section('content')

<div class="max-w-[1500px] mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-8">

    <x-shop-hero
        index="01"
        eyebrow="Men's Collection"
        title="Men's"
        subtitle="Footwear"
        description="From court classics to streetwear icons. Every silhouette authenticated and built to outlast the days that don't slow down."
        accent="zinc"
        :total-count="$filterOptions['totalCount']" />

    <div class="flex flex-col lg:flex-row gap-8">
        <x-shop-sidebar :filter-options="$filterOptions" category="Men's" />

        <div class="flex-1 min-w-0">
            <x-shop-toolbar :count="count($products)" :total-count="$filterOptions['totalCount']" />

            @if(count($products) === 0)
                @include('components.shop-empty', ['clearRoute' => 'mens'])
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
