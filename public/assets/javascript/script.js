// function myFunction() {
//     var x = document.getElementById("myTopnav");
//     if (x.className === "header__menu__nav") {
//       x.className += " responsive";
//     } else {
//       x.className = "header__menu__nav";
//     }
//   } 

// let topbtn = document.querySelector(".topbtn");
// const scrollHandler = () => {
//     const scrollPosition = window.scrollY 
//     if ( scrollPosition > 0) {
//         topbtn.style.display = 'block'
//     } else {
//         topbtn.style.display = 'none'
//     };
//   };
  
//   document.addEventListener('scroll', scrollHandler);
//   window.onload = scrollHandler;


// function to filter results while typing in searchfields




// console.log(companylinks);

var input,request, filter, tablebody, tablerows, tablerowsAar, tablecells, a, i, txtValue;
input = document.getElementById("searchinput");
request = input.value;
filter = input.value.toUpperCase();
tablebody = document.querySelector(".table__body");
tablerows = tablebody.getElementsByTagName("tr");
tablecells = tablebody.querySelector(".table__body__row__cell--companyname");


function filterResults() {
    console.log(tablecells);
// companylinks = tablecells.getElementsByTagName("a");
    
    
    // for (i = 0; i < tablecells.length; i++) {
    //     a = tablecells[i].getElementsByTagName("a")[0];
    //     // console.log(a);
    //     txtValue = a.textContent || a.innerText;
    //     if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //         tablerows[i].style.display = "";
    //     } else {
    //         tablerows[i].style.display = "none";
    //     }
    // }

    for (i = 0; i < tablecells.length; i++) {
        a = tablecells[i].getElementsByTagName("a");
        if(a.textContent.toLowerCase()
        .includes(request.toLowerCase())) {
            tablerows[i].classList.remove("is-hidden");
            // tablerows[i].style.display = "";
        }  else {
            // tablerows[i].style.display = "none";
            tablerows[i].classList.add("is-hidden");
        };
    };
};


let typingTimer;               
let typeInterval = 500;

input.addEventListener('keyup', () => {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(filterResults, typeInterval);
});