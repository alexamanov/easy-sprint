define([], function () {
    'use strict';

    class UserList {
        constructor(userListElement) {
            this.userListElement = userListElement;
            this.cache = null;
        }

        async render() {
              const users = await this.getUsers();
              users.forEach(function (user) {
                  const containerElement = document.createElement('div');
                  containerElement.classList.add('user');

                  const iconElement = document.createElement('p');
                  iconElement.classList.add('icon');
                  iconElement.innerHTML = this.emailToUsername(user.email);

                  containerElement.appendChild(iconElement);
                  this.userListElement.appendChild(containerElement);
              }.bind(this));
        }

        async getUsers() {
            if (!this.cache) {
                let response = await fetch('api/user');
                response = await response.json();
                this.cache = response.users;
            }

            return this.cache;
        }

        async getCount() {
            const users = await this.getUsers();

            return users.length;
        }

        /**
         * @param {string} email
         * @returns {string}
         */
        emailToUsername(email) {
            let fullName = email.split('@')[0];
            fullName = fullName.split('.');

            return fullName[0][0] + fullName[1];
        }
    }

    return UserList;
});
