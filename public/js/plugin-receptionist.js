// Start Show List in Small Page
import { 
  doList 
} from "./plugin-patient.js";

doList();

// start forget id
let btnForgot = document.querySelector(".detection .forgot-btn");
let divForgot = document.querySelector(".detection form .forgot");

btnForgot.onclick = function(){
  divForgot.style.display = "block";
  console.log("hi")
}