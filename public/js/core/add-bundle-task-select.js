document.addEventListener('DOMContentLoaded', function () {
    const bundleSelect = document.getElementById('Sprint_bundle_id');

    if (bundleSelect) {
        const cache = [];
        let bundleId;

        bundleSelect.addEventListener('change', function (e) {
            bundleId = e.target.value;

            if (!(bundleId in cache)) {
                fetch(`/api/get-bundle-task-html?bundleId=${bundleId}`)
                    .then(response => response.json())
                    .then(response => {
                        if (response.html) {
                            cache[bundleId] = response.html;
                            const container = document.createElement('div');
                            container.classList.add('bundle-tasks');
                            container.classList.add('row');
                            container.style.marginTop = '15px';
                            container.innerHTML = response.html;

                            let bundleTasksElement = document.querySelector('.bundle-tasks');
                            if (bundleTasksElement) {
                                bundleTasksElement.innerHTML = container.innerHTML;
                            } else {
                                bundleSelect.parentElement.after(container);
                            }
                        }
                    });
            } else {
                const container = document.createElement('div');
                container.classList.add('bundle-tasks');
                container.classList.add('row');
                container.style.marginTop = '15px';
                container.innerHTML = cache[bundleId];

                let bundleTasksElement = document.querySelector('.bundle-tasks');
                if (bundleTasksElement) {
                    bundleTasksElement.innerHTML = container.innerHTML;
                }
            }
        });
    }
}, false);
