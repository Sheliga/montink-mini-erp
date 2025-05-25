$(document).ready(function () {
  function limpaCamposEndereco() {
    $("#endereco, #bairro, #cidade, #uf").val("");
  }

  function mostrarErroCep(mostrar) {
    $("#cep").toggleClass("is-invalid", mostrar);
    $("#cepfeedback").toggleClass("d-none", !mostrar);
  }

  $("#cep").on("input", function () {
    let cep = $(this).val().replace(/\D/g, "");
    if (cep.length > 5) {
      cep = cep.replace(/^(\d{5})(\d{0,3})/, "$1-$2");
    }
    $(this).val(cep);
    mostrarErroCep(false);
  });

  $("#cep").on("blur", function () {
    let cep = $(this).val().replace(/\D/g, "");
    if (cep.length !== 8) {
      mostrarErroCep(true);
      limpaCamposEndereco();
      return;
    }

    $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
      if (data.erro) {
        mostrarErroCep(true);
        limpaCamposEndereco();
      } else {
        mostrarErroCep(false);
        $("#endereco").val(data.logradouro);
        $("#bairro").val(data.bairro);
        $("#cidade").val(data.localidade);
        $("#uf").val(data.uf);
      }
    }).fail(function () {
      mostrarErroCep(true);
      limpaCamposEndereco();
    });
  });
});
