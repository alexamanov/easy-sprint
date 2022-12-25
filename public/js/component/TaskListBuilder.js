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
                    copyIconElement = document.createElement('img'),
                    copyLabelElement = document.createElement('span');

                linkElement.setAttribute('href', task);
                linkElement.setAttribute('target', '_blank');
                linkElement.appendChild(document.createTextNode(this.linkToCode(task)));

                copyIconElement.setAttribute('src', this.copyIconPath);
                copyIconElement.setAttribute('task-link', task);
                copyIconElement.addEventListener('click', this.handleCopyClick.bind(this));

                copyLabelElement.classList.add('copied');
                copyLabelElement.innerText = 'copied';

                li.classList.add('e-sprint-task');
                li.appendChild(linkElement);
                li.appendChild(copyIconElement);
                li.appendChild(copyLabelElement);

                this.taskListElement.appendChild(li);
            }
        }

        handleCopyClick(event) {
            let copyIconElement = event.target;
            let taskLink = copyIconElement.getAttribute('task-link');
            let copyLabelElement = copyIconElement.parentElement.querySelector('.copied');

            if (window.navigator.clipboard) {
                window.navigator.clipboard.writeText(taskLink).then(function () {
                    copyLabelElement.classList.add('visible');
                    setTimeout(function () {
                        copyLabelElement.classList.remove('visible');
                    }, 750);
                });
            }
        }

        linkToCode(link) {
            return link.split('/').reverse()[0] || link;
        }
    }

    return TaskListBuilder;
});
