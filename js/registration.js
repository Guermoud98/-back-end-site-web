// // Registration 

// const form = document.getElementById("form");
// // const error = document.getElementById("error");
// const firstName = document.getElementById("First name");
// const lastName = document.getElementById("Last name");
// const email = document.getElementById("email");
// const password = document.getElementById("password");
// const smallOne = document.getElementById("one");
// const smallTwo = document.getElementById("two");
// const smallThree = document.getElementById("three");
// const smallFour = document.getElementById("four");



// form.addEventListener('submit', (e) => {
//     e.preventDefault();

//     checkInputs();
// });

// emailvalidation
// function emailIsValid(email) {
//     const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
// 	return re.test(String(email))
// }

// function checkInputs() {
//     // get the values from the inputs
//     const firstNameValue = firstName.value.trim();
//     const lastNameValue = lastName.value.trim();
//     const emailValue = email.value.trim();
//     const passwordValue = password.value.trim();
//     let infor = [];

//     if (firstNameValue === '' || lastNameValue === '') {
//         smallOne.style.display = "block";
//         smallTwo.style.display = "block";
//         smallOne.textContent = "The first name cannot be blank";
//         smallTwo.textContent = "The last name cannot be blank";

//     }
//      if (firstNameValue.length > 0 || lastNameValue.length > 0) {
//         smallOne.style.display = "none";
//         smallTwo.style.display = "none"
//         infor.push(firstNameValue);
//         infor.push(lastNameValue);
//         console.log(infor);
        
//     } else if (emailValue == '' )  { 
//         smallThree.style.display = "block";
//         smallThree.textContent = "You have entered an invalid email address!";

//     }
//     //  else if (!emailIsValid(email) ) {
//     //     smallThree.style.display = "block";
//     //     smallThree.textContent = "You have entered an invalid email address!";
        

//     // } 
//     else if (emailIsValid(emailValue)) {
//         smallThree.style.display = "none";
//         infor.push(emailValue);
//         console.log(infor);
//         console.log(infor);

//     }
//     if (passwordValue === '') {
//         smallFour.style.display = "block";
//         smallFour.textContent = "Enter your password";


//     } 
//    else if (passwordValue.length <= 6) {
//         smallFour.style.display = 'block';
//         smallFour.textContent = 'Password must be longer than 6 characters';
//     }  
//     else if (passwordValue.length >= 20) {
//         smallFour.style.display = 'block';
//         smallFour.textContent = 'Password must be less than 20 characters';

//     } else {
//         smallFour.style.display = 'none';
//         infor.push(passwordValue);
//         console.log(infor);
//     }

// }




