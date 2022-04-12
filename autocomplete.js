

var availableTags = [""];
function getLocations(){
  $.get("api/?get=locations", function(data) {
    availableTags =  JSON.parse("[" + data + "]");
    $( "#autocomplete" ).autocomplete("option", { source: availableTags });
  });
}

$( function() {
  $( "#autocomplete" ).autocomplete({
    source: availableTags
  });
});


if ($target.hasClass('ui-autocomplete')) {
  $(this.target).find('autocomplete').autocomplete();
}
