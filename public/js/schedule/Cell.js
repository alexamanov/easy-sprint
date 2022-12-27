define([], function () {
    'use strict';

    class Cell {
        constructor(cellsElement, chunkDetailsElement, userList) {
            this.cellsElement = cellsElement;
            this.chunkDetailsElement = chunkDetailsElement;
            this.taskListElement = this.chunkDetailsElement.querySelector('#chunk-task-list');
            this.estimateElement = this.chunkDetailsElement.querySelector('#estimate');
            this.saveButtonElement = this.chunkDetailsElement.querySelector('button');
            this.saveButtonElement.addEventListener('click', this.save.bind(this));
            this.userList = userList;
            this.lastCell = null;
        }

        async render(weekdays) {
            this.cellsElement.innerHTML = '';
            const users = await this.userList.getUsers();
            users.forEach(function (user) {
                for (let index = 0; index < 7; index++) {
                    let li = document.createElement('li');
                    li.setAttribute('user-id', user.id);
                    li.setAttribute('date', weekdays[index].date);
                    li.addEventListener('click', this.handleClick.bind(this));
                    this.cellsElement.appendChild(li);
                }
            }.bind(this));
        }

        handleClick(event) {
            const cell = event.target;

            const currentTaskList = cell.querySelector('.task-list-container');
            const currentEstimate = cell.querySelector('.cell-estimate') ? cell.querySelector('.cell-estimate').value : {};

            console.log(currentEstimate);

            this.taskListElement.value = '';
            this.estimateElement.value = currentEstimate;

            const userId = cell.getAttribute('user-id');
            const date = cell.getAttribute('date');

            this.saveButtonElement.setAttribute('user-id', userId);
            this.saveButtonElement.setAttribute('date', date);
            this.lastCell = cell;

            this.chunkDetailsElement.classList.add('visible');
        }

        save(event) {
            event.preventDefault();
            this.chunkDetailsElement.classList.remove('visible');

            const tasks = this.taskListElement.value;
            const estimate = this.estimateElement.value;

            const taskListContainerElement = document.createElement('div');
            taskListContainerElement.classList.add('task-list-container');
            tasks.split("\n").forEach(function (task) {
                let taskElement = document.createElement('p');
                taskElement.innerText = task;
                taskListContainerElement.appendChild(taskElement);
            });

            this.taskListElement.value = '';
            this.estimateElement.value = '';

            this.lastCell.appendChild(taskListContainerElement);
            this.lastCell.innerHTML += `<b>est:</b> <span class="cell-estimate">${estimate}</span>`;
        }
    }

    return Cell;
});
