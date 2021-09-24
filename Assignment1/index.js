function browserData() {
  // get the browser agent
  var agent = navigator.userAgent;
  // set element with id 'browser-data' to the agent
  document.getElementById("browser-data").innerHTML = agent;
}

function currentDate() {
  var today = new Date();
  // set element with id 'current-date' to the current date
  document.getElementById("current-date").innerHTML = today;
}

// recursive factorial function
function factorial(n) {
  if (n == 0) {
    return 1;
  } else {
    return n * factorial(n - 1);
  }
}

// factorial calculator prompt and response
function factorialCalc() {
  var n = prompt("Enter a number to calculate its factorial: ", "8");
  var result = factorial(parseFloat(n));
  alert("The factorial of " + n + " is " + result);
}

// run functions when the page is ready
window.onload = function () {
  browserData();
  currentDate();
  document.getElementById("date-finished").innerHTML = new Date(
    "Fri Sep 24 2021 18:15:23 GMT-0400"
  );
};

document.addEventListener("click", function () {
  // move an image to where the mouse is
  var img = document.getElementById("mouse-image");
  var x = event.clientX;
  var y = event.clientY;
  // subtract 25 to make it centered
  img.style.left = x - 25 + "px";
  img.style.top = y - 25 + "px";
  console.log(x, y);
});
