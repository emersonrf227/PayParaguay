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

function converteMoedaFloat(valor) {
  valor = valor.replaceAll(".", "");
  valor = valor.replaceAll(",", ".");
  return valor;
}

function vlReal(data) {
  var f2 = data.toLocaleString("pt-br", { minimumFractionDigits: 2 });
  return f2;
}

function FormatMoeda(v) {
  var valorFormatado = Intl.NumberFormat("pt-br", {
    style: "currency",
    currency: "BRL",
  }).format(v);
  valorFormatado = valorFormatado.replace(/\D/g, ""); //permite digitar apenas números
  valorFormatado = valorFormatado.replace(/[0-9]{12}/, "inválido"); //limita pra máximo 999.999.999,99
  valorFormatado = valorFormatado.replace(/(\d{1})(\d{8})$/, "$1.$2"); //coloca ponto antes dos últimos 8 digitos
  valorFormatado = valorFormatado.replace(/(\d{1})(\d{5})$/, "$1.$2"); //coloca ponto antes dos últimos 5 digitos
  valorFormatado = valorFormatado.replace(/(\d{1})(\d{1,2})$/, "$1,$2"); //coloca virgula antes dos últimos 2 digitos

  return valorFormatado;
}

function valMoeda(z) {
  v = z.value;
  v = v.replace(/\D/g, ""); //permite digitar apenas números
  v = v.replace(/[0-9]{12}/, "inválido"); //limita pra máximo 999.999.999,99
  v = v.replace(/(\d{1})(\d{8})$/, "$1.$2"); //coloca ponto antes dos últimos 8 digitos
  v = v.replace(/(\d{1})(\d{5})$/, "$1.$2"); //coloca ponto antes dos últimos 5 digitos
  v = v.replace(/(\d{1})(\d{1,2})$/, "$1,$2"); //coloca virgula antes dos últimos 2 digitos
  z.value = v;
}

function todayDate() {
  const dataAtual = new Date();
  const year = dataAtual.getFullYear();
  const month = String(dataAtual.getMonth() + 1).padStart(2, "0"); // Adiciona 1 ao mês, pois os meses em JavaScript são baseados em zero
  const day = String(dataAtual.getDate()).padStart(2, "0");

  const formatDate = `${year}-${month}-${day}`;
  return formatDate;
}

function removeAcents(i) {
  var i = i.toLowerCase().trim();

  var acentos = "ãáàâäéèêëíìîïõóòôöúùûüç";
  var sem_acentos = "aaaaaeeeeiiiiooooouuuuc";

  for (var x = 0; x < i.length; x++) {
    var str_pos = acentos.indexOf(i.substr(x, 1));
    if (str_pos != -1) {
      i = i.replace(acentos.charAt(str_pos), sem_acentos.charAt(str_pos));
    }
  }
  return i;
}

function brlDate(date, displayHours = false) {
  var data = new Date(date);
  var day = data.getDate();
  var month = data.getMonth() + 1;
  var year = data.getFullYear();

  if(displayHours){
  
  var hours = data.getHours();
  var minutes = data.getMinutes();
  var seconds = data.getSeconds();
  return day + "/" + month + "/" + year + " " + hours + ":" + minutes + ":" + seconds;

  }
  

  return day + "/" + month + "/" + year;
}

// showToast('Realizado coms sucesso', 'alert-primary', 6000)
