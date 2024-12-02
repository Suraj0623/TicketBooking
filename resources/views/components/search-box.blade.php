<div class="search-box mb-4">
    <form action="{{ $searchRoute }}" method="GET" class="d-flex align-items-center justify-content-center">
        <div class="input-group" style="max-width: 500px;">
            <!-- Search Input -->
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="{{ $placeholder }}" 
                value="{{ request('search') }}"
                style="border-radius: 0.5rem 0 0 0.5rem;" 
                required
            >
            
            <!-- Search Button -->
            <button type="submit" class="btn btn-primary px-4" style="border-radius: 0 0.5rem 0.5rem 0;">
                <i class="bi bi-search"></i> Search
            </button>
        </div>
    </form>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
