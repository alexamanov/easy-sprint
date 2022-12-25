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
        let cellCount = usersCount * 8;

        for (let i = 0; i < cellCount; i++) {
            let li = document.createElement('li');

            if (i % 8 === 0) {
                let user = users.pop();
                li.innerText = emailToUsername(user.email);
                li.classList.add('active');
            } else {
                li.innerText = '⚙';
            }

            cellsElement.appendChild(li);
        }
    });

    const calendar = new CalendarElement(parentElement);
    calendar.initCalendar();

    const sprintSelect = new SprintSelect(parentElement, calendar);
    sprintSelect.initListener();
});
