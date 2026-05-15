@include('components.lastnav')
@extends('layout.app')
@vite('resources/css/app.css')
@section('title', 'KickCraze - Women\'s Shoes')
@section('content')

<div class="max-w-[1500px] mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-8">

    <x-shop-hero
        index="02"
        eyebrow="Women's Collection"
        title="Women's"
        subtitle="Footwear"
        description="Statement silhouettes engineered for movement. Refined details, technical materials, no compromise on craft."
        accent="rose"
        :total-count="$filterOptions['totalCount']" />

    <div class="flex flex-col lg:flex-row gap-8">
        <x-shop-sidebar :filter-options="$filterOptions" category="Women's" />

        <div class="flex-1 min-w-0">
            <x-shop-toolbar :count="count($products)" :total-count="$filterOptions['totalCount']" />

            @if(count($products) === 0)
                @include('components.shop-empty', ['clearRoute' => 'womens'])
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
