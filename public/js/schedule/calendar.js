require(['schedule/CalendarElement'], function (CalendarElement) {
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

    const parentElement = document.querySelector('.e-sprint-choice-with-calendar-wrapper');

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

    const calendarElementInstance = new CalendarElement(parentElement);
    calendarElementInstance.initCalendar();

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

        startDateElement.classList.add('date');
        endDateElement.classList.add('date');

        parentElement.insertBefore(startDateElement, calendarElement);
        parentElement.insertBefore(endDateElement, calendarElement);

        calendarElementInstance.updateStartDate(startDate);
        calendarElementInstance.updateEndDate(endDate);

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
