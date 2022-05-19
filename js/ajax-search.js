$(function () {
  $('#button__search').click(function () {
    const form = $('#form').serialize();
    event.preventDefault();
    $.ajax({
      type: 'GET',
      url: `http://wsb.localhost/ajaxSearch`,
      headers: "Access-Control-Allow-Origin: '*'",
      data: form,
      dataType: 'JSON',
      success: function (response) {
        $('#search__contener').empty();

        let array = [];
        $.each(response.params, function (index, param) {
          if (!array.includes(param.id_T)) {
            let payment = 'Green';
            if (param.adresO === '-') payment = 'Violet';
            else {
              response.numberAccount.forEach(number => {
                if (param.transferFrom == number.id_N) {
                  payment = 'Red';
                }
              });
            }

            const html = `<a href="${
              'http://' + window.location.host + '/viewHistoryOne/' + param.id_T
            }">
                    <div class="contener__history  ${'payment' + payment}">
                        <div class="contener__history--address">
                            <div class="icon">
                                <i class="historyIcon bi bi-currency-exchange"></i>
                            </div>
                            <div style="margin-left:1rem;">
                                <h4 class="address"> ${
                                  payment === 'Violet'
                                    ? 'Przelew na własne konto'
                                    : param.adresO
                                }</h4>
                                <p class="history--text">${param.title}</p>
                            </div>
                        </div>
                        <div class="contener__history--price">

                            <p class="history--text">${
                              payment == 'Red'
                                ? '-' + param.price + 'zł'
                                : param.price + 'zł'
                            }</p>
                            <p class="history--text">${param.transferDate}</p>
                        </div>
                    </div>
                </a>
            `;

            $('#search__contener').append(html);
            array.push(param.id_T);
          }
        });
      },
    });
  });
});
