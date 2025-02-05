function generateWeeklyEvents() {
    const events = [];

    let index = 0;
    let checkExistsSubject = [];
    subjects.forEach(subject => {
        checkExistsSubject[subject.subject_code] = 0;
    });

    credit_classes.forEach(cl => {
        let check = 1;
        subjects.forEach(subject => {
            if (subject.subject_code === cl.subject_code && checkExistsSubject[subject.subject_code] === 1) {
                check = 0;
            }
        });

        if (check) {
            const start = new Date(cl.start_time).toISOString();
            const end = new Date(cl.end_time).toISOString();

            let weeksToShow;
            if (subjects[index].credit <= 2)
                weeksToShow = 2 * 6;
            else
                weeksToShow = 3 * 6;

            for (let i = 0; i < weeksToShow; i++) {
                const eventStart = new Date(start);
                const eventEnd = new Date(end);
                eventStart.setDate(eventStart.getDate() + i * 7);
                eventEnd.setDate(eventEnd.getDate() + i * 7);

                events.push({
                    title: subjects[index].subject_name + ' ' + cl.room,
                    start: eventStart,
                    end: eventEnd
                });
            }

            index++;
        }

        checkExistsSubject[cl.subject_code] = 1;
    });

    return events;
}

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'vi',
        initialDate: now,
        initialView: 'timeGridWeek',
        firstDay: 1,
        allDaySlot: false,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        views: {
            dayGridMonth: { buttonText: 'Tháng' },
            timeGridWeek: { buttonText: 'Tuần' },
            timeGridDay: { buttonText: 'Ngày' },
        },
        // datesSet: function (dateInfo) {
        //     let start = formatDate(dateInfo.start);
        //     let end = formatDate(dateInfo.end);

        //     // Định dạng ngày hiển thị
        //     let formattedTitle = `${start.toLocaleDateString()} - ${end.toLocaleDateString()}`;
        //     document.querySelector('.fc-toolbar-title').innerText = formattedTitle;
        // },
        // titleFormat: { // will produce something like "Tuesday, September 18, 2018"
        //     month: 'long',
        //     year: 'numeric',
        //     day: 'numeric',
        //     weekday: 'long'
        // },
        // columnHeaderFormat: {
        //     day: 'numeric',
        //     weekday: 'short'
        // },
        dayHeaderFormat: {
            weekday: 'short',
            month: 'numeric',
            day: 'numeric',
            omitCommas: true
        },
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            hour12: false,
            meridiem: false // Không hiển thị AM/PM
        },
        slotMinTime: '06:00:00',
        slotMaxTime: '22:00:00',
        slotDuration: '00:30',

        height: '80dvh',
        expandRows: true,
        slotEventOverlap: false,
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        selectable: false,
        selectMirror: false,
        dayMaxEvents: true, // allow "more" link when too many events
        nowIndicator: false,
        events: generateWeeklyEvents()
    });

    calendar.render();
});

$(document).ready(function () {
    $('.fc-today-button').text('Hôm nay');

    $('#calendar *').on('click', function () {
        $('.fc-today-button').text('Hôm nay');
    });
    $('#calendar *').on('change', function () {
        $('.fc-today-button').text('Hôm nay');
    });
});
