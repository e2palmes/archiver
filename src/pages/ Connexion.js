import React from "react";
import Navigation from "../components/user/navigation";

const Connexion = () => {
  return <div>
    <Navigation />
    <div className="my-24 pt-8">
      <div className="w-full max-w-sm mx-auto">
        <p className="text-center text-3xl">Connexion</p>
        <form className="bg-gray shadow-md rounded px-8 pt-6 pb-8 mb-4">
          <fieldset className="mb-4">
            <label htmlFor="email" className="block text-gray-700 text-sm font-bold mb-2">
              Email
            </label>
            <input type="email" name="email" className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
          </fieldset>
          <fieldset className="mb-4">
            <label htmlFor="password" className="block text-gray-700 text-sm font-bold mb-2">
              Mot de passe
            </label>
            <input type="password" name="password" className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
          </fieldset>
          <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
              Se Connecter
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#mdp?">
              Mot de passe oublié ?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
}

export default Connexion