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
                        <!-- Add to Cart Trigger -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCartModal{{ $p->id }}" @if($p->stock < 1) disabled @endif>
                     <i class="fas fa-cart-plus me-1"></i> {{ $p->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                  </button>
 
                  <!-- Add to Cart Modal -->
                  <div class="modal fade" id="addToCartModal{{ $p->id }}" tabindex="-1" aria-labelledby="addToCartModalLabel{{ $p->id }}" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                           <div class="modal-header border-bottom-0 pb-0">
                              <h5 class="modal-title fs-6 fw-bold text-truncate" id="addToCartModalLabel{{ $p->id }}">{{ $p->name }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form action="{{ route('add_to_cart', $p->id) }}" method="POST">
                              @csrf
                              <div class="modal-body text-center pt-2">
                                 <p class="text-muted small mb-3">Available Stock: <strong class="{{ $p->stock < 5 ? 'text-danger' : 'text-success' }}">{{ $p->stock }}</strong></p>
                                 <div class="input-group mb-4 mx-auto" style="max-width: 140px;">
                                    <button class="btn btn-outline-secondary px-3" type="button" onclick="const input = this.nextElementSibling; if(input.value > 1) input.value--">-</button>
                                    <input type="number" name="quantity" class="form-control text-center bg-white px-1" value="1" min="1" max="10" readonly>
                                    <button class="btn btn-outline-secondary px-3" type="button" onclick="const input = this.previousElementSibling; const maxQty = {{ min(10, max(1, (int)$p->stock)) }}; if(input.value < maxQty) input.value++">+</button>
                                 </div>
                                 <button type="submit" class="btn btn-primary w-100 rounded-3">
                                    Confirm Add
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                        @can ('update-product')
                        <a href="{{ route ('product_edit_form', $p->id) }}" class="btn btn-sm btn-warning">Edit Product</a>
                        @endcan
                            @can ('delete-product')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                     Delete
                  </button>
                    @endcan
 
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