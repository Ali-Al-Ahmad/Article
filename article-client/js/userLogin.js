const email_address = document.getElementById('email')
const password = document.getElementById('password')

async function userLoginApi(event) {
  event.preventDefault()
  try {
    const response = await api.post('/users/login.php', {
      email: email_address.value,
      password: password.value,
    })

    if (response.data.status === 'success') {
      localStorage.setItem('user_id', response.data.data.id)
      window.location.href = 'home.html'
    } else {
      alert(response.data.message)
      return
    }
  } catch (error) {
    alert(error.message)
  }
}
