@extends('base.base')

@section('content')
    <h1>Store Page</h1>
    {{-- @foreach ($product_category as $pc)
            <h5>{{ $pc['name'] }}</h5>
            <p>{{ $pc['description'] }}</p>
    @endforeach --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($products as $p)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->name }}</h5>
                        <p class="card-text"><i>{{ $p->description }}</i></p>
                        <p class="card-text">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                        <p class="card-text">{{ $p -> details }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection