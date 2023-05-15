import React from 'react'

const Navigation = () => {
  return <div>
    <header className="flex justify-between align-center m-4">
      <a href="/"><img src="./logo.png" alt="Archiver logo" /></a>
      <nav className="m-4">
        <ul className='flex gap-12'>
          <li><a href="/archives" className="relative active:before:border-b-2 active:before:border-black">Archives</a></li>
          <li><a href="/contact">Contact</a></li>
          <li><a href="/a-propos">A propos</a></li>
          <li><a href="/connexion">Connexion</a></li>
        </ul>
      </nav>
    </header>
  </div>
}

export default Navigation