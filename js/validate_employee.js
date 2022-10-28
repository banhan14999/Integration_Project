// const employeeId = document.getElementById("id");
// const lastname = document.getElementById("lastname");
// const email = document.getElementById("email");
// const nameEmployee = document.getElementById("name");
// const city = document.getElementById("city");
// const address = document.getElementById("address");
// const date = document.getElementById("date");
// const phone = document.getElementById("phone");
// const payrate = document.getElementById("payrate");
// const form = document.getElementById("form");


// form.addEventListener('submit', function (e) {
//     if (nameEmployee.value.length === 0) {
//         e.preventDefault();
//         document.getElementById("err_name").innerHTML = "Name is required*";
//         document.getElementById("err_name").style.color = "red";
//     }
//     else
//         document.getElementById("err_name").innerHTML = "";

//     if (nameEmployee.value.length === 0 || nameEmployee.value === null || date.value=='' || date.value==null) {
//         e.preventDefault();
//         document.getElementById("err_date").innerHTML = "Date is required*";
//         document.getElementById("err_date").style.color = "red";
//     }
//     else
//         document.getElementById("err_date").innerHTML = "";
//     if (email.value == ""){
//         e.preventDefault();
//         document.getElementById("err_email").innerHTML = "Email is required*";
//         document.getElementById("err_email").style.color = "red";
//     }
//     else{
//         const reg = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/g
//         if (!reg.test(email.value)){
//             e.preventDefault();
//             document.getElementById("err_email").innerHTML = "Invalid Email";
//             document.getElementById("err_email").style.color = "red";
//         }
//         else{
//             ocument.getElementById("err_email").innerHTML = "";  
//         }  
//     }
//     if (lastname.value.length === 0) {
//         e.preventDefault();
//         document.getElementById("err_lastname").innerHTML = "Last Name is required*";
//         document.getElementById("err_lastname").style.color = "red";
//     }
//     else{
//         document.getElementById("err_lastname").innerHTML = "";
//     }
//     if (address.value.length === 0) {
//         e.preventDefault();
//         document.getElementById("err_address").innerHTML = "Address is required*";
//         document.getElementById("err_address").style.color = "red";
//     }
//     else{
//         document.getElementById("err_address").innerHTML = "";
//     }
//     if (city.value.length === 0) {
//         e.preventDefault();
//         document.getElementById("err_city").innerHTML = "City is required*";
//         document.getElementById("err_city").style.color = "red";
//     }
//     else{
//         document.getElementById("err_city").innerHTML = "";
//     }
//     if (payrate.value === "") {
//         e.preventDefault();
//         document.getElementById("err_pay").innerHTML = "Pay Rate is required*";
//         document.getElementById("err_pay").style.color = "red";
//     }
//     else{
//         document.getElementById("err_pay").innerHTML = "";
//     }
//     if (phone.value == ""){
//         e.preventDefault();
//         document.getElementById("err_email").innerHTML = "Phone is required*";
//         document.getElementById("err_email").style.color = "red";
//     }
//     else{
//         const vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
//         if (!vnf_regex.test(phone.value)){
//             e.preventDefault();
//             document.getElementById("err_email").innerHTML = "Invalid Phone Numbẻ";
//             document.getElementById("err_email").style.color = "red";
//         }
//         else{
//             ocument.getElementById("err_email").innerHTML = "";  
//         }  
//     }
// });