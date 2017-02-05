$(document).ready(function(){

//----------------------------MAP HEIGHT FOR WINDOW SIZE----------------------------------
    var windowHeightCalc = $('body').height()-150;
    $('#InfoMap').css({
      width: '100%',
      height: windowHeightCalc
    });
//----------------------------MAP HEIGH FOR WINDOW SIZE END-------------------------------

//----------------------------DROPDOWN SLIDE EFFECT---------------------------------------
 $('.dropdown').on('show.bs.dropdown', function(e){
   $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
 });

 // ADD SLIDEUP ANIMATION TO DROPDOWN //
 $('.dropdown').on('hide.bs.dropdown', function(e){
   $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
 });
//----------------------------DROPDOWN SLIDE EFFECT END----------------------------------
//----------------------------EMAIL PLACEHOLDER CHANGE------------------------------------
/*========================================================================================
==========================================================================================
==========================================================================================*/
    var placeHolder = [
                'test@mail.com','test@mail.co','test@mail.c','test@mail.','test@mail',
                'test@mai','test@ma','test@m','test@','test','tes','te','t','te',
                'tes','test','test@','test@m','test@ma','test@mai','test@mail','test@mail.',
                'test@mail.c','test@mail.co','test@mail.com'
              ];
    var n=0;
    var loopLength=placeHolder.length;

    setInterval(function(){
       if(n<loopLength){
          var newPlaceholder = placeHolder[n];
          n++;
          $('.email-placeholder-change').attr('placeholder',newPlaceholder);
       } else {
          $('.email-placeholder-change').attr('placeholder',placeHolder[0]);
          n=0;
       }
    },100);




//----------------------------INPUT EVENTS ISTEK DESTEK ADD--------------------------------

    // $('chekingImageDate').click(function(event) {
    //    $("#forLimitFile").css("background-color", "pink");
    //  });

//----------------------------INPUT EVENTS ISTEK DESTEK ADD--------------------------------




//----------------------------PROFIL CHOOSE FILE BUTTON DEYISHMEK--------------------------------

        $('.forImg').click(function() {
          $('.imgInput').click();
        });

//----------------------------EMAIL PLACEHOLDER CHANGE END--------------------------------



//----------------------------EMAIL PLACEHOLDER CHANGE END--------------------------------
/*========================================================================================
==========================================================================================
==========================================================================================*/

// ----------------------------ISTEK DESTEK EDIT CHOOSE FILE-----------------------------------------------

$("#uploadAjax").change(function(e) {
    e.preventDefault();
    var imgs = $(".im_").length;
    var added = e.originalEvent.srcElement.files.length;

    var total = imgs+added;
    if(total > 5) {
        // alert('Maximum sekil sayi 5-dir');
        $('#myModal').css('display', 'block');
          var texts = $('.modal-content').children('p');
          texts.text('Ən çox 5 şəkil seçə bilərsiniz');
    }
   else {
      var formData = new FormData();
      var istek_id = $('#forPicsAjax').val();
      formData.append('file', $(this)[0].files[0]);
      formData.append('istek_id', istek_id);
      formData.append('imgLength', total)

      $.ajax({
        url: '/add_file_change',
        type: 'post',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        headers:{
      'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
        },
        data: formData,

        success:function(file_name)
        {
          if(file_name != "error"){

            $(e.originalEvent.srcElement.files).each(function () {

              var file = $(this);
              var img = document.createElement("img");
              var reader = new FileReader();

              reader.onload = function(e) {
                  img.src = e.target.result;
                  img.className = 'im_';
                  img.setAttribute("imagename", file[0].name);

              }

              reader.readAsDataURL(file[0]);
            $("#afterImage").after('<div class="img-wrap" imagename="'+file[0].name+'"></div>');
              $(".img-wrap[imagename='"+file[0].name+"']").append('<span class="closeImage" imagename="'+file_name+'">&times;</span>');
              $(".img-wrap[imagename='"+file[0].name+"']").attr('data-remove', file_name).append(img);
            })
            }else{
              $('#ajaxErrorImage').attr('class', 'alert alert-danger');
              $('#ajaxErrorImage').append('<p style="padding:10px;">Düzgün şəkil seçin</p>');
            }
          }
      });
    };
  });

// ----------------------------ISTEK EDIT CHOOSE FILE END-----------------------------------------------



// ----------------------------UPLOAD FILE LIMIT AND SHOWING-----------------------------------------------
  var lengthForImg;
  $('#forLimitFile').change(function(e){
    lengthForImg = e.originalEvent.srcElement.files.length;
      if(lengthForImg > 5){
          // alert('5-den cox şekil secmeyin');
         $('#myModal').css('display', 'block');
          var texts = $('.modal-content').children('p');
          texts.text('Ən çox 5 şəkil seçə bilərsiniz');
        }else{
          $('#viewImage').empty();
           $(e.originalEvent.srcElement.files).each(function () {
          var file = $(this);
          var check = checkExtension(file[0].name).toLowerCase();
            if(check=='jpg' || check=='jpeg' || check=='png'){

                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file[0]);
                $("#viewImage").append('<div class="img-wrap"  imagename="'+file[0].name+'"></div>');
                $(".img-wrap[imagename='"+file[0].name+"']").append(img);
            } else{
              $('#ajaxErrorImage').attr('class', 'alert alert-danger');
              $('#ajaxErrorImage').append('<p>Düzgün şəkil seçin</p>');
            }

        });
      }
  });

  $('#forUploadImages').submit(function(){
  //   var dt = new Date();
  //   var today = dt.getDate();
  //   var month = dt.getMonth() + 1;
  //   var year = dt.getFullYear();
  // console.log(year+'-'+month+'-'+today)

  var dat =  $('#date').val();

     if(dat==''){
          $('#myModal').css('display', 'block');
          var texts = $('.modal-content').children('p');
          texts.text('Zəhmət olmasa elanınıza bitmə tarixi daxil edin')
        return false;
      }

    if(lengthForImg >5 || lengthForImg==undefined){
      if(lengthForImg >5){
        $('#myModal').css('display', 'block');
          var texts = $('.modal-content').children('p');
          texts.text('Zəhmət olmasa 5-dən artıq şəkil seçməyəsiniz')
      }
      if(lengthForImg==undefined){
       $('#myModal').css('display', 'block');
          var texts = $('.modal-content').children('p');
          texts.text('Zəhmət olmasa ən azı bir şəkil seçin')
      }
     return false;
    }
  })

    // window.onclick = function(event) {
    //     if (event.target == $('#myModal')) {
    //         $('#myModal').css('display', 'none');
    //     }
    // } bu niye ishlemir anlamiram


/////molda-da x-a basanda
  $('#ModalClose').click(function(event) {
    var sh = $('.modal-content').children('p');
      $('#myModal').css('display', 'none');

     });

    function checkExtension (name) {
      var found = name.lastIndexOf('.') + 1;
       return (found > 0 ? name.substr(found) : "");
    }

// ----------------------------UPLOAD FILE LIMIT END-----------------------------------------------



// ----------------------------ISTEK EDIT WHEN CLICKING X ON PIC-----------------------------------------------


  $(document).on('click', '.closeImage', function(){
      var name = $(this).attr('imagename');
      var im_length = $('.im_').length;
console.log(im_length)
      // if(im_length==4){
      //    $('#myModal').css('display', 'block');
      //     var texts = $('.modal-content').children('p');
      //     texts.text('Zəhmət olmasa 5-dən artıq şəkil seçməyəsiniz');
      // }

        if($('.im_').length==1){
          // alert('1den az shekil olmaz')
           $('#myModal').css('display', 'block');
          var texts = $('.modal-content').children('p');
          texts.text('Ən azı bir şəkil olmalıdır');
        }else{
        var status = confirm("Silmək istədiyinizdən əminsinizmi?");
          if(status==true)
          {
            $(".img-wrap[data-remove='"+name+"']").remove();
            $("input[imagename='"+name+"']").val(0);
            $.ajax({
              url: '/deleteAjax',
              type: 'POST',
              dataType: 'json',
              headers:{
            'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
              },
              data:
              {"imagefile":name,
              "im_length":im_length
              },
            success: function(img_error){
                // $('#ajaxErrorImage').append('<p style="padding:10px;">Birdən az şəkil olmaz</p>');
              }
            })
          }
        }
    })
// ----------------------------ISTEK EDIT WHEN CLICKING X ON PIC END-----------------------------------------------


// ----------------------------SHOW PIC ON TENZIMLEMLER-----------------------------------------------

    $('.imgInput').change(function(e){
    var file = e.originalEvent.srcElement.files;
    var check = checkExtension(file[0].name).toLowerCase();

        if(check=='jpg' || check=='jpeg' || check=='png'){
           $('.profil-avatar').empty();

            var img = document.createElement("img");
            var reader = new FileReader();
            reader.onload = function(e) {
              img.src = e.target.result;
              img.className = 'center-block'
            }
            reader.readAsDataURL(file[0]);
            $('.profil-avatar').append(img);
          }else{
             $('#ErrorImage').attr('class', 'alert alert-danger');
             $('#ErrorImage').append('<p>Düzgün şəkil seçin</p>');
            }

    });
// ----------------------------SHOW PIC ON TENZIMLEMLER END-----------------------------------------------




// ----------------------------For Register-----------------------------------------------
$('#operator-numbers').change(function(){
 var op_num = $(this).val();
$('#operator').attr('value',op_num);
return false;
});

$('#CitySelectOption').change(function(){
 var city_option = $(this).val();
$('#city').attr('value',city_option);
return false;
});
//-----------------------------For Register End -------------------------------------------

//-----------------------------For destek button  -------------------------------------------
$(".destek-ol-message").hide();
    $(".destek-ol-button").click(function(){
        $(".destek-ol-message").slideToggle();

    });
 //-----------------------------For destek button  End-------------------------------------------


//------------------------------For searchBoxDrag -----------------------------------------
$('#searchBoxDrag').draggable({
          containment: '#InfoMap'
      });
});
//------------------------------For searchBoxDrag End -------------------------------------


//------------------------------For Login Ajax --------------------------------------------

$('#SubmitLogin').submit(function(event) {
  $('#EmailGroup').removeClass('has-error')
  $('#PasswordGroup').removeClass('has-error')
  $('#EmailError').html('');
  $('#PasswordError').html('');
  event.preventDefault();
    $.ajax({
      url: 'user-login',
      type: 'POST',
      // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
      headers:{
          'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
        },
          data: {
            email: $('#email').val(),
            password: $('#pass').val()
          },
          success: function(data){
            if (data == "We can't find a user with that e-mail address.") {
              var ForUserError = "Email vəya şifrə düzgün deyil";
              $('#EmailError').html(ForUserError);
              $('#EmailGroup').addClass('has-error')
              $('#PasswordGroup').addClass('has-error')
            }else {
              location.reload();
            }
          },
          beforeSend:function(){
                $('#submit').val('...');
              },
              complete:function(){
                $('#submit').val('Daxil ol');
              },
          error: function(data){
            var errors = data.responseJSON;
            var ForEmailError = 'Email və şifrəni boş buraxmayın';
            $('#EmailGroup').addClass('has-error')
                $('#PasswordGroup').addClass('has-error')
              $('#EmailError').html(ForEmailError);
          }
    })

});
//------------------------------For Login Ajax End ----------------------------------------

//------------------------------For facebook share button window----------------------------------------
var popupSize = {
   width: 780,
   height: 550
};

$(document).on('click', '.social-buttons > a', function(e){

   var
        verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
        horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

   var popup = window.open($(this).prop('href'), 'social',
        'width='+popupSize.width+',height='+popupSize.height+
        ',left='+verticalPos+',top='+horisontalPos+
        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

   if (popup) {
        popup.focus();
        e.preventDefault();
   }

});
//------------------------------For facebook share button window End ----------------------------------------

// ----------------------------For Map in destek_add and istek_add pages-----------------------------------------------
function initAutocomplete() {
var MyLocation = document.getElementById('MyLocation')
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {  lat: 40.100,lng: 47.500},
    zoom: 7,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoomControl:false,
    streetViewControl:false,
    mapTypeControl:false,
    overViewMapControl:false
  });

  // Create the search box and link it to the UI element.
  var input = document.getElementById('adress');
  var searchBox = new google.maps.places.SearchBox(input);
  // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });
  var markers = [];
  var geocoder = new google.maps.Geocoder;
  MyLocation.addEventListener('click',function(){
    if(navigator.geolocation) {
            var geoSuccess  = function(position) {
                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.setCenter(latlng);
                map.setZoom(15);
                var marker = new google.maps.Marker({
                  position: latlng,
                  map: map,
                });

                  geocodeLatLng(geocoder, map);
                function geocodeLatLng(geocoder, map) {
                  geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                      if (results[1]) {
                        document.getElementById('adress').value = results[1].formatted_address;
                        document.getElementById('lat').value = position.coords.latitude;
                        document.getElementById('lng').value = position.coords.longitude;
                      } else {
                        window.alert('Heç bir nəticə tapılmadı');
                      }
                    } else {
                      window.alert('Geokod səhvi: ' + status);
                    }
                  });
                }
                markers.push(marker);
            };
            var geoError = function(error) {
              switch (error.code) {
                  case error.PERMISSION_DENIED:
                      window.alert("Adresi əldə etmək cəhdi istifadəçi tərəfindən əngəlləndi");
                      break;
                  case error.POSITION_UNAVAILABLE:
                      window.alert("Adresi əldə etmək mümkün olmadı");
                      break;
                  case error.TIMEOUT:
                      window.alert("Adresi əldə etmək üçün verilən vaxt bitdi.");
                      break;
                  case error.UNKNOWN_ERROR:
                      window.alert("Nəsə bir səhv baş verdi");
                      break;
              }
                  // error.code can be:
                  //   0: unknown error
                  //   1: permission denied
                  //   2: position unavailable (error response from location provider)
                  //   3: timed out
                };
            navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
        }else {
          window.alert('Brovser adres tapmaq funksiyasını dəstəkləmir');
        };
  });

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        animation: google.maps.Animation.DROP,
        position: place.geometry.location
      })
    );
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
          document.getElementById('lat').value = place.geometry.location.lat();
          document.getElementById('lng').value = place.geometry.location.lng();


      } else {
        bounds.extend(place.geometry.location);
        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();

      }
    });
    map.fitBounds(bounds);
  });
}

//-----------------------------For Map End -------------------------------------------
