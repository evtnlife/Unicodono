// Switch faz com que apenas uma rota seja chamada por momento
import React from 'react';
import { BrowserRouter, Switch, Route } from 'react-router-dom';

import Main from './pages/Main';
import Login from './pages/Login';
import TabelaFipe from './pages/TabelaFipe';
import Repository from './pages/Repository';
import Carros from './pages/Carros';

export default function Routes() {
  return (
    <BrowserRouter>
      <Switch>
        <Route path="/" exact component={Main} />
        <Route path="/login" component={Login} />
        <Route path="/tabelafipe" component={TabelaFipe} />
        <Route path="/repository/:repository" component={Repository} />
        <Route path="/carros" component={Carros} />
      </Switch>
    </BrowserRouter>
  );
}
