require(['core/BundleTaskList'], function (BundleTaskList) {
    'use strict';

    const bundleSelect = document.querySelector('.e-sprint-choice-with-list-wrapper select');
    const taskList = document.getElementById('e-sprint-bundle-task-list');

    const bundleTaskList = new BundleTaskList(taskList, bundleSelect);

    bundleTaskList.initSelected().then();
    bundleTaskList.initListener();
});
