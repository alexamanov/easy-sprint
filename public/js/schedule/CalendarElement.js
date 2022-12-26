define([], function () {
    'use strict';

    class CalendarElement {
        constructor(parentElement) {
            this.parentElement = parentElement;
            this.weekdaysElement = parentElement.querySelector('.weekdays');

            this.prevElement = document.createElement('span');
            this.prevElement.innerHTML = '&#10094;';
            this.prevElement.classList.add('prev');

            this.nextElement = document.createElement('span');
            this.nextElement.innerHTML = '&#10095;';
            this.nextElement.classList.add('next');

            this.currentMonthElement = this.parentElement.querySelector('.e-sprint-month-name');
            this.currentYearElement = this.parentElement.querySelector('.e-sprint-year');
            this.actionsElement = this.parentElement.querySelector('.e-sprint-actions');

            this.weekdays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            this.date = new Date();

            this.week = this.getCurrentWeek(this.date);

            this.prevElement.addEventListener('click', this.handlePrevClick.bind(this));
            this.nextElement.addEventListener('click', this.handleNextClick.bind(this));
            this.actionsElement.appendChild(this.prevElement);
            this.actionsElement.appendChild(this.nextElement);

            this.currentMonday = this.getCurrentMonday();

            this.startDate = null;
            this.endDate = null;
            this.startDateElement = null;
            this.endDateElement = null;
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
            this.currentMonthElement.innerHTML = this.getCurrentMonthName(this.currentMonday);
            this.currentYearElement.innerHTML = this.getCurrentYear(this.currentMonday);

            this.weekdaysElement.innerHTML = '';
            //this.weekdaysElement.appendChild(this.prevElement);

            this.getWeekdays(this.currentMonday).forEach(function (weekday) {
                let li = document.createElement('li');

                if (weekday.date === this.getCurrentDate()) {
                    li.classList.add('active');
                }

                li.innerHTML = weekday.label;
                li.setAttribute('date', weekday.date);
                this.weekdaysElement.appendChild(li);
            }.bind(this));

            //this.weekdaysElement.appendChild(this.nextElement);

            this.updateStartDate();
            this.updateEndDate();
        }

        formatDate(date) {
            return [date.getFullYear(), date.getMonth() + 1, date.getDate()].join('-');
        }

        updateStartDate(startDate = null) {
            if (startDate) {
                startDate = this.formatDate(new Date(startDate));
            } else {
                startDate = this.startDate;
            }

            if (this.startDateElement) {
                this.startDateElement.classList.remove('start-date');
            }

            let startDateElement = this.weekdaysElement.querySelector(`[date="${startDate}"]`);
            if (startDateElement) {
                this.startDateElement = startDateElement;
                this.startDateElement.classList.add('start-date');
            } else {
                this.startDate = startDate;
            }
        }

        updateEndDate(endDate = null) {
            if (endDate) {
                endDate = this.formatDate(new Date(endDate));
            } else {
                endDate = this.endDate;
            }

            if (this.endDateElement) {
                this.endDateElement.classList.remove('end-date');
            }

            let endDateElement = this.weekdaysElement.querySelector(`[date="${endDate}"]`);
            if (endDateElement) {
                this.endDateElement = endDateElement;
                this.endDateElement.classList.add('end-date');
            } else {
                this.endDate = endDate;
            }
        }
    }

    return CalendarElement;
});
