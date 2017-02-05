$(document).ready(function() {
  $('#acar').change(function(){
    var ElLoc = $(this).val();
    $('#Loc').attr('value',ElLoc);
    return false;
  });
  $('#seher').change(function(){
    var ElType = $(this).val();
    $('#Type').attr('value',ElType);
    return false;
  });
var markers = [];
$.ajax({
  url: document.location.href,
  type: 'GET',
  headers:{
    'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
  },
  dataType: 'json',
  data: {
    ElanLocation : $('#Loc').val(),
    ElanType : $('#Type').val(),
  },
  success: function Mydatas(data){
      $('.search-error-desc').hide('2000');
      $('.infoMessage').text('')
      var count = data.length;
    Mydata(data,count);

  },
  beforeSend:function(){
    $('.Load').removeClass('closeLoad');
  },
  complete:function(){
    $('.Load').addClass('closeLoad');
  },
});
    // <- ============ CHANGE FUNC FOR MAP WITH AJAX =========== ->
  $('.Test').change(function(event) {
    event.preventDefault();
    $.ajax({
      url: '/',
      type: 'GET',
      headers:{
        'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
      },
      dataType: 'json',
      data: {
        ElanLocation : $('#Loc').val(),
        ElanType : $('#Type').val(),
      },
      success:function Mydatas(data){
          if (data.length ==0) {
            $('.search-error-desc').fadeIn('2000');
            $('.infoMessage').text('İstəyinizə uyğun nəticə tapılmadı')
            $('.search-error-desc').css('background', '#F44336');
            Mydata(data);
          }else {
            var counts = 0;
            console.log(data);
            for (var i =  0; i < data.length; i++) {
              if (data[i]['status'] == 1) {
                counts++;
              }
            }
              $('.search-error-desc').fadeIn('2000');
              $('.infoMessage').text('İstəyinizə uyğun '+counts+' nəticə tapıldi')
              $('.search-error-desc').css('background', '#4CAF50');
              var count = data.length;
              Mydata(data,count);
          }
      },
      beforeSend:function(){
        $('.Load').removeClass('closeLoad');
      },
      complete:function(){
        $('.Load').addClass('closeLoad');
      },
    });
  });
});

  //Index.blade.php Map function
function Mydata(data,count){
  markers = [];
  var myLatlng = new google.maps.LatLng(40.300,48.800);
         var mapOptions = {
             zoom: 8,
             center: myLatlng,
             scrollwheel: false,
             streetViewControl:false,
             mapTypeControl:false,
             overViewMapControl:false
         };
         var map = new google.maps.Map(document.getElementById('InfoMap'), mapOptions);
         var marker;
         for ( i = 0; i < count; i++) {
           if (data[i]['status'] == 1) {
             var src;
             if( (data[i]['type_id']) == 2) {
               src= "/images/green-icon.png";
             }else if (data[i]['type_id'] == 1) {
               src="/images/red-icon.png";
             };
             var MyData =data[i]['about'];
             var about = MyData.substring(0,185);
             marker = new google.maps.Marker({
               position: new google.maps.LatLng(data[i]['lat'],data[i]['lng']),
               map: map,
               title: data[i]['title'],
               content:"<div id='infow'>" +
               '<div class="infow-content">' +
               "<a href='/single/"+data[i]['id']+"'><img src='image/"+data[i]['image']+"'height='127' width='140'></a>" +
               '<div class="infoBubble-desc">' +
               "<p style='padding-right:9px'>"+about+" ...</p>"+
               '</div>' +
               "<p class='pull-right '><a href='/single/"+data[i]['id']+"' class='btn infoBubble-button'>Ətraflı</a></p>"+
               '</div>' +
               '</div>',
               animation: google.maps.Animation.DROP,
               icon:src,
             });
             markers.push(marker);
           }
         };
         var infoBubble2 = new InfoBubble({
             map: map,
             shadowStyle: 1,
             padding: 0,
             backgroundColor: 'white',
             borderRadius: 0,
             arrowSize: 15,
             minWidth:350,
             maxWidth: 350,
             minHeight:127,
             maxHeight: 127,
             borderWidth: 0,
             borderColor: '#2c2c2c',
             disableAutoPan: false,
             hideCloseButton: false,
             arrowPosition: 50,
             backgroundClassName: 'InfoMap',
             arrowStyle: 2,
             closeSrc: '/images/icon.png',
           });
            function manyInfo(mark, infoBubble2) {
            infoBubble2.setContent(mark.content);
            $('.InfoMap').parent().prev().addClass('InfoBubble-close');
            infoBubble2.open(map, mark);
            marker.addListener('closeclick', function() {
                infoBubble2.setMarker(null);
            });
          }
         for (var i = 0; i < markers.length; i++) {
             google.maps.event.addListener(markers[i], 'click', function() {
               map.setZoom(13);
                 manyInfo(this, infoBubble2);
             });
         }
         var markerCluster = new MarkerClusterer(map, markers, {
           imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
          maxZoom:8
       });
}
