$(document).ready(function() {
    $('#mySelect').select2({
        tags: true,
        placeholder: 'Pilih Obat',
        allowClear: true
    })

});

// search combobox


function closeAllSelects(element) {
    var selects = $('.custom-select');
    selects.removeClass('show');
}
  
  $(document).on('click', '.select-selected', function(event) {
    event.stopPropagation();
    $(this).parent().toggleClass('show');
  });
  
  $(document).on('click', '.select-item', function(event) {
    var value = $(this).text();
    $(this).closest('.custom-select').find('.select-selected').text(value);
    $(this).closest('.custom-select').find('#selected-option').val($(this).data('value'));
    closeAllSelects(event.target);
  });
  
  $(document).on('input', '.select-items input', function(event) {
    event.stopPropagation(); // Prevent the click event from bubbling to the document
    var value = $(this).val().toUpperCase();
    var items = $(this).parent().find('.select-item');
    items.each(function() {
      var textValue = $(this).text().toUpperCase();
      if (textValue.indexOf(value) > -1) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });