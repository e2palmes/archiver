import React from 'react'
import Navigation from '../components/user/navigation'

const Home = () => {
  return <div>
    <Navigation />
    <main className='mt-44 flex gap-28'>
      <div class="w-7/12">
        <h1 className="text-h1">S'inspirer du passé pour preparer l'avenir</h1>
        <p class="text-subhead">Vous trouverez ici tous les documents d’archives relatifs à l’ecole IRIS</p>
        <div class="my-4 gap-8 flex">
          <a href="/archives" class="bg-primary text-xl font-bold rounded-btn p-2">Parcourir les archives</a>

          <a href="/" class="text-xl p-1 flex items-center">
            <span>A propos de ce site</span>
            <svg width="29" height="16" viewBox="0 0 29 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M28.2071 8.70711C28.5976 8.31658 28.5976 7.68342 28.2071 7.29289L21.8431 0.928932C21.4526 0.538408 20.8195 0.538408 20.4289 0.928932C20.0384 1.31946 20.0384 1.95262 20.4289 2.34315L26.0858 8L20.4289 13.6569C20.0384 14.0474 20.0384 14.6805 20.4289 15.0711C20.8195 15.4616 21.4526 15.4616 21.8431 15.0711L28.2071 8.70711ZM0.5 9L27.5 9V7L0.5 7L0.5 9Z"
                fill="black" />
            </svg>
          </a>
        </div>
      </div>
      <div class="w-5/12">
        <img src='./home.jpg' alt='home_img' className='' />
      </div>
    </main>
  </div>
}

export default Home
