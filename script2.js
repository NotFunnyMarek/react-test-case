const sidebarToggle = document.getElementById('sidebar-toggle');
const sidebar = document.getElementById('sidebar');
const searchInput = document.querySelector('.searchbar input');
const dropdownContents = document.querySelectorAll('.dropdown-content button');
const registerBtn = document.getElementById('register-btn');
const popout = document.getElementById('popout');
const popoutContent = document.querySelector('.popout-content');
const marketingCheckbox = document.getElementById('marketing-checkbox');
const registerButton = document.getElementById('register-button');
const popoutCloseButton = document.getElementById('popout-close-button');

const loginButton = document.getElementById('login-button');
const popout2 = document.getElementById('popout2');
const popoutContent2 = document.querySelector('.popout-content2');
const loginSentButton = document.getElementById('login-sent-button');
const popoutCloseButton2 = document.getElementById('popout-close-button2');

window.addEventListener('load', () => {
    sidebar.style.left = '0';
    sidebar.style.width = '220px';
});

sidebarToggle.addEventListener('click', () => {
    if (sidebar.style.left === '-220px' || sidebar.style.left === '') {
        sidebar.style.left = '0';
    } else {
        sidebar.style.left = '-220px';
    }
});

dropdownContents.forEach(button => {
    button.style.display = 'block';
});

searchInput.addEventListener('input', () => {
    const searchValue = searchInput.value.toLowerCase().trim();

    dropdownContents.forEach(button => {
        const buttonText = button.textContent.toLowerCase();
        if (buttonText.includes(searchValue)) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }
    });

    const visibleButtons = Array.from(dropdownContents).filter(button => button.style.display === 'block');

    if (visibleButtons.length === 1) {
        sidebar.style.width = '220px';
    } else {
        sidebar.style.width = '220px';
    }
});

registerBtn.addEventListener('click', () => {
    popout.style.display = 'block';
    popout2.style.display = 'none';
});

loginButton.addEventListener('click', () => {
    popout2.style.display = 'block';
    popout.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === popout || event.target === popoutCloseButton) {
        popout.style.display = 'none';
    }
    if (event.target === popout2 || event.target === popoutCloseButton2) {
        popout2.style.display = 'none';
    }
});

popoutContent.addEventListener('click', (event) => {
    event.stopPropagation();
});

popoutCloseButton.addEventListener('click', () => {
    popout.style.display = 'none';
});

popoutCloseButton2.addEventListener('click', () => {
    popout2.style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function() {
  const notification = document.getElementById('notification');

  function showNotification() {
    notification.style.display = 'block';
    setTimeout(function() {
      hideNotification();
    }, 10000); // 10 seconds
  }

  function hideNotification() {
    notification.style.display = 'none';
  }

  // Show notification when the page loads
  showNotification();
});

// Zobraz  loader s animac  fade-in po na ten  str nky
window.addEventListener('load', function() {
    var loader = document.getElementById('loader');
    loader.style.display = 'block';
});

// Skryje loader s animac  fade-out po ur it  dob 
setTimeout(function() {
    var loader = document.getElementById('loader');
    loader.classList.add('fade-out');
    loader.addEventListener('animationend', function() {
        loader.style.display = 'none';
    });
}, 2000); // Po k  1 sekundu a pot  spust  skryt  loaderu