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

// animate moving image to x, y
function animate(x, y) {
  var img = document.getElementById("mouse-image");
  var x0 = img.offsetLeft;
  var y0 = img.offsetTop;
  var dx = x - x0;
  var dy = y - y0;
  var d = Math.sqrt(dx * dx + dy * dy);
  var s = Math.ceil(d / 10);
  var x1 = x0 + dx / s;
  var y1 = y0 + dy / s;
  img.style.left = x1 + "px";
  img.style.top = y1 + "px";
  if (s > 0) {
    setTimeout(function () {
      animate(x, y);
    }, 10);
  }
}

// factorial calculator prompt and response
function factorialCalc() {
  var n = prompt("Enter a number to calculate its factorial: ", "8");
  var result = factorial(parseInt(n));
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

document.addEventListener("click", function (event) {
  // move an image to where the mouse is
  var x = event.clientX;
  var y = event.clientY;
  animate(x - 25, y - 25);
});

// update location when mouse moves
document.addEventListener("mousemove", function (event) {
  var img = document.getElementById("mouse-image2");
  var x = event.clientX;
  var y = event.clientY;

  img.style.left = x - 25 + "px";
  img.style.top = y - 25 + "px";
});
