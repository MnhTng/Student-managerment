{{--
    ? $paginator: là Pagination Object, chứa tất cả thông tin cần cho việc phân trang [ ~ links() ]
    ? hasPages(): Kiểm tra xem có nhiều hơn một trang không
    ? onFirstPage(): Kiểm tra xem trang hiện tại có phải là trang đầu tiên không
    ? previousPageUrl(): Lấy URL của trang trước đó
    ? nextPageUrl(): Lấy URL của trang tiếp theo
    ? currentPage(): Lấy số của trang hiện tại
    ? hasMorePages(): Kiểm tra xem có trang tiếp theo không

    ? $elements: là mảng chứa các trang [ firstPage() -> lastPage() ] hoặc mảng chứa các trang và URL của chúng [ ~ paginateLinks() ]
    ? is_string($element): xác định xem phần tử hiện tại có phải là một chuỗi (ví dụ: để hiển thị "…") hay không
--}}

@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            {{-- Liên kết đến trang đầu --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">«</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a>
                </li>
            @endif

            {{-- Các trang --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Liên kết đến trang cuối --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">»</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">»</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
