document.addEventListener('DOMContentLoaded', ()  => {
    const cardArray = [
        {
            name: 'Sock1',
            img: 'src/img/sock1.jpg'
        },
        {
            name: 'Sock1',
            img: 'src/img/sock1.jpg'
        },
        {
            name: 'Sock2',
            img: 'src/img/sock2.jpg'
        },
        {
            name: 'Sock2',
            img: 'src/img/sock2.jpg'
        },
        {
            name: 'Sock3',
            img: 'src/img/sock3.jpg'
        },
        {
            name: 'Sock3',
            img: 'src/img/sock3.jpg'
        },
        {
            name: 'Sock4',
            img: 'src/img/sock4.jpg'
        },
        {
            name: 'Sock4',
            img: 'src/img/sock4.jpg'
        },
        {
            name: 'Sock5',
            img: 'src/img/sock5.jpg'
        },
        {
            name: 'Sock5',
            img: 'src/img/sock5.jpg'
        },
        {
            name: 'Sock6',
            img: 'src/img/sock6.jpg'
        },
        {
            name: 'Sock6',
            img: 'src/img/sock6.jpg'
        }
    ]
    cardArray.sort(() => 0.5 - Math.random())

    const grid = document.querySelector('.grid')
    const resultdisplay = document.querySelector('#result')
    let cardsChosen = []
    let cardsChosenId = []
    let cardsWon = []

    function createBoard() {
        for (let i = 0; i < cardArray.length; i++) {
            const card = document.createElement('img')
            card.setAttribute('src', 'src/img/empty.png') 
            card.setAttribute('data-id', i)
            card.addEventListener('click', flipCard)
            grid.appendChild(card)
            console.log(`Card ${i} created with src: src/img/empty.png`)
        }
    }

    function flipCard() {
        let cardId = this.getAttribute('data-id')
        cardsChosen.push(cardArray[cardId].name)
        cardsChosenId.push(cardId)
        this.setAttribute('src', cardArray[cardId].img)
        if (cardsChosen.length === 2) {
            setTimeout(checkForMatch, 500)
        }
    }

    function checkForMatch() {
        const cards = document.querySelectorAll('img')
        const optionOneId = cardsChosenId[0]
        const optionTwoId = cardsChosenId[1]
        if (cardsChosen[0] === cardsChosen[1]) {
            alert('You found a match')
            cards[optionOneId].setAttribute('src', 'src/img/white.png')
            cards[optionTwoId].setAttribute('src', 'src/img/white.png')
            cardsWon.push(cardsChosen)
        } else {
            cards[optionOneId].setAttribute('src', 'src/img/empty.png') 
            cards[optionTwoId].setAttribute('src', 'src/img/empty.png') 
            alert('Sorry, try again')
        }
        cardsChosen = []
        cardsChosenId = []
        resultdisplay.textContent = cardsWon.length
        if (cardsWon.length === cardArray.length / 2) {
            resultdisplay.textContent = 'Congratulations! You found them all!'
        }
    }

    createBoard()
})