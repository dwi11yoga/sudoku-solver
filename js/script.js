// dark mode
tailwind.config = {
  darkMode: "class",
};

// dapatkan cookies
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) {
    return parts.pop().split(";").shift();
  } else {
    return null;
  }
}

// setel cookie
function setCookie(name, value, days) {
  const date = new Date();
  date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
  const expires = `expires=${date.toUTCString()}`;
  document.cookie = `${name}=${value}; ${expires}; path=/`;
}

// dark mode
function initializeDarkMode() {
  const darkMode = getCookie("darkMode");
  const html = document.querySelector("html");
  if (darkMode == "enabled") {
    html.classList.add("dark");
  } else {
    html.classList.remove("dark");
  }
}

function darkModeToggle() {
  const html = document.querySelector("html");
  const isDarkMode = html.classList.toggle("dark");
  if (isDarkMode) {
    setCookie("darkMode", "enabled", 7);
  } else {
    setCookie("darkMode", "disabled", 7);
  }
  darkModeLabel(
    document.getElementById("sun"),
    document.getElementById("moon")
  );
}

function darkModeLabel(sun, moon) {
  const html = document.querySelector("html");
  if (html.classList.contains("dark")) {
    sun.classList.add("hidden");
    moon.classList.remove("hidden");
  } else {
    sun.classList.remove("hidden");
    moon.classList.add("hidden");
  }
}

// clear sudoku
function clearSudoku() {
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      document.getElementById(`cell-${i}-${j}`).value = "";
    }
  }
}
