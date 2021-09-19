$(document).ready(() => {
  $("#profileButton").on("click", () => $("#profileLink")[0].click());
  $("#upload-button").on("click", () => insertPDF());

  // $("#signUpButton").on("click", () => toggleRegisterModal(true));
});
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

function uploadPDF(blob) {
  //   $.ajax({
  //     url: "/upload.php",
  //     data: blob,
  //   }).done(function (data) {
  //     console.log("data are :", data);
  //   });
  //   let formData = new FormData();
  //   formData.append("source", blob);
  //   let data = new FormData(blob);
  $.ajax({
    type: "POST",
    url: "upload.php",
    data: { pdf: blob },
    success: function (result) {
      if (result) alert("file uploaded");
      alert("something went wrong fuck off");
    },
    error: function (response) {
      alert("something went wrong fuck off");
    },
  });
}
