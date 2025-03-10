const question = document.getElementById('question-input')
const answer = document.getElementById('answer-input')

async function addQuestionApi(event) {
  event.preventDefault()

  try {
    const response = await api.post('/questions/addQuestion.php', {
      question: question.value,
      answer: answer.value,
    })

    console.log(response.data)
    if (response.data.status === 'success') {
      window.location.href = 'home.html'
    } else {
      alert(response.data.message)
      return
    }
  } catch (error) {
    console.log(error)
  }
}
