define(['component/TaskListBuilder'], function (TaskListBuilder) {
    'use strict';

    class BundleTaskList {
        constructor(taskListElement, bundleSelectElement) {
            this.bundleSelectElement = bundleSelectElement;
            this.cache = [];
            this.taskBuilder = new TaskListBuilder(taskListElement);
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
            this.taskBuilder.build(tasks);
        }

        async getTasksByBundleId(bundleId) {
            if (!(bundleId in this.cache)) {
                let response = await fetch(`/api/bundle/task/${bundleId}`);
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
