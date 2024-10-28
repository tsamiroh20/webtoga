<!-- Navigasi Paginasi -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <!-- Tombol Previous -->
            <li class="page-item {{ $tanamans->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $tanamans->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            
            <!-- Nomor Halaman -->
            @for ($page = 1; $page <= $tanamans->lastPage(); $page++)
                <li class="page-item {{ $tanamans->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $tanamans->url($page) }}">{{ $page }}</a>
                </li>
            @endfor
            
            <!-- Tombol Next -->
            <li class="page-item {{ !$tanamans->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $tanamans->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>