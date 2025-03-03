<tr id="plan-{{ $plan->id }}">
    <td>{{ $plan->component_name }}</td>
    <td>{{ $plan->price }}</td>
    <td>{{ $plan->quantity }}</td>
    <td>{{ ucfirst($plan->status) }}</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                ⋮
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item"
                       hx-get="{{ route('planning.edit', $plan->id) }}"
                       hx-push-url="{{ route('planning.edit', $plan->id) }}"
                       hx-target="body"
                       hx-swap="innerHTML">
                        Edit
                    </a>
                </li>
                <li>
                    <form hx-delete="{{ route('planning.destroy', $plan->id) }}" 
                          hx-target="#plan-{{ $plan->id }}" 
                          hx-swap="outerHTML"
                          hx-confirm="Are you sure you want to delete this plan?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                    </form>
                </li>
            </ul>
        </div>
    </td>
</tr>