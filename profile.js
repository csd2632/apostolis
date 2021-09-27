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

  $(document).on("click", ".deletePdf", (e) => {
    let elementId = $(e.target)[0].id;
    deletePdf(elementId);
  });

  // $("#signUpButton").on("click", () => toggleRegisterModal(true));
});
var deletePdf = (id) => {
  let path = pdfUrl.split("localhost/")[1] + "/";
  $.ajax({
    url: "deletepdf.php",
    type: "POST",
    data: { id, path },
    success: (response) => toastr.error(response, "Success!"),
    error: (message) => toastr.warning("Delete Failed", message),
    complete: () => loadProfilePdf(),
  });
};
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
  $("#pdfList").empty();
  let resultArray = pdfList.map(
    (x) =>
      `<div class="d-flex justify-content-end">
      <li class="list-group-item d-inline-flex align-items-center">
      <div class="justify-self-start">
      <a href="${pdfUrl}/${x[1]}" target="_blank">
      <text class="text-danger">${x[1]}</text>
      </div>
      </a>
      <div class="justify-self-end">
      <i id="${x[0]}" class="deletePdf text-danger fa fa-trash" style="cursor: pointer;"></i>
      </div>
      </div>
      </li>`
  );
  $("#pdfList").append(`<ul class="list-group">${resultArray}</ul>`);
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
    complete: () => loadProfilePdf(),
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
