define(function () {
    'use strict';

    class BundleTaskList {
        constructor(taskListElement, bundleSelectElement) {
            this.taskListElement = taskListElement;
            this.bundleSelectElement = bundleSelectElement;
            this.cache = [];
        }

        initListener() {
            this.bundleSelectElement.addEventListener('change', this.handleBundleTaskListChange.bind(this));
        }

        async initSelected() {
            let selectedBundleId = this.bundleSelectElement.value;
            if (selectedBundleId) {
                let tasks = await this.getTasksByBundleId(selectedBundleId);
                this.updateTaskList(tasks);
            }
        }

        updateTaskList(tasks) {
            this.taskListElement.innerText = '';

            for (const taskIndex in tasks) {
                let li = document.createElement('li'),
                    linkElement = document.createElement('a'),
                    task = tasks[taskIndex];

                linkElement.setAttribute('href', task);
                linkElement.appendChild(document.createTextNode(task));
                li.appendChild(linkElement);

                this.taskListElement.appendChild(li);
            }
        }

        async getTasksByBundleId(bundleId) {
            if (!(bundleId in this.cache)) {
                let response = await fetch(`/api/bundle/task/get?bundle_id=${bundleId}`);
                response = await response.json();
                this.cache[bundleId] = response.tasks;
            }

            return this.cache[bundleId];
        }

        async handleBundleTaskListChange(event) {
            let tasks = await this.getTasksByBundleId(event.target.value);
            this.updateTaskList(tasks);
        }
    }

    return BundleTaskList;
});
