<x-app-layout>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/customCSS.css')

    <!-- Include HTMX -->
    <script src="https://unpkg.com/htmx.org@1.9.6"></script>

    <div class="container mt-4">
        <div class="row">
            <!-- Left Side Form -->
            <div class="col-md-4">
                <form id="planForm" 
                      method="POST" 
                      action="{{ route('planning.store') }}" 
                      hx-post="{{ route('planning.store') }}" 
                      hx-target="#planTableBody" 
                      hx-swap="beforeend" 
                      hx-on::after-request="this.reset()">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="component_name" class="form-control" placeholder="Component Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="price" class="form-control" placeholder="Price" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                    </div>
                    <div class="mb-3">
                        <select name="status" id="statusSelect" class="form-select" required>
                            <option value="pending">Pending Purchase</option>
                            <option value="purchased">Purchased</option>
                            <option value="working">Working</option>
                            <option value="not-working">Not Working</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 mb-4">Add Plan</button>
                </form>
            </div>

            <!-- Right Side Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Component Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="planTableBody">
                        @foreach ($planning as $plan)
                            @include('partials.plan_row', ['plan' => $plan])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
