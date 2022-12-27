require([
    'schedule/CalendarElement',
    'schedule/Cell',
    'component/SprintSelect',
    'component/UserList'
], function (CalendarElement, Cell, SprintSelect, UserList) {
    'use strict';

    const parentElement = document.querySelector('.e-sprint-choice-with-calendar-wrapper');
    const chunkDetailsElement = parentElement.querySelector('.e-sprint-chunk');
    const cellsElement = parentElement.querySelector('.cells');

    const userListElement = parentElement.querySelector('.e-sprint-user-list');
    const userList = new UserList(userListElement);

    const cell = new Cell(cellsElement, chunkDetailsElement, userList);
    const calendar = new CalendarElement(parentElement, cell);
    calendar.initCalendar();
    userList.render();

    const sprintSelect = new SprintSelect(parentElement, calendar);
    sprintSelect.initListener();
});
