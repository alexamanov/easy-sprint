require([], function () {
    const linkToCode = function (link) {
        return link.split('/').reverse()[0];
    }

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

    const getDaysCount = function (year, month) {
        return new Date(year, month, 0).getDate();
    }

    const getCurrentDay = function () {
        return new Date().getDay() - 1;
    }

    const getCurrentMonday = function () {
        const date = new Date();

        return date.getDate() - date.getDay() + 1;
    }

    const getCurrentYear = function () {
        return new Date().getFullYear();
    }

    const getWeekdays = function () {
        const weekdays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        let dayNumber = getCurrentMonday();

        weekdays.forEach(function (weekday, index) {
            weekdays[index] = `${dayNumber++}<br/>${weekday}`;
        });

        return weekdays;
    }

    const getCurrentMonthName = function () {
        return new Date().toLocaleString('default', { month: 'long' });
    }

    const parentElement = document.querySelector('.e-sprint-choice-with-calendar-wrapper');
    const currentMonthElement = parentElement.querySelector('.e-sprint-month-name');
    const currentYearElement = parentElement.querySelector('.e-sprint-year');
    const weekdaysElement = parentElement.querySelector('.weekdays');

    currentMonthElement.innerHTML = getCurrentMonthName();
    currentYearElement.innerText = getCurrentYear();

    let prev = document.createElement('li');
    prev.innerHTML = '&#10094;';
    prev.classList.add('prev');
    weekdaysElement.appendChild(prev);

    getWeekdays().forEach(function (day, index) {
        let li = document.createElement('li');

        if (index === getCurrentDay()) {
            li.classList.add('active');
        }

        li.innerHTML = day;
        weekdaysElement.appendChild(li);
    });

    let next = document.createElement('li');
    next.innerHTML = '&#10095;';
    next.classList.add('next');
    weekdaysElement.appendChild(next);

    const sprintSelectElement = parentElement.querySelector('select');
    const calendarElement = parentElement.querySelector('.calendar');

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

    sprintSelectElement.addEventListener('change', async function (event) {
        let sprintId = event.target.value;

        let response = await fetch(`/api/sprint/${sprintId}`);
        response = await response.json();

        let startDate = response.sprint.start.date;
        let endDate = response.sprint.end.date;
        let tasks = response.sprint.tasks;

        let startDateElement = document.createElement('p');
        let endDateElement = document.createElement('p');
        startDateElement.innerHTML = `Start: ${new Date(startDate).toDateString()}`;
        endDateElement.innerHTML = `End: ${new Date(endDate).toDateString()}`;

        parentElement.insertBefore(startDateElement, calendarElement);
        parentElement.insertBefore(endDateElement, calendarElement);

        const taskListElement = document.createElement('ul');
        taskListElement.classList.add('task-list');
        const taskListLabelElement = document.createElement('h4');
        taskListLabelElement.innerText = 'Task List';

        for (let taskIndex in tasks) {
            let task = tasks[taskIndex];
            let li = document.createElement('li');
            let linkElement = document.createElement('a');

            linkElement.setAttribute('href', task);
            linkElement.appendChild(document.createTextNode(linkToCode(task)));
            li.appendChild(linkElement);

            taskListElement.appendChild(li);
        }

        parentElement.insertBefore(taskListElement, calendarElement);
        parentElement.insertBefore(taskListLabelElement, taskListElement);
    });
});
