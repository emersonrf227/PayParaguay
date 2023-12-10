const viacep = axios.create({
  baseURL: "https://viacep.com.br/",
  timeout: 10000,
});

const url = new URL(window.location.href);

const loti = axios.create({
  baseURL: `http://${url.hostname}/`,
  timeout: 10000,
});
