<x-app-layout>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/customCSS.css')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Edit Plan</h2>

                <form method="POST" action="{{ route('planning.update', $plan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="component_name" class="form-label">Component Name</label>
                        <input type="text" name="component_name" class="form-control" value="{{ $plan->component_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $plan->price }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $plan->quantity }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="working" {{ $plan->status == 'working' ? 'selected' : '' }}>Working</option>
                            <option value="not-working" {{ $plan->status == 'not-working' ? 'selected' : '' }}>Not Working</option>
                            <option value="pending" {{ $plan->status == 'pending' ? 'selected' : '' }}>Pending Purchase</option>
                            <option value="purchased" {{ $plan->status == 'purchased' ? 'selected' : '' }}>Purchased</option>
                        </select>
                    </div>

                    <x-primary-button type="submit">Update Plan</x-primary-button>
                    <a href="{{ route('planning.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</x-app-layout>
