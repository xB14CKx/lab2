<x-app-layout>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/customCSS.css')

    <div class="container mt-4">
        <div class="row">
            <!-- Left Side Form -->
            <div class="col-md-4">
                <form id="planForm" method="POST" action="{{ route('planning.store') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="component_name" class="form-control" placeholder="Component Name"
                            required>
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
                            <tr>
                                <td>{{ $plan->component_name }}</td>
                                <td>{{ $plan->price }}</td>
                                <td>{{ $plan->quantity }}</td>
                                <td>{{ $plan->status }}</td>
                                <td>
                                    <!-- Dropdown for Edit/Delete -->
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $plan->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            &#x22EE; <!-- Three-dot icon -->
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $plan->id }}">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('planning.edit', $plan->id) }}">Edit</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('planning.destroy', $plan->id) }}" method="POST"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                </form>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        document.querySelectorAll('.delete-form').forEach(form => {
                                                            form.addEventListener('submit', function (e) {
                                                                if (!confirm('Are you sure you want to delete this plan?')) {
                                                                    e.preventDefault();
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>