/*jshint esversion: 6 */

class Lexical {

    constructor() {
        this.selectedList = [];
        this.cards = $('.card-to-pair');
        this.identifier = $('#lexical-board').data('identifier');
        this.pointContainer = $('#game-point');
        this.timerContainer = $('#game-timer');
        this.stopWatch = new Stopwatch(this.timerContainer);
        this.initEvents();
    }

    initEvents() {
        this.cards.on('click', this.selectCard.bind(this));
        this.startTimer();
    }

    startTimer() {
        this.stopWatch.start();
    }

    selectCard(e) {

        let card = $(e.target);
        if (
            this.selectedList.length >= 2 ||
            card.hasClass('revealed-temporal') ||
            card.hasClass('revealed-permanent') ||
            card.hasClass('failed')
        ) {
            return false;
        }

        card.addClass('revealed-temporal');
        card.attr('src', card.data('src'));

        if (this.selectedList.length < 2) {
            this.selectedList.push(card.data('key'));
        }

        if (this.selectedList.length === 2) {
            this.sendData();
        }
    }

    sendData() {
        let self = this;
        $.ajax({
            type: "POST",
            url: "/game/lexical-check",
            data: {
                list: this.selectedList,
                identifier: this.identifier
            },
            success: function (data) {
                if (data === 'success') {
                    self.success();
                } else {
                    self.fail();
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    success() {
        $('.revealed-temporal').addClass('success').removeClass('revealed-temporal');
        let points = this.pointContainer.html() * 1 + 1;
        this.pointContainer.html(points);
        this.selectedList = [];
        if (points >= 6) {
            this.finish();
        }
    }

    fail() {
        let self = this;
        $('.revealed-temporal').addClass('failed');
        setTimeout(function () {
            $('.revealed-temporal')
                .attr('src', '/uploads/cover.jpg')
                .removeClass('failed')
                .removeClass('revealed-temporal');
            self.selectedList = [];
        }, 2000);
    }

    finish() {
        this.stopWatch.stop();
        $.ajax({
            type: "GET",
            url: "/game/store-memory-result",
            data: {
                time: this.timerContainer.html()
            },
            complete: function () {
                Lexical.showModal();
            }
        });
    }

    static showModal() {
        $("#result-modal").modal();
    }
}

class Stopwatch {
    constructor(timer) {
        this.running = false;
        this.display = timer;
        this.reset();
        this.print(this.times);
    }

    reset() {
        this.times = [0, 0, 0];
    }

    start() {
        if (!this.time) this.time = performance.now();
        if (!this.running) {
            this.running = true;
            requestAnimationFrame(this.step.bind(this));
        }
    }

    stop() {
        this.running = false;
        this.time = null;
    }

    restart() {
        if (!this.time) this.time = performance.now();
        if (!this.running) {
            this.running = true;
            requestAnimationFrame(this.step.bind(this));
        }
        this.reset();
    }

    step(timestamp) {
        if (!this.running) return;
        this.calculate(timestamp);
        this.time = timestamp;
        this.print();
        requestAnimationFrame(this.step.bind(this));
    }

    calculate(timestamp) {
        let diff = timestamp - this.time;
        // Hundredths of a second are 100 ms
        this.times[2] += diff / 10;
        // Seconds are 100 hundredths of a second
        if (this.times[2] >= 100) {
            this.times[1] += 1;
            this.times[2] -= 100;
        }
        // Minutes are 60 seconds
        if (this.times[1] >= 60) {
            this.times[0] += 1;
            this.times[1] -= 60;
        }
    }

    print() {
        this.display.html(Stopwatch.format(this.times));
    }

    static format(times) {
        return `${pad0(times[0], 2)}:${pad0(times[1], 2)}:${pad0(Math.floor(times[2]), 2)}`;
    }
}

function pad0(value, count) {
    let result = value.toString();
    for (; result.length < count; --count)
        result = '0' + result;
    return result;
}

$(document).ready(function () {
    "use strict";
    new Lexical();
});



