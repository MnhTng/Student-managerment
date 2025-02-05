$(document).ready(function () {
    $('.data-table').DataTable({
        columnDefs: [
            // bỏ sắp xếp cho cột đầu tiên và cột cuối cùng
            { targets: [0, -1], orderable: false }
        ],
        language: {
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Hiển thị _MENU_ mục",
            "sZeroRecords": "Không tìm thấy kết quả",
            "sInfo": "Đang hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty": "Đang hiển thị 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix": "",
            "sSearch": "Tìm kiếm:",
            "sUrl": "",
            "sEmptyTable": "Không có dữ liệu trong bảng",
            "sLoadingRecords": "Đang tải...",
            // "oPaginate": {
            //     "sFirst": "Đầu tiên",
            //     "sLast": "Cuối cùng",
            //     "sNext": "Tiếp theo",
            //     "sPrevious": "Trước"
            // },
            "oAria": {
                "sSortAscending": ": sắp xếp cột theo thứ tự tăng dần",
                "sSortDescending": ": sắp xếp cột theo thứ tự giảm dần"
            }
        }
    });
});
