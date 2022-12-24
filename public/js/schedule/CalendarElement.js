define([], function () {
    'use strict';

    class CalendarElement {
        constructor(
            parentElement
        ) {
            this.parentElement = parentElement;
            this.weekdaysElement = parentElement.querySelector('.weekdays');

            this.prevElement = document.createElement('li');
            this.prevElement.innerHTML = '&#10094;';
            this.prevElement.classList.add('prev');

            this.nextElement = document.createElement('li');
            this.nextElement.innerHTML = '&#10095;';
            this.nextElement.classList.add('next');

            this.currentMonthElement = this.parentElement.querySelector('.e-sprint-month-name');
            this.currentYearElement = this.parentElement.querySelector('.e-sprint-year');
            this.weekElement = this.parentElement.querySelector('.e-sprint-week');

            this.weekdays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            this.weekLabels = ['1st', '2nd', '3rd', '4th', '5th'];
            this.date = new Date();

            this.week = this.getCurrentWeek(this.date);

            this.prevElement.addEventListener('click', this.handlePrevClick.bind(this));
            this.nextElement.addEventListener('click', this.handleNextClick.bind(this));

            this.currentMonday = this.getCurrentMonday();
        }

        initCalendar() {
            this.update();
        }

        getCurrentDate() {
            return `${this.date.getFullYear()}-${this.date.getMonth() + 1}-${this.date.getDate()}`;
        }

        getCurrentMonth() {
            return this.date.getMonth() + 1;
        }

        getCurrentYear(date) {
            return date.getFullYear();
        }

        getCurrentMonday() {
            let day = this.date.getDay(),
                monday = this.date.getDate() - day + (day === 0 ? -6 : 1);

            return new Date(`${this.getCurrentYear(this.date)}-${this.getCurrentMonth()}-${monday}`);
        }

        minusDays(date, days) {
            let result = new Date(date);
            result.setDate(result.getDate() - days);

            return result;
        }

        addDays(date, days) {
            let result = new Date(date);
            result.setDate(result.getDate() + days);

            return result;
        }

        getWeekdays(monday) {
            let weekdays = [];

            this.weekdays.forEach(function (weekday, index) {
                weekdays[index] = {
                    date: `${monday.getFullYear()}-${monday.getMonth() + 1}-${monday.getDate()}`,
                    label: `${monday.getDate()}<br>${weekday}`
                };

                monday = this.addDays(monday, 1);
            }.bind(this));

            return weekdays;
        }

        getCurrentMonthName(date) {
            return date.toLocaleString('default', { month: 'long' });
        }

        getCurrentWeek(date) {
            return Math.ceil(date.getDate() / 7);
        }

        getWeekLabel(weekNumber) {
            return this.weekLabels[weekNumber - 1] + ' week';
        }

        handlePrevClick(event) {
            this.currentMonday = this.minusDays(this.currentMonday, 7);
            this.update();
        }

        handleNextClick(event) {
            this.currentMonday = this.addDays(this.currentMonday, 7);
            this.update();
        }

        update() {
            this.week = this.getCurrentWeek(this.currentMonday);
            this.weekElement.innerHTML = `(${this.getWeekLabel(this.week)})`;
            this.currentMonthElement.innerHTML = this.getCurrentMonthName(this.currentMonday);
            this.currentYearElement.innerHTML = this.getCurrentYear(this.currentMonday);

            this.weekdaysElement.innerHTML = '';
            this.weekdaysElement.appendChild(this.prevElement);

            this.getWeekdays(this.currentMonday).forEach(function (weekday) {
                let li = document.createElement('li');

                if (weekday.date === this.getCurrentDate()) {
                    li.classList.add('active');
                }

                li.innerHTML = weekday.label;
                li.setAttribute('date', weekday.date);
                this.weekdaysElement.appendChild(li);
            }.bind(this));

            this.weekdaysElement.appendChild(this.nextElement);
        }
    }

    return CalendarElement;
});
