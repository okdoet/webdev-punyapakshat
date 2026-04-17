@extends('base.base')

@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4 shadow" style="z-index: 1050;" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('hide');
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    @endif
    </script>
    <h1>Store Page</h1>
    <a href="{{ route('product_insert_form') }}" class="btn btn-primary mb-3">Insert New Product</a>
    {{-- @foreach ($p_category as $pc)
            <h5>{{ $pc['name'] }}</h5>
            <p>{{ $pc['description'] }}</p>
    @endforeach --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($products as $p)
            <div class="col">
                <div class="card">
                    <img src="{{ $p->image_path ? asset('product_images/' . $p->image_path) : 'https://placehold.co/200x200?text=No+Image' }}" class="card-img-top" alt="{{ $p->name }}" style="object-fit: cover; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->name }}</h5>
                        <p class="card-text"><i>{{ $p->description }}</i></p>
                        <p class="card-text">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                        <p class="card-text">{{ $p -> details }}</p>
                        <a href="{{ route ('product_edit_form', $p->id) }}" class="btn btn-sm btn-warning">Edit Product</a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                     Delete
                  </button>
 
                  <!-- Delete Confirmation Modal -->
                  <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1" 
                    aria-labelledby="deleteModalLabel{{ $p->id }}" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel{{ $p->id }}">Confirm Deletion</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body text-start">
                              Are you sure you want to delete <strong>{{ $p->name }}</strong>? <br>
                              <span class="text-danger small">This action cannot be undone.</span>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <form action="{{ route('delete_product', $p->id) }}" method="POST" class="d-inline">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger">Yes, Delete</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection