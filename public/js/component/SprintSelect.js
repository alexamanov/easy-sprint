define([], function () {
    'use strict';

    class SprintSelect {
        constructor(sprintSelectElement) {
            this.sprintSelectElement = sprintSelectElement;
            this.sprintSelectElement.addEventListener('change', this.handleChange.bind(this));
            this.cache = [];
        }

        async handleChange (event) {
            let sprintId = event.target.value,
                sprint = this.getSprintById(sprintId);

            let startDate = sprint.start.date,
                endDate = sprint.end.date,
                tasks = sprint.tasks;

            let startDateElement = document.createElement('p'),
                endDateElement = document.createElement('p');

            startDateElement.innerHTML = `Start: ${new Date(startDate).toDateString()}`;
            endDateElement.innerHTML = `End: ${new Date(endDate).toDateString()}`;

            startDateElement.classList.add('date');
            endDateElement.classList.add('date');
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
