define([], function () {
    'use strict';

    class TaskListBuilder {
        constructor(taskListElement) {
            this.taskListElement = taskListElement;
            this.copyIconPath = '/icon/copy.png';
        }

        build(tasks) {
            this.taskListElement.innerHTML = '';

            for (let taskIndex in tasks) {
                let task = tasks[taskIndex],
                    li = document.createElement('li'),
                    linkElement = document.createElement('a'),
                    copyIconElement = document.createElement('img');

                linkElement.setAttribute('href', task);
                linkElement.setAttribute('target', '_blank');
                linkElement.appendChild(document.createTextNode(this.linkToCode(task)));

                copyIconElement.setAttribute('src', this.copyIconPath);

                li.classList.add('e-sprint-task');
                li.appendChild(linkElement);
                li.appendChild(copyIconElement);

                this.taskListElement.appendChild(li);
            }
        }

        linkToCode(link) {
            return link.split('/').reverse()[0] || link;
        }
    }

    return TaskListBuilder;
});
