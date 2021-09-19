function Impressionism(){
  $(".container-fluid").css("background","");
  $(".container-fluid").css("background","url(impressionism.jpg)");

}
function Surrealism(){
  $(".container-fluid").css("background","");
  $(".container-fluid").css("background","url(surrealism.jpg)");

}
function calculate_mapped_img_size(number) {
    return (870-(45*(number)))/number;
}

function componentToHex(c) {
    let hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}
function rgbToHex(r, g, b) {
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}
function drawChart() {
    let data_1 = google.visualization.arrayToDataTable([
        ["Element", "Density", {role: "style"}],
        ["Copper", 8.94, rgbToHex(15,15,15)],
        ["Silver", 10.49, rgbToHex(15,15,15)],
        ["Gold", 19.30, "gold"],
        ["Platinum", 21.45, "color: #e5e4e2"]
    ]);
    let view = new google.visualization.DataView(data_1);
    view.setColumns([0, 1, {
        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation"
    }, 2]);
    let options = {
        title: "color percentage",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: {position: "none"},
    };
    let chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
}
let checkboxes=[];
function check_function(numbe) {
  if(numbe==1){
    document.getElementById("templates")
    .innerHTML +=` ${data.map(mappingTemplate).join('')};`
    
  }
  if(numbe==2) {
    document.getElementById("templates")
    .innerHTML +=`${data.map(pigmentTemplate).join('')}`
    document.getElementById("pigment").checked = true;
    
  }
  if(numbe==3) {
    document.getElementById("templates")
    .innerHTML +=`${data.map(similiarTemplate).join('')}`
    document.getElementById("similiar").checked = true;
   
  }  
  if(numbe==4) {
    document.getElementById("templates")
    .innerHTML +=`${data.map(underlyingTemplate).join('')}`
    document.getElementById("underlying").checked = true;
    
  } 
  if(numbe==5) {
    document.getElementById("templates")
    .innerHTML +=`${data.map(visibleTemplate).join('')}`
    document.getElementById("visible").checked = true;
    
  }
  if(numbe==6) {
    document.getElementById("templates")
    .innerHTML +=`${data.map(uvTemplate).join('')}`
    document.getElementById("uv").checked = true;
    
  }
  if(numbe==7) {
    document.getElementById("templates")
    .innerHTML +=`${data.map(damageTemplate).join('')}`
    
    document.getElementById("templates")
    .innerHTML +=`${data.map(observationTemplate).join('')}`

    document.getElementById("templates")
    .innerHTML +=`${data.map(surfaceTemplate).join('')}`

    document.getElementById("templates")
    .innerHTML +=`${data.map(intervationTemplate).join('')}`

    document.getElementById("templates")
    .innerHTML +=`${data.map(pictorialTemplate).join('')}`

    document.getElementById("full report").checked = true;
  
  }
  else {
    text.style.display = "none";
}
}
///////////////////////////////
function imageZoom(imgID, resultID) {
    var img, lens, result, cx, cy;
    img = document.getElementById(imgID);
    result = document.getElementById(resultID);
    /*create lens:*/
    lens = document.createElement("DIV");
    lens.setAttribute("class", "img-zoom-lens");
    /*insert lens:*/
    img.parentElement.insertBefore(lens, img);
    /*calculate the ratio between result DIV and lens:*/
    cx = result.offsetWidth / lens.offsetWidth;
    cy = result.offsetHeight / lens.offsetHeight;
    /*set background properties for the result DIV:*/
    result.style.backgroundImage = "url('" + img.src + "')";
    result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
    /*execute a function when someone moves the cursor over the image, or the lens:*/
    lens.addEventListener("mousemove", moveLens);
    img.addEventListener("mousemove", moveLens);
    /*and also for touch screens:*/
    lens.addEventListener("touchmove", moveLens);
    img.addEventListener("touchmove", moveLens);
    function moveLens(e) {
      var pos, x, y;
      /*prevent any other actions that may occur when moving over the image:*/
      e.preventDefault();
      /*get the cursor's x and y positions:*/
      pos = getCursorPos(e);
      /*calculate the position of the lens:*/
      x = getMouseX() - (lens.offsetWidth / 2);
      y = pos.y - (lens.offsetHeight / 2);
      /*prevent the lens from being positioned outside the image:*/
      if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
      if (x < 0) {x = 0;}
      if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
      if (y < 0) {y = 0;}
      /*set the position of the lens:*/
      lens.style.left = x + "px";
      lens.style.top = y + "px";
      /*display what the lens "sees":*/
      result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
    }
    function getCursorPos(e) {
      var a, x = 0, y = 0;
      e = e || window.event;
      /*get the x and y positions of the image:*/
      a = img.getBoundingClientRect();
      /*calculate the cursor's x and y coordinates, relative to the image:*/
      x = e.pageX - a.left;
      y = e.pageY - a.top;
      /*consider any page scrolling:*/
      x = x - window.pageXOffset;
      y = y - window.pageYOffset;
      return {x : x, y : y};
    }
  }
  var x = null;
var y = null;

document.addEventListener('mousemove', onMouseUpdate, false);
document.addEventListener('mouseenter', onMouseUpdate, false);

function onMouseUpdate(e) {
  x = e.pageX;
  y = e.pageY;
}

function getMouseX() {
  return x;
}

function getMouseY() {
  return y;
}