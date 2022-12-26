require([
    'schedule/CalendarElement',
    'component/SprintSelect'
], function (CalendarElement, SprintSelect) {
    'use strict';

    const emailToUsername = function (email) {
        let fullName = email.split('@')[0];
        fullName = fullName.split('.');

        return fullName[0][0] + fullName[1];
    }

    const getUsers = async function () {
        let response = await fetch('api/user');
        response = await response.json();

        return response.users;
    }

    const parentElement = document.querySelector('.e-sprint-choice-with-calendar-wrapper');
    const cellsElement = parentElement.querySelector('.cells');

    getUsers().then(function (users) {
        let usersCount = users.length;
        let cellCount = usersCount * 7;

        for (let i = 0; i < cellCount; i++) {
            let li = document.createElement('li');

            let cellContent = '<p style="margin: 0">D911-1234</p>' +
                '<p style="margin: 0">D911-4321</p>' +
                '<p style="margin: 0">D911-9876</p>' + '<b>est: 120m</b>';

            if (i % 3 === 0) {
                cellContent = '';
            }

            if (i % 4 === 0) {
                cellContent = '<p style="margin: 0">D911-1234</p>' +
                    '<p style="margin: 0">D911-9876</p>' + '<b>est: 30m</b>';
            }

            li.innerHTML += cellContent;
            //li.innerHTML = cellContent;
            //li.style.borderBottom = '1px solid';

            if ((i + 1) % 7 !== 0 || i === 0) {
                //li.style.borderRight = '1px solid';
            }

            cellsElement.appendChild(li);
        }
    });

    const calendar = new CalendarElement(parentElement);
    calendar.initCalendar();

    const sprintSelect = new SprintSelect(parentElement, calendar);
    sprintSelect.initListener();
});
