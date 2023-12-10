const xbetterworld = axios.create({
  baseURL: "https://app.xbetterworld.org/",
  timeout: 10000,
});

const kycsmartpay = axios.create({
  baseURL: "https://kyc.smartpay.com.vc/",
  timeout: 10000,
});

const priceSmartpay = axios.create({
  baseURL: "https://connect.smartpay.com.vc/api/",
  timeout: 10000,
});

const smartGateway = axios.create({
  baseURL: "http://localhost/",
  timeout: 10000,
});

// const smartGateway = axios.create({
//   baseURL: "https://smartgateway.io/",
//   timeout: 10000,
// });
