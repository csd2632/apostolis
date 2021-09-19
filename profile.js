$(document).ready(() => {
$("#profileButton").on("click", () => $("#profileLink")[0].click());
$("#upload-button").on("click", () => uploadPDF());

// $("#signUpButton").on("click", () => toggleRegisterModal(true));
});
function  uploadPDF(){
//let value=$("#pdf-upload").files;
let value=document.getElementById("pdf-upload").files;
if(!value)return;
let reader = new FileReader();
reader.readAsBinaryString(value[0]);
reader.onload=()=>{
    let blob = reader.result;
    let pdf = new Blob([blob],{type:"application/pdf"});
    console.log(pdf);
}

//let resultPDF = value.toDataURL();
console.log(value);
}