paintings_names = [];
paintings_mapping = [];
colours_mapp = [];
var user_set_name = false;

console.log("testing pulls");
console.log("testing push");
let names = [
  {
    name: "first_img",
    img: "./img/0380_00800S.bmp",
    descr: "description",
    date: "2001",
    materials: "first image",
    inv: "first image",
    institution: "first image",
    designation: "first image",
    dimension: "10*10*20 cm",
    person: "first image",
  },
  {
    name: "second_img",
    img: "./img/0390_01000S.bmp",
    descr: "two",
    date: "2002",
    materials: "second image",
    inv: "second image",
    institution: "second image",
    designation: "second image",
    dimension: "10*10*20 cm",
    person: "second image",
  },
  {
    name: "third_img",
    img: "./Folder_Structure_for_Report_generator/general/projectMainImage.png",
    descr: "three",
    date: "2003",
    materials: "third image",
    inv: "third image",
    institution: "third image",
    designation: "third image",
    dimension: "10*10*20 cm",
    person: "third image",
  },
  {
    name: "forth_img",
    img: "./img/0390_01000S.bmp",
    descr: "forth",
    date: "2004",
    materials: "forth image",
    inv: "forth image",
    institution: "forth image",
    designation: "forth image",
    dimension: "10*10*20 cm",
    person: "forth image",
  },
];
let mapping = [
  {
    name: "firs_img",
    img1: "./img/0380_00800S.bmp",
    img2: "./img/0380_00800S.bmp",
    img3: "./img/0380_00800S.bmp",
    img4: "./img/0380_00800S.bmp",
  },
  {
    name: "second_img",
    img1: "./img/0390_01000S.bmp",
    img2: "./img/0390_01000S.bmp",
    img3: "./img/0390_01000S.bmp",
    img4: "./img/0390_01000S.bmp",
  },
  {
    name: "third_img",
    img1: "./img/0400_01726S.bmp",
    img2: "./img/0400_01726S.bmp",
    img3: "./img/0400_01726S.bmp",
    img4: "./img/0400_01726S.bmp",
  },
  {
    name: "forth_img",
    img1: "./img/0390_01000S.bmp",
    img2: "./img/0390_01000S.bmp",
    img3: "./img/0390_01000S.bmp",
    img4: "./img/0390_01000S.bmp",
  },
];
paintings_names.push(data);
paintings_mapping.push(data);
colours_mapp.push(names[2]);

console.log("push test");
console.log("push test");
//$.getJSON("https://bioinfobot.github.io/data/2017-05.json")
//.done(function( data ) {
//   console.log(data)
//});

function forceDownload(url, fileName) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.responseType = "blob";
  xhr.onload = function () {
    var urlCreator = window.URL || window.webkitURL;
    var imageUrl = urlCreator.createObjectURL(this.response);
    var tag = document.createElement("a");
    tag.href = imageUrl;
    tag.download = fileName;
    document.body.appendChild(tag);
    tag.click();
    document.body.removeChild(tag);
  };
  xhr.send();
}

var modalImg = document.getElementById("img01");
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal

var functions = {
  image: async function () {
    document.getElementById("templates").innerHTML = `${paintings_names
      .map(imageTemplate)
      .join("")}`;
  },
  mapping: function () {
    document.getElementById("templates").innerHTML = `${paintings_names
      .map(mappingTemplate)
      .join("")}`;
  },
};

function whateverFunction() {
  console.log("clicked");
}
function image(img) {
  var src = img.src;
  modal.style.display = "block";
  if (img.id == "test_image") {
    modal.style.marginTop = "850px";
  }

  modalImg.src = img.src;
  var msg = new SpeechSynthesisUtterance();
  msg.text = data[0].diagnosis_material_data.conservationStateData.comments;
  window.speechSynthesis.speak(msg);
  //window.open(src);
}

async function async_func() {
  var image_x = document.getElementById("myimage");

  autocomplete(document.getElementById("myInput"), data).then((message) => {
    try {
      image_x.parentNode.removeChild(image_x);
      document.getElementById("templates").innerHTML = ` 
          ${data.map(imageTemplate).join("")}
          ${checkBoxTemplate()}
          `;
    } catch (error) {
      debugger;
    }

  });
}

$(document).ready(() => {
  let isHidden = false;
  $(".menu_action_button").bind("click", () => {
    if (isHidden == false) {
      $(".menu_option").css(
        "animation",
        "hide_tray 600ms cubic-bezier(0.645, 0.045, 0.355, 1) forwards"
      );
      $(".main_container").css("width", "80px");
      setTimeout(() => {
        $(".menu_action_button").css("position", "absolute");
        $(".menu_action_button div:nth-of-type(2)").css("display", "flex");
      }, 800);
      isHidden = true;
    } else if (isHidden == true) {
      $(".menu_option").css(
        "animation",
        "show_tray 600ms cubic-bezier(0.645, 0.045, 0.355, 1) forwards"
      );
      $(".main_container").css("width", "auto");
      $(".menu_action_button").css("position", "relative");
      $(".menu_action_button div:nth-of-type(2)").css("display", "flex");
      isHidden = false;
    }
  });
  async_func();

  $("#printPdfButton").on("click", () => printPdf());
  // $("#signUpButton").on("click", () => toggleRegisterModal(true));
});
// function toggleRegisterModal(state) {
//   debugger;
//   $("#registerPopUp").show();
// }

document.addEventListener("mousemove", onMouseUpdate, false);
document.addEventListener("mouseenter", onMouseUpdate, false);

document.addEventListener("mousemove", onMouseUpdate, false);
document.addEventListener("mouseenter", onMouseUpdate, false);

const capture = async () => {
  const canvas = document.createElement("canvas");
  const context = canvas.getContext("2d");
  const video = document.createElement("video");

  try {
    const captureStream = await navigator.mediaDevices.getDisplayMedia();
    video.srcObject = captureStream;
    context.drawImage(video, 0, 0, window.innerWidth, window.innerHeight);
    console.log(
      "width is : ",
      window.innerWidth,
      "height is :",
      window.innerHeight
    );
    const frame = canvas.toDataURL("image/png");
    captureStream.getTracks().forEach((track) => track.stop());
    return frame;
  } catch (err) {
    console.error("Error: " + err);
  }
};
function printPdf() {
  // capture().then((res) => {
  //   const pdf = new jsPDF();
  //   const pdfWidth = pdf.internal.pageSize.width;
  //   const pdfHeight = pdf.internal.pageSize.height;
  //   pdf.addImage(res, "PNG", 0, 0, pdfWidth, pdfHeight);
  //   pdf.save("download.pdf");
  // });

  window.print();
  console.log("whatever");

  // html2canvas($("body")).then((canvas) => {
  //   const imgData = canvas.toDataURL("image/png");
  //   const pdf = new jsPDF();
  //   let realWidth;
  //   let realHeight;
  //   // Create dummy image to get real width and height
  //   $('<img alt="" src="">')
  //     .attr("src", imgData)
  //     .on("load", function () {
  //       realWidth = this.width;
  //       realHeight = this.height;
  //       const pdfWidth = pdf.internal.pageSize.width;
  //       const pdfHeight = pdf.internal.pageSize.height;

  //       pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);
  //       pdf.save("download.pdf");
  //     });
  // });

  // html2canvas($("body"), {
  //   onrendered: function (canvas) {
  //     const img = canvas.toDataURL("image/jpeg", 1);
  //     var doc = new jsPDF();
  //     doc.addImage(img);
  //     doc.save("sample-file.pdf");
  //   },
  // });

  // const pdf = new jsPDF("l", "pt", "a4");
  // let options = {
  //   pagesplit: true,
  // };
  // pdf.addHTML($("body"), 0, 0, options, function () {
  //   let title = `site_image_${moment().format("DD-MM-YY:hh:mm:ss")}.pdf`;
  //   pdf.save(title);
  // });
}
//imageZoom("myimage", "myresult");
// clicked = true;
//     $(document).ready(function(){
//         $(".share-btn").click(function(){
//             if(clicked){
//                 $(".social-links").css('right', '-70px');
//                 $( ".share-btn" ).addClass( "hide-links" );
//                 $( ".share-btn" ).removeClass( "show-links" );
//                 clicked  = false;
//             } else {
//                 $(".social-links").css('right', '0px');
//                 $( ".share-btn" ).addClass( "show-links" );
//                 $( ".share-btn" ).removeClass( "hide-links" );
//                 clicked  = true;
//             }
//         });
//     });
