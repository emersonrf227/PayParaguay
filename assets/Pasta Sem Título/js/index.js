function showToast(mensagem, label, timeout = null) {
  $("#alert").addClass(label);
  $("#alert").html(mensagem);
  $("#alert").show("slow");
  if (timeout) {
    setTimeout(function () {
      $("#alert").removeClass(label);
      $("#alert").html("");
      $("#alert").hide("slow");
    }, timeout);
  }
}

function hideToast() {
  $("#alert").removeClass(
    "alert-primary alert-success alert-danger alert-warning alert-info alert-light alert-dark"
  );
  $("#alert").html("");
  $("#alert").hide("slow");
}

function mascaraMoeda(event) {
  const onlyDigits = event.target.value
    .split("")
    .filter((s) => /\d/.test(s))
    .join("")
    .padStart(3, "0");
  const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2);
  event.target.value = maskCurrency(digitsFloat);
}

function maskCurrency(valor, locale = "pt-BR", currency = "BRL") {
  return new Intl.NumberFormat(locale, {
    style: "currency",
    currency,
  }).format(valor);
}

// showToast('Realizado coms sucesso', 'alert-primary', 6000)
