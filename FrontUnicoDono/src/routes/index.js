import React from 'react';
import { Switch } from 'react-router-dom';
import Route from './Route';

import Main from '../pages/Main';
import Login from '../pages/Login';
import Cadastro from '../pages/Cadastro';
import Carros from '../pages/Carros';
import Dashboard from '../pages/Dashboard';
import Perfil from '../pages/Perfil';

export default function Routes() {
  return (
    <Switch>
      <Route path="/" exact component={Main} />
      <Route path="/register" component={Cadastro} />
      <Route path="/login" component={Login} />
      <Route path="/produtos" component={Carros} />

      <Route path="/dashboard" componet={Dashboard} isPrivate />
      <Route path="/perfil" component={Perfil} isPrivate />

      <Route path="/" component={() => <h1>404</h1>} />
    </Switch>
  );
}
