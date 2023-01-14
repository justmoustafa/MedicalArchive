// Start click on link in nav then go to section


// Start Random Background
let header = document.querySelector('.header');
let imgArray = ['header_01.jpg', 'header_02.jpg', 'header_03.jpg', 'header_04.jpg', 'header_05.jpg']; 

// function To Randomize Imgs
function randmizeimgs() {
  backgroundInterval = setInterval(() => {
  let randomNumber = Math.floor(Math.random() * imgArray.length);
  header.style.backgroundImage = 'url("./images/' + imgArray[randomNumber] +'")'
  }, 1000);
}

randmizeimgs()

// Start Show List in Small Page
let listIcon = document.querySelector("nav .container .fa-bars ");
let list = document.querySelector("nav .main-links");
// console.log(listIcon)

listIcon.onclick = function(){
  if(list.classList.contains("ListActive")) {
    this.classList = "fa-sharp fa-solid fa-bars"
    list.classList.remove("ListActive")
  }
  else {
    this.classList = "fa-solid fa-xmark"
    list.classList.add("ListActive")
  }
}


/// Start Popup ///
// Reg Variables
let btnReg = document.querySelector('.landing .btn .reg');
let popupRegAs = document.querySelector('.reg-as-popup');
let regPopupInnerAs = document.querySelector(".reg-as-popup .inner");
let popupRegAsClose = document.querySelector('.reg-as-popup .inner .fa-xmark');

// Login Variables
let btnLog = document.querySelector('.landing .btn .log');
let popupLogAs = document.querySelector('.log-as-popup');
let logPopupInnerAs = document.querySelector(".log-as-popup .inner");
let popupLogAsClose = document.querySelector('.log-as-popup .inner .fa-xmark');

// Function popup
function RegAndLog(btn, popupAs, popupInner, closeIcon){
  btn.onclick = function(){
    popupAs.style.display = "block"
    id = setInterval(function(){
      popupInner.style.cssText = "top: 50%; opacity: 1; transition: 1.2s"
    },5)
  }
  // close popup
  closeIcon.onclick = function(){
    popupAs.style.display = "none";
    popupInner.style.cssText = "top: 20%; opacity: 0; transition: 0s"
    clearInterval(id)
  };
}

// Login Popup
RegAndLog(btnLog, popupLogAs, logPopupInnerAs, popupLogAsClose)
// Reg Popup
RegAndLog(btnReg, popupRegAs, regPopupInnerAs, popupRegAsClose)

//-------------------------------------------------------

// let arrImages = Array.from(formReg.elements)


// let popupReg = document.querySelector('.reg-popup');
// let regPopupInner = document.querySelector(".reg-popup .inner");
// let popupRegClose = document.querySelector('.reg-popup .inner .fa-xmark');

// let popupLog = document.querySelector('.log-popup');
// let logPopupInner = document.querySelector(".log-popup .inner");


// popupRegClose.onclick = function(){
//   popupReg.style.display = "none";
//   regPopupInner.style.cssText = "top: 20%; opacity: 0; transition: 0s"
//   clearInterval(idReg)
// };


// let persons = document.querySelectorAll(".popup.reg-as-popup form .person");

// let ArrPersonsDiv = Array.from(persons);
// let ArrPersons = [];

// ArrPersonsDiv.forEach(el => {

//   ArrPersons.push(el.dataset.person);
// })

// console.log(persons)
// console.log(ArrPersons)

// persons.forEach(person => {
//   if(person == "doctor"){

//   }
// })

// persons.onclick = function(e){
//   e +' input'.preventDefault();
//   // let personAs = this.dataset.person;
//   // popupRegAsClose.onclick();
//   // popupReg.style.display = "block"
//   //   idReg = setInterval(function(){
//   //   regPopupInner.style.cssText = "top: 50%; opacity: 1; transition: 1.2s"
//   // },5)

//   console.log(e);
// }

// ---------------------
// let showPopReg = document.querySelector('.landing .btn .reg');
// let showPopLog = document.querySelector('.landing .btn .log');

// let popupReg = document.querySelector('.reg-popup');
// let popupLog = document.querySelector('.log-popup');

// let regPopupInner = document.querySelector(".reg-popup .inner");
// let logPopupInner = document.querySelector(".log-popup .inner");

// let CloseIconReg = document.querySelector(".reg-popup .inner i");
// let CloseIconLog = document.querySelector(".log-popup .inner i");

// let formReg = document.querySelector(".reg-popup form")
// let arrInputsReg = Array.from(formReg.elements)

// let formLog = document.querySelector(".log-popup form")
// let arrInputsLog = Array.from(formLog.elements)

// showPopReg.onclick = function(){
//   // console.log(this.dataset.popup)
//   let regPopup = document.querySelector(this.dataset.popup);
//   let regPopupInner = document.querySelector(this.dataset.popup + " .inner");

//   arrInputsReg.forEach(element => {
//     if(element.type != "submit")
//       element.value = "";
//   });

//   arrInputsLog.forEach(element => {
//     if(element.type != "submit")
//       element.value = "";
//   });
//   popupReg.style.display = "none";
//   regPopup.style.display = "block"
//   idReg = setInterval(function(){
//     regPopupInner.style.cssText = "top: 50%; opacity: 1; transition: 1.2s"
//   },5)
// }
// popupReg.onclick = function(){
//   popupReg.style.display = "none";
//   regPopupInner.style.cssText = "top: 20%; opacity: 0; transition: 0s"
//   clearInterval(idReg)
// }

// showPopLog.onclick = showPopReg.onclick

// popupLog.onclick = function(){
//   popupLog.style.display = "none";
//   logPopupInner.style.cssText = "top: 20%; opacity: 0; transition: 0s"
//   clearInterval(idReg)
// }

// CloseIconReg.onclick = popupReg.onclick;
// CloseIconLog.onclick = popupLog.onclick

// regPopupInner.onclick = function(e){
//   e.stopPropagation()
// }
// logPopupInner.onclick = function(e){
//   e.stopPropagation()
// }

// $('.popup .inner button').click(function(e){
//     e.preventDefault()
//     $('.popup').hide()
// })

// $(document).on('keydown', function(e){
//     if(e.keyCode == 27 ) {
//         $('.popup').fadeOut()
//     }
// })



