const full_name = document.getElementById('full_name')
const email_address = document.getElementById('email')
const password = document.getElementById('password')

async function userRegisterApi(event) {
  event.preventDefault()

  try {
    const response = await api.post('/api/v1/users/signup.php', {
      full_name: full_name.value,
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
    console.log(error)
  }
}
