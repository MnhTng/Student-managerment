$(document).ready(function () {
    $('.data-table').DataTable({
        columnDefs: [
            // bỏ sắp xếp cho cột đầu tiên và cột cuối cùng
            { targets: [0, -1], orderable: false }
        ],
        language: {
            "sProcessing": sProcessing,
            "sLengthMenu": sLengthMenu,
            "sZeroRecords": sZeroRecords,
            "sInfo": sInfo,
            "sInfoEmpty": sInfoEmpty,
            "sInfoFiltered": sInfoFiltered,
            "sInfoPostFix": sInfoPostFix,
            "sSearch": sSearch,
            "sUrl": sUrl,
            "sEmptyTable": sEmptyTable,
            "sLoadingRecords": sLoadingRecords,
            // "oPaginate": {
            //     "sFirst": sFirst,
            //     "sLast": sLast,
            //     "sNext": sNext,
            //     "sPrevious": sPrevious
            // },
            "oAria": {
                "sSortAscending": sSortAscending,
                "sSortDescending": sSortDescending
            }
        },
        // Export
        layout: {
            top1Start: {
                buttons: ['csv', 'excel', 'pdf'],
            }
        }
    });

    $('.dt-buttons .dt-button').each(function () {
        let btn = $(this);
        btn.append('<span></span>');

        btn.addClass('hover-btn-1');
    });

    // Import Excel
    let dtButtons = document.querySelector('.dt-buttons');
    let importExcelForm = document.getElementById('import-excel-form');

    if (dtButtons) {
        let importExcelFormClone = importExcelForm.cloneNode(true);
        importExcelForm.remove();
        importExcelFormClone.classList.remove('d-none');

        dtButtons.parentElement.parentElement.appendChild(importExcelFormClone);

        let importExcelInput = importExcelFormClone.querySelector('input[type="file"]');
        let importExcelSubmitBtn = importExcelFormClone.querySelector('button[type="submit"]');

        importExcelInput.addEventListener('change', () => {
            importExcelSubmitBtn.click();
        });
    } else {
        let importExcelInput = importExcelForm.querySelector('input[type="file"]');
        let importExcelSubmitBtn = importExcelForm.querySelector('button[type="submit"]');

        importExcelInput.addEventListener('change', () => {
            importExcelSubmitBtn.click();
        });
    }
});
