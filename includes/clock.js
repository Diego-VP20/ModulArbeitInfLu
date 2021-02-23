// Dieser Code wurde mit Hilfe von Matt Field gemacht. Ich hatte ein anderer Code zuerst, dass er dann so wie hier zu sehen ist
// editiert hat. Ich gebe Matt Field alle Credits.
let animate;

const timeObj = {},// timeObj object populated inside our `init()` function
    clockEls = { // put all the DOM elements for the clock in an object with the keys refering to the relevant value in our timeObj object
        s: document.querySelector("#sec"),
        m: document.querySelector("#min"),
        h: document.querySelector("#hr"),
        day: document.querySelector("#day"),
        month: document.querySelector("#month"),
        year: document.querySelector("#year")
    },
    init = () => {

        // get the date and splits it into the relative properties of our timeObj
        d = new Date();
        timeObj.h = d.getHours();
        timeObj.m = d.getMinutes();
        timeObj.s = d.getSeconds();

        timeObj.day = d.getDate()+'.';
        timeObj.month = d.toLocaleString('DE', { month: 'long' });
        timeObj.year = d.getFullYear()

        clock(); // call clock immediatly
        animate = setInterval(clock, 1000); // set clock to run one every second (1000ms afetrwards)
    },
    changeValue = (el, val) => { // function to change the value - padStart is a string prototype function which adds a specified character to make the string a certain length (e.g. adding), so we convert our number to a string and add a leading "0" if required to make it two characters long
        el.textContent = String(val).padStart(2, "0")
    },
    clock = () => {

        timeObj.s++; // Add a second

        if (timeObj.s === 60) { // If a minute has past, process it
            timeObj.s = 0;
            timeObj.m++;

            if (timeObj.m === 60) { // If an hour has passed, process it
                timeObj.m = 0;
                timeObj.h++;

                if (timeObj.h === 24) { // If a day has ended, stop the current interval and restart the clock (which will retrieve the new date and set the interval again)
                    clearInterval(animate);
                    init();
                }
            }
        }

        // Loop through all of our elements, calling the changeValue function with each providing the element and the appropriate time unit from our timeObj
        for (const [unit, el] of Object.entries(clockEls)) changeValue(el, timeObj[unit])
    }

// Inital call of the function.  window.onload() is outdated - as long as you use "type=module" on your <script> tag in your HTML
init();
