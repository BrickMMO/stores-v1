window.onload = function(){
  let map;
  
  async function initMap() {
    
    const position = { lat: coordinates.lat, lng: coordinates.lng };
    
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    map = new Map(document.getElementById("map"), {
      zoom: 14,
      center: position,
      mapId: "LEGO_STORE_LOCATION",
    });

    const marker = new AdvancedMarkerElement({
      map: map,
      position: position,
      title: lego_store_name,
    });
  }

  initMap();
}