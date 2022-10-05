const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

toggleButton.addEventListener('click', () => {
  navbarLinks.classList.toggle('active')
})



let headerlinks = document.querySelectorAll('.headerlinks');

headerlinks.forEach(link => {
  if(link.href === window.location.href){
    console.log(link);
    link.setAttribute('aria-current', 'page');
    let linkcontainer = link.parentElement;
    linkcontainer.classList.add("activepage");
  };

})

// [aria-current] source: https://codepen.io/Coding-in-Public/pen/MWroExJ