"use strict";
//Calendar

let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();

let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

//JSON event data
let eventData = {
    "events": [{}]
};

let headerMonths = document.getElementsByClassName('month')[0];
let headerYears = document.getElementsByClassName('year')[0];
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let selectYear = document.getElementById('year');
let selectMonth = document.getElementById('month');

selectYear.value = currentYear;
selectMonth.value = currentMonth;

next.addEventListener('click', nextMonth);
prev.addEventListener('click', previousMonth);
selectYear.addEventListener('input', (event) => {
    if (event.keyCode == 13) {
        event.preventDefault();
        return false;
    } else {
        jump();
    }
})
selectMonth.addEventListener('change', jump);

showCalendar(currentMonth, currentYear);

function showCalendar(month, year) {

    let firstDay = (new Date(year, month)).getDay();

    let tbl = document.getElementsByClassName("calendar-days")[0]; // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    headerMonths.innerHTML = months[month];
    headerYears.innerHTML = year;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++) {
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth(month, year)) {
                break;
            } else {
                let cell = document.createElement("td");
                let cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("activee"); // color today's date
                }
                cell.classList.add('day');
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row); // appending each row into calendar body.
    }
}

function nextMonth() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
    showEvents();
}

function previousMonth() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
    showEvents();
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
    showEvents();
}


function daysInMonth(month, year) {
    return new Date(year, month + 1, 0).getDate();
}


// Events

//https://stackoverflow.com/questions/34896106/attach-event-to-dynamic-elements-in-javascript Event Delegation for new elements
document.addEventListener('click', function (e) {
    if (!e.target.classList.contains('activee') && e.target.classList.contains('day')) {
        if (document.getElementsByClassName('activee')[0] === undefined) {
            e.target.classList.add('activee');
        }
        document.getElementsByClassName('activee')[0].classList.remove('activee');
        if (document.getElementsByClassName('activee')[0] === undefined) {
            e.target.classList.add('activee');
        }
        e.target.classList.add('activee');
    } else if (e.target.classList.contains('activee') === null && e.target.classList.contains('day')) {
        e.target.classList.add('activee');
    }
});
var dayyy, monthhh, desc,alreadyExist=0;
let days = document.getElementsByClassName('day');
//handles new Event form
let newEvent = {
    // day: parseInt(event.innerHTML),
    desc: document.querySelector('#new-event-desc'),
    month: headerMonths,
    year: headerYears,
    
    activee: document.getElementsByClassName('activee'),
    submit: () => {
        if (newEvent.desc.value.length === 0) {
            newEvent.desc.classList.add('error');
            newEvent.desc.style.border = '2px solid red';
        } else {
            alreadyExist=0;
            [...eventData['events']].forEach((event) => {
                [...days].forEach((day) => {
                    if (event['day'] == newEvent.activee[0].innerHTML && event['month'] == newEvent.month.innerHTML && event['description'] == newEvent.desc.value) {
                        alreadyExist=1;
                    }
                });
            });
            if(alreadyExist==0){
                $("#exampleModal").modal("hide");
                newEventJson(newEvent.desc.value, newEvent.month.innerHTML, newEvent.year.innerHTML, newEvent.activee[0].innerHTML);
                hideShowEventsDiv();
                showEventText(newEvent.desc.value);
                $.ajax({
                    url: '/api/calendar',
                    type: 'POST',
                    data: {
                        dayy: newEvent.activee[0].innerHTML,
                        monthh: newEvent.month.innerHTML,
                        description: newEvent.desc.value,
                    },
                    success: function () {
                        $.notify("Information saved successfully.", "success");
                    },
                    error: function (response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                });
                newEvent.desc.classList.remove('error');
                newEvent.desc.style.border = 'none';
                newEvent.clear();
            }else{
                $.notify("Event already exist");
            }
           
        }
    },
    clear: () => {
        newEvent.desc.value = '';
    }
};


function closee() {
    $("#exampleModal").modal("hide");
    document.querySelector('#new-event-desc').value = '';
    hideShowEventsDiv();

}
const hideShowEventsDiv = () => {
    let eventsDiv = document.querySelector('.events');
    let newEventForm = document.querySelector('.new-event-form');
    let saveEventButton = document.querySelector('.submit-event');
    let showEventForm = document.querySelector('.show-event-form');

    if (eventsDiv.classList.contains('aa')) {
        //show Events
        newEventForm.classList.add('aa');
        eventsDiv.classList.remove('aa');
        showEvents();
        //change rotate class for Event listener
        saveEventButton.classList.remove('rotate');
        showEventForm.classList.add('rotate');
    } else {
        //show new Event Form
        eventsDiv.classList.add('aa');
        newEventForm.classList.remove('aa');
        showEvents();
        showEventForm.classList.remove('rotate');
        saveEventButton.classList.add('rotate');
    }
}

//Submit form and show event or new event form
function submit() {

    newEvent.submit();

}

//color the events on the calendar
function showEvents() {
    let days = document.getElementsByClassName('day');
    let events = [];
    [...eventData['events']].forEach((event) => {
        [...days].forEach((day) => {
            if (event['day'] == day.innerHTML && event['month'] == headerMonths.innerHTML && event['year'] == headerYears.innerHTML) {
                day.classList.add('activee-event');
                events.push(event)
            }
        });
    });
    return events;
}

//clears previous event Text
function clearEventText() {
    if (document.getElementsByClassName('event-desc')) {
        [...document.getElementsByClassName('event-desc')].forEach((event) => {
            event.outerHTML = '';
        });
    }
}

//shows eventText
function showEventText(desc) {
    let noEvents = document.getElementsByClassName('no-Events')[0];
    let eventsDescContainer = document.querySelector('.events');
    //span element to put Event text into
    const span = document.createElement('span');
    let EventText = document.createTextNode(desc);;

    //delete button for span
    const remove = document.createElement('div');
    let x = document.createTextNode('x');
    remove.appendChild(x);
    remove.classList.add('remove');

    //clear previous events message
    noEvents.classList.remove('show');
    noEvents.style.display = 'none';

    //append to container
    span.appendChild(EventText)
    span.appendChild(remove);
    span.classList.add('event-desc', 'event-message');
    eventsDescContainer.appendChild(span);
}

//compares eventData array values to date of day clicked on 
const checkEvents = (obj, date) => {

    let isInArray = eventData['events'].find(event => event[obj] == date)
    return isInArray;
}

// //handler to show text from eventData array
document.addEventListener('click', (e) => {
    let noEvents = document.getElementsByClassName('no-Events')[0];

    if (e.target.classList.contains('day')) {
        //Clear previous event Text
        clearEventText();
        if (eventData.events.length === 0) {
            noEvents.style.display = 'initial';
            noEvents.innerHTML = `There are no events on ${headerMonths.innerHTML} ${e.target.innerHTML} ${headerYears.innerHTML}`;

        } else {
            [...eventData['events']].forEach((event) => {
                if (event['day'] == e.target.innerHTML && event['month'] == headerMonths.innerHTML && event['year'] == headerYears.innerHTML) {
                    //show event Text
                    showEventText(event['description']);
                } else if (!checkEvents('year', headerYears.innerHTML) || !checkEvents('month', headerMonths.innerHTML) || !checkEvents('day', e.target.innerHTML)) {
                    clearEventText();
                    noEvents.style.display = 'initial';
                    noEvents.innerHTML = `There are no events on ${headerMonths.innerHTML} ${e.target.innerHTML} ${headerYears.innerHTML}`;
                }
            });
        }
    }
});

//click on x to remove event
document.addEventListener('click', (x) => {
    //day clicked on
    let day = document.getElementsByClassName('activee')[0];
    let noEvents = document.getElementsByClassName('no-Events')[0];
    if (x.target.classList.contains('remove')) {
        let eventText = x.target.parentNode.textContent.slice(0, -1);
        for (var i = eventData.events.length - 1; i >= 0; --i) {
            if (eventData.events[i]['day'] == day.innerHTML && eventData.events[i]['month'] == headerMonths.innerHTML && eventData.events[i]['year'] == headerYears.innerHTML && eventData.events[i]['description'] == eventText) {
                $.ajax({
                    url: '/api/calendar',
                    type: 'DELETE',
                    data: {
                        'dayy' :eventData.events[i]['day'],
                        'monthh': eventData.events[i]['month'],
                        'description': eventData.events[i]['description'],
                        
                    },
                    success: function () {
                        $.notify("Information saved successfully.", "success");
                    },
                    error: function (response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                });
                eventData.events.splice(i, 1);
                //remove event clicked on from view
                x.target.parentNode.classList.add('swingHide');


                //if no events on day selected show message
                if (!checkEvents('year', headerYears.innerHTML) || !checkEvents('month', headerMonths.innerHTML) || !checkEvents('day', day.innerHTML)) {
                    setTimeout(() => {
                        noEvents.style.display = 'initial';
                    }, 600)
                    noEvents.innerHTML = `There are no events on ${headerMonths.innerHTML} ${day.innerHTML} ${headerYears.innerHTML}`;
                    day.classList.remove('activee-event');
                }
                //if events on day selected show them
                if (checkEvents('year', headerYears.innerHTML) && checkEvents('month', headerMonths.innerHTML) & checkEvents('day', day.innerHTML)) {
                    showEventText(eventData.events[i].description);
                }
            }
        }
    }
});


function getAllEvent(day, month, year, description) {
    $("#exampleModal").modal("hide");
    newEventJson(description, month, year, day);
    hideShowEventsDiv();
    if (day == today.getDate() && month == months[today.getMonth()] && today.getFullYear())
        showEventText(description);
}
//adds json to eventData
function newEventJson(description, month, year, day) {
    let event = {
        "description": description,
        "year": year,
        "month": month,
        "day": day
    };
    eventData.events.push(event);

}