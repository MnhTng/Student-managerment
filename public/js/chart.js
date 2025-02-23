// get current locale
const currentLocale = document.documentElement.lang;

let male = 'Nam';
let female = 'Nữ';
let majorNumber = 'Số lượng ngành';
let studentNumber = 'Số sinh viên';

if (currentLocale === 'en') {
    male = 'Male';
    female = 'Female';
    majorNumber = 'Number of majors';
    studentNumber = 'Number of students';
}

//! Student gender
const studentGender = document.getElementById('student-gender').getContext('2d');

new Chart(studentGender, {
    type: 'pie',
    data: {
        labels: [male, female],
        datasets: [{
            data: [
                chart.maleStudent,
                chart.femaleStudent,
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(75, 192, 192, 0.5)',
            ],
            borderColor: [
                'rgba(255, 255, 255, 1)'
            ],
            borderWidth: 2,
            hoverBorderWidth: 2,
            hoverBorderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
            ],
        }],
        options: {
            responsive: true,
        }
    }
});

//! Teacher gender
const teacherGender = document.getElementById('teacher-gender').getContext('2d');

new Chart(teacherGender, {
    type: 'pie',
    data: {
        labels: [male, female],
        datasets: [{
            data: [
                chart.maleTeacher,
                chart.femaleTeacher,
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(75, 192, 192, 0.5)',
            ],
            borderColor: [
                'rgba(255, 255, 255, 1)'
            ],
            borderWidth: 2,
            hoverBorderWidth: 2,
            hoverBorderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
            ],
        }],
        options: {
            responsive: true,
        }
    }
});

//! Score
const score = document.getElementById('score').getContext('2d');

new Chart(score, {
    type: 'doughnut',
    data: {
        labels: ['A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F'],
        datasets: [{
            data: [
                chart.A_plus,
                chart.A_nor,
                chart.B_plus,
                chart.B_nor,
                chart.C_plus,
                chart.C_nor,
                chart.D_plus,
                chart.D_nor,
                chart.F_nor
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 105, 180, 0.6)',
                'rgba(139, 69, 19, 0.6)',
                'rgba(211, 211, 211, 0.6)'
            ],
            borderColor: [
                'rgba(255, 255, 255, 1)'
            ],
            borderWidth: 2,
            hoverBorderWidth: 2,
            hoverBorderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 105, 180, 1)',
                'rgba(139, 69, 19, 1)',
                'rgba(211, 211, 211, 1)'
            ],
        }],
        options: {
            responsive: true,
        }
    }
});

//! Faculty
const faculty = document.getElementById('faculty').getContext('2d');
const facultyName = Object.values(chartFacultyName);
const majorNum = Object.values(chartMajorNum);

new Chart(faculty, {
    type: 'bar',
    data: {
        labels: facultyName,
        datasets: [
            {
                label: majorNumber,
                data: majorNum,
                borderWidth: 1,
                borderColor: [
                    'rgb(54, 162, 235)'
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.3)'
                ],
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tickColor: 'rgba(255, 99, 132, 0.2)'
                },
                ticks: {
                    color: 'rgba(255, 99, 132, 1)',
                }
            },
            x: {
                grid: {
                    color: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tickColor: 'rgba(255, 99, 132, 0.2)'
                },
                ticks: {
                    color: 'rgba(255, 99, 132, 1)',
                }
            }
        },
        elements: {
            bar: {
                borderRadius: 5,
                borderSkipped: 'middle',
            }
        },
        responsive: true,
        plugins: {
            legend: {
                display: false,
            },
            tooltip: {
                mode: 'index',
                intersect: false
            },
        }
    }
});

//! Major
const major = document.getElementById('major').getContext('2d');
const majorName = Object.values(chartMajorName);
const studentNum = Object.values(chartStudentNum);

new Chart(major, {
    type: 'bar',
    data: {
        labels: majorName,
        datasets: [
            {
                label: studentNumber,
                data: studentNum,
                borderWidth: 1,
                borderColor: [
                    'rgb(54, 162, 235)'
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.3)'
                ],
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tickColor: 'rgba(255, 99, 132, 0.2)'
                },
                ticks: {
                    color: 'rgba(255, 99, 132, 1)',
                }
            },
            x: {
                grid: {
                    color: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tickColor: 'rgba(255, 99, 132, 0.2)'
                },
                ticks: {
                    color: 'rgba(255, 99, 132, 1)',
                }
            }
        },
        elements: {
            bar: {
                borderRadius: 5,
                borderSkipped: 'middle',
            }
        },
        responsive: true,
        plugins: {
            legend: {
                display: false,
            },
            tooltip: {
                mode: 'index',
                intersect: false
            },
        }
    }
});
