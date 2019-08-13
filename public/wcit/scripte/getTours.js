var radioCount = 0
var rCount = 0
fetch('https://www.armeniatravel.am/api/wcit/excursions')
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {

        createTours(myJson)

    });


function createTours(json) {
    var excursionBlok = document.querySelector('.excursion_block')

    json.forEach(tour => {
        excursionBlok.appendChild(createExcursionBlock(tour))
    });
    // document.body.innerHTML += `
    
    
    // <script src="./scripte/script.js">
    // </script><script src="./scripte/swipe.min.js"></script>
    // <script src="./scripte/mySwip.js"></script>
    // <script src="./scripte/pickmeup.js "></script>
    // <script src="./scripte/myPickmeup.js "></script>
    // <script src="./scripte/auxiliary.js"></script>
    // <script src="./scripte/main.js"></script>
    // <script src="./scripte/Mselect.js"></script>
    // <script src="./scripte/myMselect.js"></script>`

    // var script = document.createElement('script')
    // script.src = './scripte/script.js'
    // document.body.appendChild(script)


    var script = document.createElement('script')
    script.src = './scripte/swipe.min.js'
    document.body.appendChild(script)

    var script = document.createElement('script')
    script.src = './scripte/mySwip.js'
    document.body.appendChild(script)

    var script = document.createElement('script')
    script.src = './scripte/pickmeup.js '
    document.body.appendChild(script)

    var script = document.createElement('script')
    script.src = './scripte/myPickmeup.js '
    document.body.appendChild(script)


    var script = document.createElement('script')
    script.src = './scripte/auxiliary.js '
    document.body.appendChild(script)

    var script = document.createElement('script')
    script.src = './scripte/main.js '
    document.body.appendChild(script)



    var script = document.createElement('script')
    script.src = './scripte/myMselect.js '
    document.body.appendChild(script)


}


function createExcursionBlock(tour) {
    var excursionContainer = document.createElement('div');
    var excursion_component = document.createElement('div');
    excursion_component.innerHTML += swiperComponent(tour);
    excursion_component.innerHTML += tourDescription(tour);

    excursionContainer.appendChild(excursion_component);

    excursionContainer.classList.add("excursion_component_container", "container-fluid", "px-0");
    excursion_component.classList.add("excursion_component", "row");

    return excursionContainer
}

function swiperComponent(tour) {

    var swiperComponent = `
    
    <div class="swipers_container col-xl-4">
    <div class="swiper-container gallery-top position-relative">
       <div class="preloader">
          <svg class="lds-eclipse" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 100 100" preserveaspectratio="xMidYMid">
             <path ng-attr-d="{{config.pathCmd}}" ng-attr-fill="{{config.color}}" stroke="none" d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#28292f" transform="rotate(13.1609 50 51)">
                <animatetransform attributename="transform" type="rotate" calcmode="linear" values="0 50 51;360 50 51" keytimes="0;1" dur="1s" begin="0s" repeatcount="indefinite"></animatetransform>
             </path>
          </svg>
       </div>
    `;

    var swiperWrapper = `
        <div class="swiper-wrapper">
        
    `;
    var buttons = ` <div class="swiper-button-next">
                <svg class="svg-inline--fa fa-angle-right fa-w-6 fa-fw fa-2x" aria-hidden="true" focusable="false" data-prefix="far" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 192 512">
                    <path fill="currentColor" d="M187.8 264.5L41 412.5c-4.7 4.7-12.3 4.7-17 0L4.2 392.7c-4.7-4.7-4.7-12.3 0-17L122.7 256 4.2 136.3c-4.7-4.7-4.7-12.3 0-17L24 99.5c4.7-4.7 12.3-4.7 17 0l146.8 148c4.7 4.7 4.7 12.3 0 17z"></path>
                </svg>
                </div>
                <div class="swiper-button-prev">
                    <svg class="svg-inline--fa fa-angle-left fa-w-6 fa-fw fa-2x" aria-hidden="true" focusable="false" data-prefix="far" data-icon="angle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 192 512">
                    <path fill="currentColor" d="M4.2 247.5L151 99.5c4.7-4.7 12.3-4.7 17 0l19.8 19.8c4.7 4.7 4.7 12.3 0 17L69.3 256l118.5 119.7c4.7 4.7 4.7 12.3 0 17L168 412.5c-4.7 4.7-12.3 4.7-17 0L4.2 264.5c-4.7-4.7-4.7-12.3 0-17z"></path>
                    </svg>
                </div>`;


    var assessment_of_tur = `<div class="assessment_of_tur">${tour.assessment_of_tur ? tour.assessment_of_tur : '5+'} </div>`;


    var galleryThumbs = '<div class="swiper-container gallery-thumbs">'

    tour.photos.forEach(photo => {
        var item = `
        <div class="swiper-slide">
            <div class="swiper-slide-container">
                <img class="lazy_image" data-src="${photo.src}" alt="">
            </div>
        </div>
        `
        swiperWrapper += item
    })

    galleryThumbs += swiperWrapper += '</div>';

    swiperComponent += swiperWrapper;
    swiperComponent += buttons;

    swiperComponent += assessment_of_tur += '</div>'

    swiperComponent += galleryThumbs;
    swiperComponent += ` <div class="triangle_container"><img src="./images/Vector Smart Object.png" alt=""></div></div>`;
    return swiperComponent;
}




function tourDescription(tour) {

    tour.prices = {
        amd: tour.group_price_amd,
        usd: tour.group_price_usd,
        eur: tour.group_price_eur,
    }

    tour.privatePrice = {
        amd: tour.private_price_amd,
        usd: tour.private_price_usd,
        eur: tour.private_price_eur,
    }
    var description = `  
    <div class="excursion_description_form col-xl-8">
        <div class="container-fluid">
            <div class="row">
                 <div class="col-xl-8 px-0 py-0">
                     <p class="excursionName"><span class="name font-weight-bold">${tour.name}</span></p>`;


    var includes = '';
    tour.includes.forEach((incl, index) => {


        includes += `<div class='${+index > 0 ? 'ml-2' : ''}'><img src=${incl.icon_src}><span>${incl.name}</span></div>`
        // div(class=''+(index>0? 'ml-2':''))
        //     img(src=incl.img)
        //     span= incl.name
    })
    var privateDescription =
        `<div class="descriptionContainer">
                        <div class="shortDescription_show_all Private hide">
                            <span class="font-weight-bold">Description: </span><span> ${tour.short_description}</span><span>...</span><span class="showMore font-weight-bold">show more</span>
                            <div class="allDescription mt-2">
                                ${tour.description}
                                <span class="showLess font-weight-bold">show less</span>
                            </div>
                        </div>

                        <div class="shortDescription_show_all Group">
                            <span class="font-weight-bold">Description: </span><span> ${tour.short_description}</span><span>...</span><span class="showMore font-weight-bold">show more</span>
                            <div class="allDescription mt-2"> ${tour.description}<span class="showLess font-weight-bold">show less</span>
                            </div>
                        </div>
                        <h5 class="my-1">includes</h5>
                        <div class="includeContainer my-2">
                            `+ includes + `
                        </div>
                    </div>`
    description += privateDescription += '</div>';


    description += `<div class="col-xl-4 px-0 py-0 text-right pr-2 pt-2 tour_price">
                        <div class="eur">
                            <h2 class="black_color mb-0">${tour.prices.eur} EUR</h2>
                            <p class="mt-0 pt-0 exclude_VAT">exclude VAT</p>
                        </div>
                        <div class="other_valutas">
                            <div class="usd black_color font-weight-bold">${tour.prices.usd} USD</div>
                            <div class="amd black_color font-weight-bold">${tour.prices.amd} AMD</div>
                        </div>
                    </div>
                </div>
        `



    // p
    //     input(id='t'+ ++radioCount type='radio' value='Group' name='r'+ ++rCount checked='')
    //     label.font-weight-bold(for='t'+radioCount) Group
    // p.pl-3
    //     input(id='t'+ ++radioCount type='radio' value='Private' name='r'+ rCount)
    //     label.font-weight-bold(for='t'+radioCount) Private      
    var mOption = ''
    for (var i = 1; i < 50; i++) {
        mOption += `<div class="Moption" data-value="${i}"><span style='color:black; font-weight:bold;'>${i}</span></div>`
    }

    var dataGroup = JSON.stringify(tour.prices);
    var dataPrivate =  JSON.stringify(tour.privatePrice);
    console.log(dataGroup,dataPrivate)
    
                    //   <div class="Moption" data-value="" selected="">Language </div>
                    
                        // <div class="Moption" data-value="" selected="">Persons</div>
    var tourForm = `
        <div class="row tourForm" data-tourname="${tour.name}" data-tourprice="${tour.prices.eur}" data-tourPrivatePrice="${tour.privatePrice.eur}" data-Group='${dataGroup}' data-Private='${dataPrivate}'>
            <div class="radiosContainer custom_radio col-12 d-flex px-0" data-name="tour_type"> 
                <p><input id="${'t' + ++radioCount}" type="radio" value="Group" name="${'r' + ++rCount}" checked=""><label class="font-weight-bold" for="${'t' + radioCount}">Joining a group</label></p>

                <p class="pl-3"><input id="${'t' + ++radioCount}" type="radio" value="Private" name="${'r' + rCount}"><label class="font-weight-bold" for="${'t' + radioCount}">Private      </label></p>  
            </div>
            <div class="datePickerContainer" data-name="date"><input class="datepicker_input" type="text" data-validator="date" readonly="readonly"></div>
            <div class="tourLanguage" data-name="language">
                <div class="select_container d-inline-block" data-placeholder='language' data-validator="language">
                   <div class="Mselect d-inline-block">
                      <div class="Moption" data-value="1"><span style='color:black; font-weight:bold;'>English</span> </div>
                      <div class="Moption" data-value="2"><span style='color:black; font-weight:bold;'>Russian</span> </div>
                      <div class="Moption" data-value="3"><span style='color:black; font-weight:bold;'>French </span></div>
                   </div>
                </div>
            </div>
            <div class="persons">
                <div class="select_container d-inline-block" data-placeholder='Persons' data-validator="persons" data-name="persons">
                    <div class="Mselect d-inline-block">
                    ` + mOption + `
                    </div>
                </div>
            </div>
            <div class="addButtonContainer"><span class="btn btn-dark add_desktop"><span class='notAddedButton'>ADD</span> <span class='AddedButton'>ADDED</span> </span><span class="btn btn-dark add_mobile"><span class='notAddedButton'>ADD Excursion</span> <span class='AddedButton'>ADDED Excursion</span></span></div>
             </div>
             <div class="mobileShowForm row my-4 w-100 p-0"><span class="btn btn-dark w-100">pick tour options</span></div>
          </div>
       </div>
    </div>
 </div>
                `

    description += tourForm
    return description;

}
// setTimeout(function(){
//     var script = document.createElement('script')
//     script.innerHTML = 'alert()'
//     document.body.appendChild(script)
// },3000)