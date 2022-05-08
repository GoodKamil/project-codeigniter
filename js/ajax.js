$(function () {
  $('#changeNumerAccount').change(function () {
    $.ajax({
      type: 'GET',
      url: `http://wsb.localhost/ajaxAccount`,
      headers: "Access-Control-Allow-Origin: '*'",
      data: { id: $('#changeNumerAccount').val() },
      dataType: 'JSON',
      success: function (response) {
        $('#changePrice').val(response.price);
      },
    });
  });
});
