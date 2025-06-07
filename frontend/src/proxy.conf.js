const target = "https://localhost";

const PROXY_CONFIG = [
  {
    context: ["/api"],
    target,
    changeOrigin: true,
    secure: false,
  },
];

module.exports = PROXY_CONFIG;
