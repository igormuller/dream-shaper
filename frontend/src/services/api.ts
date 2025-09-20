import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8080/api",
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  timeout: 10000,
});

// Interceptador de requisições (antes de enviar)
// api.interceptors.request.use(
//   (config) => {
//     // Exemplo: adicionar token JWT se existir
//     const token = localStorage.getItem("token");
//     if (token) {
//       config.headers.Authorization = `Bearer ${token}`;
//     }
//     return config;
//   },
//   (error) => Promise.reject(error)
// );

// // Interceptador de respostas (quando volta do servidor)
// api.interceptors.response.use(
//   (response) => response,
//   (error) => {
//     if (error.response?.status === 401) {
//       console.warn("Não autorizado, redirecionando para login...");
//       // aqui você pode usar router.push('/login')
//     }
//     return Promise.reject(error);
//   }
// );

export default api;
