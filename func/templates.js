function checkBoxTemplate() {
    return`

    <h1></h1>
    <div class="social-share">
    <button class="share-btn"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
    <div class="social-links">
      <ul>
        <li><a<button class="btn btn-primary" style="width: 100px;"onclick="check_function(1)">mapping</button></i></a></li>
        <li><a<button class="btn btn-primary" style="width: 100px;"onclick="check_function(2)">pigment</button></i></a></li>
        <li><a<button class="btn btn-primary" style="width: 100px;"onclick="check_function(3)">similiar</button>
        <li><a<button class="btn btn-primary" style="width: 100px;"onclick="check_function(4)">underlying</button>
        <li><a<button class="btn btn-primary" style="width: 100px;" onclick="check_function(5)">visible</button>
        <li><a<button class="btn btn-primary" style="width: 100px;" onclick="check_function(6)">uv</button>
        <li><a<button class="btn btn-primary" style="width: 100px;" onclick="check_function(7)">full report</button>
        <li><a<button class="btn btn-primary" style="width: 100px;" ><a href="game.html"></a>mini game</button>
      </ul>
    </div>
    </div>

    
    <!--<label class="container">similiar
      <input type="checkbox" id="similiar" onclick="check_function(3)">
      <span class="checkmark"></span>
    </label>-->
    
    </div>
    </div>
    </div>`
    
}
function imageTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>PROJECT REPORT</h1>
    </div>
    <div class="paintings">
        <img class="paint-img" src="${paint.diagnosis_material_data.damage.damageLineItems[0].imagePaths[0]}" onclick="image(this)" role="button" id="test_image">
        <section>
        <h2 class="NAME">TITLE</h2>
        <h3 class="paint-name_left">${paint.name}   </h3>
        <h2 class="NAME">DATE</h2>
        <h3 class="paint-name_left">${paint.signature_date}   </h3>
        <h2 class="NAME">MATERIALS</h2>
        <h3 class="paint-name_left">${paint.material}  </h3>
        <h2 class="NAME">INSTITUTION</h2>
        <h3 class="paint-name_left">${paint.signature_place}</h3>
        <h2 class="NAME">DESCRIPTION</h2>
 
        </section>
        <section>
        <h2 class="NAME">INV V</h2>
        <h3 class="paint-name_left">${paint.inventory_number}   </h3>
        <h2 class="NAME">DESIGNATION</h2>
        <h3 class="paint-name_left">${paint.designation}   </h3>
        <h2 class="NAME">DIMENSION</h2>
        <h3 class="paint-name_left">${paint.dimensions}  </h3>
        <h2 class="NAME">PERSON</h2>

 
        </section>
    </div>
    `
}
function mappingTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>MAPPING IMAGE</h1>
    </div>
    <div class="paintings">
        <div>
            <img class="mapped-paint-img" src="${paint.interventions[0][0]}" width="${calculate_mapped_img_size(4)}"> <img class="mapped-paint-img" src="${paint.interventions[1][0]}" width="${calculate_mapped_img_size(4)}"><img class="mapped-paint-img" src="${paint.interventions[2][0]}" width="${calculate_mapped_img_size(4)}"><img class="mapped-paint-img" src="${paint.interventions[3][0]}" width="${calculate_mapped_img_size(4)}">
            <img class="mapped-paint-img" src="${paint.interventions[4][0]}" width="${calculate_mapped_img_size(4)}"> <img class="mapped-paint-img" src="${paint.interventions[5][0]}" width="${calculate_mapped_img_size(4)}"><img class="mapped-paint-img" src="${paint.interventions[6][0]}" width="${calculate_mapped_img_size(4)}"><img class="mapped-paint-img" src="${paint.interventions[7][0]}" width="${calculate_mapped_img_size(4)}">
            <img class="mapped-paint-img" src="${paint.interventions[8][0]}" width="${calculate_mapped_img_size(4)}"> <img class="mapped-paint-img" src="${paint.interventions[9][0]}" width="${calculate_mapped_img_size(4)}"><img class="mapped-paint-img" src="${paint.interventions[10][0]}" width="${calculate_mapped_img_size(4)}"><img class="mapped-paint-img" src="${paint.interventions[11][0]}" width="${calculate_mapped_img_size(4)}">
            <img class="mapped-paint-img" src="${paint.interventions[12][0]}" width="${calculate_mapped_img_size(4)}">
        </div>
            
           
    </div>


    `
}

function pigmentTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>PIGMENT IDENTIFICATION</h1>
    </div>
    <div class="paintings">
        <div class="charts">
        <div class="charts__chart chart--p100 chart--default" data-percent></div><!-- /.charts__chart -->
        <div class="charts__chart chart--p80 chart--blue" data-percent></div><!-- /.charts__chart -->
        <div class="charts__chart chart--p60 chart--green" data-percent></div><!-- /.charts__chart -->
        <div class="charts__chart chart--p40 chart--red" data-percent></div><!-- /.charts__chart -->
        <div class="charts__chart chart--p20 chart--yellow" data-percent></div><!-- /.charts__chart -->
        <div class="charts__chart chart--p5 chart--grey" data-percent></div><!-- /.charts__chart -->
        <div>
            <img class="center_paint-img" style = "orizontal-align:middle" src="${paint.interventions[3][0]}">
        </div>
    </div>
    `
}
function similiarTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>SIMILIAR SURFACE</h1>
    </div>
    <div class="paintings">
        <img class="mapped-paint-img" src="${paint.interventions[3][0]}" width="${calculate_mapped_img_size(2)}"><img class="mapped-paint-img" src="${paint.interventions[2][0]}" width="${calculate_mapped_img_size(2)}">
    </div>
    `
}
function underlyingTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>UNDERLYING SURFACE</h1>
    </div>
    <div class="paintings">
        <img class="center_paint-img" style = "orizontal-align:middle" src="${paint.interventions[3][0]}" >
    </div>
    `
}
function visibleTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>VISIBLE VARNISH</h1>
    </div>
    <div class="paintings">
        <img class="center_paint-img" src="${paint.interventions[5][0]}">
    </div>
    `
}
function uvTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>UV IMAGE</h1>
    </div>
    <div class="paintings">
        <img class="center_paint-img" src="${paint.interventions[1][0]}">
    </div>
    `
}
function diagnosisTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>DIAGNOSIS REPORT</h1>
    </div>
    <div class="paintings">
        <img class="center_paint-img" src="${paint.interventions[2][0]}">
    </div>
    `
}
function frameTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>FRAME</h1>
    </div>
    <div class="paintings">
        <img class="center_paint-img" src="${paint.interventions[7][0]}">
    </div>
    `
}
function damageTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>DAMAGE</h1>
    </div>
    <div class="pains">
    <div class="gallery_3dimg">
        <div class="gallery">
            <img src="${paint.interventions[0][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery">
            <img src="${paint.interventions[2][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
    
        <div class="gallery" style="margin-right: 35px;">
            <img src="${paint.interventions[1][0]}" >
            <div class ="desc">Add a description to the image  here</div>  
        </div>
            <h2> MISSING WEDGES </h2>
             
    </div>
    
    
    <div class="gallery_3dimg">
        <div class="gallery">
            <img src="${paint.interventions[2][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery">
            <img src="${paint.interventions[4][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery"  style="margin-right: 35px;">
            <img src="${paint.interventions[6][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <h2> DIRT </h2>
    </div>

    <div class="gallery_3dimg">
        <div class="gallery">
            <img src="${paint.interventions[8][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery">
            <img src="${paint.interventions[9][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery"  style="margin-right: 35px;">
            <img src="${paint.interventions[10][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
       
        <h2> WOODWORM </h2>
        

    </div>
    <div>
        <h2> COMMENTS </h2>
        <h3 class="paint-name_left">${paint.diagnosis_pictorial_data.damage.comments}  </h3>
    </div>
    </div>

    `
}
function observationTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>OTHER OBSERVATION ON THE TEXTI DAMAGE</h1>
    </div>
    <div class="pains">
    <div class="gallery_3dimg">
        <div class="gallery">
            <img src="${paint.interventions[3][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery">
            <img src="${paint.interventions[4][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
    
        <div class="gallery" style="margin-right: 35px;">
            <img src="${paint.interventions[6][0]}" >
            <div class ="desc">Add a description to the image  here</div>  
        </div>
            <h2> DIRT </h2>
    </div>
    
    
    <div class="gallery_3dimg">
        <div class="gallery">
            <img src="${paint.interventions[8][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery">
            <img src="${paint.interventions[9][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery"  style="margin-right: 35px;">
            <img src="${paint.interventions[3][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <h2> OXIDATION </h2>
    </div>

    <div class="gallery_3dimg">
        <div class="gallery">
            <img src="${paint.interventions[4][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery">
            <img src="${paint.interventions[9][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
        <div class="gallery"  style="margin-right: 35px;">
            <img src="${paint.interventions[2][0]}">
                <div class ="desc">Add a description to the image  here</div>
        </div>
       
        <h2> STAINS </h2>
        

    </div>
    </div>

    `

}
function surfaceTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>SURFACE CHARACTERIZATION</h1>
    </div>
    
    <div class="paintings">
        <div class="gallery_3dimg">
            <img class="paint-img" src="${paint.interventions[1][0]}">
            <section>
            <h2> <ul>
            <li>text</li>
            <li>text</li>
            <li>text</li>
            </ul>  </h2>
            <h2> BLOOM </h2>
            <h2> CHALKING </h2>
            <h2> CRAQUELURE </h2>
            </section>
        </div>
    </div>
    `
}
function intervationTemplate(paint) {
    return `
    <div class="paintings_header">
    <h1>INTERVATION REPORT</h1>
    </div>
    <div class="pains">
    <div class="gallery_3dimg">
    <div class="gallery">
        <img src="${paint.interventions[0][0]}">
        <div class ="desc">Add a description to the image  here</div>
    </div>
    <h2> STAINS </h2>
    <div class="gallery">
        <img src="${paint.interventions[1][0]}">
        <div class ="desc">Add a description to the image  here</div>
    </div>
    </div>

    <div class="gallery_3dimg">
    <div class="gallery">
        <img src="${paint.interventions[2][0]}">
        <div class ="desc">Add a description to the image  here</div>
    </div>
    <h2> STAINS </h2>
    <div class="gallery">
        <img src="${paint.interventions[3][0]}">
        <div class ="desc">Add a description to the image  here</div>
    </div>
    </div>

    <div class="gallery_3dimg">
        <div class="gallery">
            <img src="${paint.interventions[4][0]}">
            <div class ="desc">Add a description to the image  here</div>
        </div>
        <h2 style="margin: 10px;">DUST </h2>
        <div class="gallery">
            <img src="${paint.interventions[6][0]}">
            <div class ="desc">Add a description to the image  here</div>
        </div> 
        

    </div>
    </div>

    `

}
function pictorialTemplate(paint) {
    return`
        <div class="paintings_header">
        <h1>PICTORIAL COVER STUDY</h1>
        </div>
        <div class="paintings">
                <section>
               
                <h2> comments </h2>
                <h3 class="paint-name_left">${paint.diagnosis_pictorial_data.pictorialCover.comments}  </h3>
                <h2> convservationState</h2>
                <h3 class="paint-name_left">${paint.diagnosis_pictorial_data.pictorialCover.conservationState}  </h3>
                </section>
                <section>
                <h2> strokeShape </h2>
                <h3 class="paint-name_left">${paint.diagnosis_pictorial_data.pictorialCover.strokeShape}  </h3>
                <h2> technique</h2>
                <h3 class="paint-name_left">${paint.diagnosis_pictorial_data.pictorialCover.technique}  </h3>
                </section>
           
        </div>`

}