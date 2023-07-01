let email = document.getElementById("exampleInputEmail1");
let name = document.getElementById("exampleInputfullname");
let number = document.getElementById("exampleInputphoneno");
let address = document.getElementById("exampleInputaddress");
let emailRE = document.getElementById("exampleInputEmailRE");
let emailNP = document.getElementById("exampleInputEmailNP");
let emailNPC = document.getElementById("exampleInputEmailNPC");
let password = document.getElementById("exampleInputPassword1");
let bookName = document.getElementById("exampleInputBookName");
let publisher = document.getElementById("exampleInputpublisher");
let Isbn = document.getElementById("exampleInputIsbn");
let author = document.getElementById("exampleInputAuthor");
let title = document.getElementById("exampleInputtitle");
let amount = document.getElementById("exampleInputamount");
let duration = document.getElementById("Duration");
let keyword = document.getElementById("keyword");
let from = document.getElementById("from");
let to = document.getElementById("to");

let flag = 0;

// FOR-LOGIN
function loginForm() {
  if (email.value == "") {
    document.getElementById("emailE").innerHTML = "Email required!";
    flag = 0;
  } else {
    document.getElementById("emailE").innerHTML = "";
    flag = 1;
  }

  if (password.value == "") {
    document.getElementById("passE").innerHTML = "Password required!";
    flag = 0;
  } else {
    document.getElementById("passE").innerHTML = "";
    flag = 1;
  }
  if (flag) {
    return true;
  } else {
    return false;
  }
}

// FOR FORGOT-PASSWORD
function forgotForm() {
  if (email.value == "") {
    document.getElementById("emailE").innerHTML = "Email required!";
    flag = 0;
  } else {
    document.getElementById("emailE").innerHTML = "";
    flag = 1;
  }
  if (flag) {
    return true;
  } else {
    return false;
  }
}

// FOR RESET-PASSWORD
function resetForm() {
  if (emailRE.value == "") {
    document.getElementById("emailERE").innerHTML = "Enter password code!";
    flag = 0;
  } else {
    document.getElementById("emailERE").innerHTML = "";
    flag = 1;
  }

  if (emailNP.value == "") {
    document.getElementById("emailENP").innerHTML = "Enter new password!";
    flag = 0;
  } else if (emailNP.value.length < 8) {
    document.getElementById("emailENP").innerHTML =
      "min password length 8 character!";
    flag = 0;
  } else {
    document.getElementById("emailENP").innerHTML = "";
    flag = 1;
  }

  if (emailNPC.value == emailNP.value) {
    document.getElementById("emailENPC").innerHTML = "";
    flag = 0;
  } else {
    document.getElementById("emailENPC").innerHTML = "password Not match!";
    flag = 1;
  }
  if (flag) {
    return true;
  } else {
    return false;
  }
}

// FOR ADD-BOOK
function addbookForm() {
  if (bookName.value == "") {
    document.getElementById("bookNE").innerHTML = "Enter book name!";
    flag = 0;
  } else {
    document.getElementById("bookNE").innerHTML = "";
    flag = 1;
  }

  if (publisher.value == "") {
    document.getElementById("publisherE").innerHTML = "Enter publisher name!";
    flag = 0;
  } else {
    document.getElementById("publisherE").innerHTML = "";
    flag = 1;
  }

  if (Isbn.value == "") {
    document.getElementById("isbnE").innerHTML = "Enter ISBN number!";
    flag = 0;
  } else {
    document.getElementById("isbnE").innerHTML = "";
    flag = 1;
  }
  if (author.value == "") {
    document.getElementById("authorE").innerHTML = "Enter author name!";
    flag = 0;
  } else {
    document.getElementById("authorE").innerHTML = "";
    flag = 1;
  }
  if (flag) {
    return true;
  } else {
    return false;
  }
}

// FOR ADD-STUDENT
function addstudentForm() {
  if (email.value == "") {
    document.getElementById("emailE").innerHTML = "Email required!";
    flag = 0;
  } else {
    document.getElementById("emailE").innerHTML = "";
    flag = 1;
  }
  if (name.value == "") {
    document.getElementById("nameE").innerHTML = "Enter name!";
    flag = 0;
  } else {
    document.getElementById("nameE").innerHTML = "";
    flag = 1;
  }
  if (number.value == "") {
    document.getElementById("phoneE").innerHTML = "Enter phone no!";
    flag = 0;
  } else {
    document.getElementById("phoneE").innerHTML = "";
    flag = 1;
  }
  if (address.value == "") {
    document.getElementById("addressE").innerHTML = "Enter address!";
    flag = 0;
  } else if (address.value.length < 20) {
    document.getElementById("addressE").innerHTML =
      "Please enter full address!";
    flag = 0;
  } else {
    document.getElementById("addressE").innerHTML = "";
    flag = 1;
  }
  if (flag) {
    return true;
  } else {
    return false;
  }
}

// FOR ADD PLANS
function addplansForm() {
  if (title.value == "") {
    document.getElementById("titleE").innerHTML = "Enter title!";
    flag = 0;
  } else {
    document.getElementById("titleE").innerHTML = "";
    flag = 1;
  }
  if (amount.value == "") {
    document.getElementById("amountE").innerHTML = "Enter amount!";
    flag = 0;
  } else {
    document.getElementById("amountE").innerHTML = "";
    flag = 1;
  }
  if (duration.value == "") {
    document.getElementById("durationE").innerHTML = "Select duration!";
    flag = 0;
  } else {
    document.getElementById("durationE").innerHTML = "";
    flag = 1;
  }
  if (flag) {
    return true;
  } else {
    return false;
  }
}

// FOR PURCHASE-FORM
function purchasesearchForm() {
  if (keyword.value == "") {
    document.getElementById("keywordE").innerHTML = "Required!";
    flag = 0;
  } else {
    document.getElementById("keywordE").innerHTML = "";
    flag = 1;
  }
  if (from.value == "") {
    document.getElementById("fromE").innerHTML = "Required!";
    flag = 0;
  } else {
    document.getElementById("fromE").innerHTML = "";
    flag = 1;
  }
  if (to.value == "") {
    document.getElementById("toE").innerHTML = "Required!";
    flag = 0;
  } else {
    document.getElementById("toE").innerHTML = "";
    flag = 1;
  }
  if (flag) {
    return true;
  } else {
    return false;
  }
}

// setTimeout(() => {
//   input.nextElementSibling.textContent = "";
// }, 2000);


