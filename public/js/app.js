//! Sidebar Click Navbar
$(document).ready(function () {
    const navbarCategories = [
        'profile',
        'dashboard',
        'faculty',
        'major',
        'formal-class',
        'credit-class',
        'score',
        'student',
        'teacher',
        'subject',
        'training-system',
        'school-year',
        'authorization',
        // Sắp xếp theo thứ tự ưu tiên, giảm dần từ trên xuống
    ];

    let url = window.location.href;
    // var activePage = url.substring(url.lastIndexOf('/') + 1);

    navbarCategories.forEach(function (category) {
        if (url.includes(category)) {
            if (category === 'major')
                category = 'faculty';
            if (category === 'score' && url.includes('score/create'))
                category = 'credit-class';
            url = category;

            // const splitUrl = url.split(category);
            // url = splitUrl[0] + category;

        }
    });

    $('#sidebar li a').removeClass('active');
    $('#sidebar li a[href*="' + url + '"]').addClass('active');
    $('#smSidebar li a').removeClass('active');
    $('#smSidebar li a[href*="' + url + '"]').addClass('active');
    $('#smSidebar li a[href*="' + url + '"]').addClass('text-white');
});

//! Dashboard icon
const dashboardIcons = document.querySelectorAll('.dashboard-icon');

dashboardIcons.forEach(function (icon) {
    icon.addEventListener('mouseenter', () => {
        icon.firstElementChild.style.translate = `150% 0`;
        icon.lastElementChild.style.translate = `145% 0`;
    });

    icon.addEventListener('mouseleave', () => {
        icon.firstElementChild.style.translate = `0% 0`;
        icon.lastElementChild.style.translate = `0% 0`;
    });
});

//! Highlight search
function search() {
    const input = document.getElementById("search").value;
    if (!input) {
        // Thay thế thẻ mark bằng nội dung gốc
        const content = document.querySelectorAll("span");
        content.forEach(function (element) {
            element.innerHTML = element.innerHTML.replace(/<mark>(.*?)<\/mark>/gi, '$1');
        });
        return;
    }

    const regex = new RegExp(input, 'gi');

    // Tìm kiếm trong các phần tử con
    const content = document.querySelectorAll("span");
    content.forEach(function (element) {
        const innerHTML = element.innerHTML;
        const highlightedHTML = innerHTML.replace(regex, match => `<mark>${match}</mark>`);
        element.innerHTML = highlightedHTML; // Cập nhật nội dung với phần đã làm nổi bật
    });
}
