define(['component/TaskListBuilder'], function (TaskListBuilder) {
    'use strict';

    class SprintSelect {
        constructor(
            parentElement,
            calendar
        ) {
            this.sprintSelectElement = parentElement.querySelector('select');
            this.startDateElement = parentElement.querySelector('.e-sprint-start');
            this.endDateElement = parentElement.querySelector('.e-sprint-end');
            this.calendar = calendar;
            this.taskBuilder = new TaskListBuilder(
                parentElement.querySelector('.e-sprint-task-list')
            );
            this.cache = [];
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

            this.taskBuilder.build(tasks);
        }

        async getSprintById (sprintId) {
            if (!(sprintId in this.cache)) {
                let response = await fetch(`/api/sprint/${sprintId}`);
                response = await response.json();

                this.cache[sprintId] = response.sprint;
            }

            return this.cache[sprintId];
        }
    }

    return SprintSelect;
});
