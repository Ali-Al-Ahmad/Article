const user_id = localStorage.getItem('user_id')
const searchTerm = document.getElementById('search-input')

window.onload = async function () {
  if (!user_id) {
    window.location.href = 'index.html'
    return
  }
  await getAllquestions()
}

async function getAllquestions() {
  try {
    const response = await api.get(`/questions/getAllQuestions.php`)

    if (response.data.status !== 'success') {
      console.log(response.data.message)
      return
    }
    const container = document.getElementById('question-container')
    container.innerHTML = ''

    response.data.data.forEach((question) => {
      const questionDiv = document.createElement('div')
      questionDiv.classList.add('question-item')

      questionDiv.innerHTML = `
      <h3>${question.question}</h3>
      <p>${question.answer}</p>
    `
      container.appendChild(questionDiv)
    })
  } catch (error) {
    console.log(error)
  }
}

function filterQuestions() {
  console.log(searchTerm.value)
  document.querySelectorAll('.question-item').forEach((questionDiv) => {
    const questionText = questionDiv.querySelector('h3').innerText.toLowerCase()
    const answerText = questionDiv.querySelector('p').innerText.toLowerCase()

    if (
      !questionText.includes(searchTerm.value) &&
      !answerText.includes(searchTerm.value)
    ) {
      questionDiv.classList.add('hidee')
    } else {
      questionDiv.classList.remove('hidee')
    }
  })
}

const logutButton = document.getElementById('logout')
logutButton.addEventListener('click', function () {
  localStorage.removeItem('user_id')
  window.location.href = 'index.html'
})
