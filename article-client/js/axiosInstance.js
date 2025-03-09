const serverURL =
  'http://localhost:8080/Article/article-server/api/v1'

const api = axios.create({
  baseURL: serverURL,
})
