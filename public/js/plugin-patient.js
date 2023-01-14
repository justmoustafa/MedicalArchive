// Start Show List in Small Page
export function doList() {
  
  let listIcon = document.querySelector("nav .container .fa-bars ");
  let list = document.querySelector("nav .main-links");
  
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
}

doList();