$(function () {
  $('#click_labe_show').click(function () {
    event.preventDefault();
    const formShow = $('#form_get_show').serialize();
    $.ajax({
      mehod: 'GET',
      url: `http://${window.location.host}/getListGroups`,
      headers: "Access-Control-Allow-Origin: '*'",
      data: formShow,
      dataType: 'JSON',
      success: function (response) {
        $('#tableParams').empty();
        let x = 1;
        $('#show').val(response.show);
        $('#click_labe_show').text(response.text);
        $.each(response.params, function (index, param) {
          const checkblock = param.block == '1' ? 'unlock' : 'block';
          const html = `<tr class='tbody--tr'>
                            <td>${x++}</td>
                            <td>${param.FirstName}</td>
                            <td>${param.LastName}</td>
                            <td>${param.NumberPhone}</td>
                            <td>${param.Email}</td>
                            <td>${param.LastConnect}</td>
                            <td>
                                <div class="contener--action">
                                    <button class="button__action">Edytuj</button>
                                    <a href="http://${
                                      window.location.host
                                    }/blockUser/${param.id_U}/${checkblock}">
                                            <button class="button__action background-${
                                              checkblock == 'block'
                                                ? 'unlock'
                                                : 'block'
                                            }">${
            checkblock == 'block' ? 'Zablokuj' : 'Odblokuj'
          }
                                    </button>       
                                 </a>   
                                    
                            </div>
                            </td>
                        </tr>`;

          $('#tableParams').append(html);
        });
      },
    });
  });
});
