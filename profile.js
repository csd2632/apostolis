const serverUri = "/uploads";
const pdfUrl = window.location.href.split("/profile.php")[0] + serverUri;
$(document).ready(() => {
  $("#profileButton").on("click", () => $("#profileLink")[0].click());
  $("#upload-button").on("click", () => insertPDF());
  $("#fupForm").on("submit", function (e) {
    uploadPDF(e, this);
  });
  loadProfilePdf();

  toastr.options = {
    closeButton: true,
    newestOnTop: false,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
  };

  // $("#signUpButton").on("click", () => toggleRegisterModal(true));
});
function loadProfilePdf() {
  $.ajax({
    url: "getpdflist.php",
    type: "POST",
    dataType: "json",
    success: (response) => handlePdfFiles(response),
    error: (error) => console.log("error is :", error),
  });
}
var handlePdfFiles = (pdfList) => {
  let resultArray = pdfList.map(
    (x) =>
      `<li><a href="${pdfUrl}/${x}"  target="_blank"><text class="text-danger">${x}</text></a></li>`
  );
  $("body").append(`<div class="card"<ul>${resultArray}</ul></div>`);
};
function insertPDF() {
  //let value=$("#pdf-upload").files;
  let value = document.getElementById("pdf-upload").files;
  if (!value) return;
  let reader = new FileReader();
  reader.readAsBinaryString(value[0]);
  reader.onload = () => {
    let blob = reader.result;
    // let pdf = new Uint8Array(blob);

    let pdf = new Blob([blob], { type: "application/pdf" });
    console.log(pdf);
    uploadPDF(pdf);
  };
}
function logOut() {
  $("#logoutLink")[0].click();
}
function uploadPDF(e, form) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: "upload.php",
    data: new FormData(form),
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,

    success: function (response) {
      //console.log(response);

      if (response.status == 1) {
        $("#fupForm")[0].reset();
        toastr.success("Success!!", response.message);
      } else {
      }
    },
    error: (e) => console.log("this is error response : ", e),
  });

  // var xhr = new XMLHttpRequest();
  // xhr.open("POST", "upload.php", true);
  // xhr.onload = function (e) {
  //   console.log("Sent");
  // };
  // xhr.send({ pdf: blob });
  // xhr.onreadystatechange = function () {
  //   if (xhr.readyState === 4) {
  //     if (xhr.response) {
  //       alert("data uploaded");
  //       console.log("the respose is : ", xhr.response);
  //     } else {
  //       alert("something went wrong try again");
  //     }
  //   }
  // };
  // let data = new FormData();
  // data.append("file", JSON.stringify(blob));
  // $.ajax({
  //   url: "/upload.php",
  //   data: { pdf: data },
  // }).done(function (data) {
  //   console.log("data are :", data);
  // });
  // let formData = new FormData();
  // formData.append("source", blob);
  // let data = new FormData(blob);
  // $.ajax({
  //   type: "POST",
  //   url: "upload.php",
  //   data: data,
  //   contentType: false,
  //   processData: false,
  //   success: function (result) {
  //     if (result) alert("file uploaded");
  //     console.log(result);
  //   },
  //   error: function (response) {
  //     alert("something went wrong fuck off");
  //   },
  // });
}
