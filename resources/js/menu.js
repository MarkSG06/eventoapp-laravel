const menu = document.querySelector('.menu');
const menuOptions = document.querySelector('.menu-options');
menu.addEventListener('click', () =>
{
  menuOptions.classList.toggle('active');
})

const user = document.querySelector('.user');
const userOptions = document.querySelector('.user-options');
const svg = document.querySelector('.arrow-user');
user.addEventListener('click', () =>
{
  userOptions.classList.toggle('active');
  svg.classList.toggle('active');
})

const logout = document.querySelector('.logout');
logout.addEventListener('click', () =>
{
  fetch(``, {
    method: 'get',
  })
})
