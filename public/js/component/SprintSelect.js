define([], function () {
    'use strict';

    class SprintSelect {
        constructor(
            parentElement,
            calendar
        ) {
            this.sprintSelectElement = parentElement.querySelector('select');
            this.startDateElement = parentElement.querySelector('.e-sprint-start');
            this.endDateElement = parentElement.querySelector('.e-sprint-end');
            this.taskListElement = parentElement.querySelector('.e-sprint-task-list');

            this.calendar = calendar;
            this.cache = [];

            this.copyIconPath = '/icon/copy.png';
        }

        initListener() {
            this.sprintSelectElement.addEventListener('change', this.handleChange.bind(this));
        }

        async handleChange (event) {
            let sprintId = event.target.value,
                sprint = await this.getSprintById(sprintId);

            let startDate = sprint.start.date,
                endDate = sprint.end.date,
                tasks = sprint.tasks;

            this.startDateElement.innerHTML = `Start: ${new Date(startDate).toDateString()}`;
            this.endDateElement.innerHTML = `End: ${new Date(endDate).toDateString()}`;

            this.calendar.updateStartDate(startDate);
            this.calendar.updateEndDate(endDate);

            this.taskListElement.innerHTML = '';
            for (let taskIndex in tasks) {
                let task = tasks[taskIndex];
                let li = document.createElement('li');
                let linkElement = document.createElement('a');
                let copyIconElement = document.createElement('img');

                linkElement.setAttribute('href', task);
                linkElement.setAttribute('target', '_blank');
                linkElement.appendChild(document.createTextNode(this.linkToCode(task)));

                copyIconElement.setAttribute('src', this.copyIconPath);

                li.classList.add('task');
                li.appendChild(linkElement);
                li.appendChild(copyIconElement);

                this.taskListElement.appendChild(li);
            }
        }

        async getSprintById (sprintId) {
            if (!(sprintId in this.cache)) {
                let response = await fetch(`/api/sprint/${sprintId}`);
                response = await response.json();

                this.cache[sprintId] = response.sprint;
            }

            return this.cache[sprintId];
        }

        linkToCode(link) {
            return link.split('/').reverse()[0] || link;
        }
    }

    return SprintSelect;
});
