// Componente do box de filtros
import React from 'react';

import { FaSearch } from 'react-icons/fa';

import { Caixa, Header, Form, Pesquisar } from './styles';

export default function Filtro() {
  return (
    <Caixa>
      <Header>
        <ul>
          <li>Comprar Carro</li>
          <li>Comprar Motos</li>
          <li>Quero Vender</li>
        </ul>
      </Header>
      <Form>
        <input type="text" placeholder="Qual marca você procura?" />
      </Form>
      <Pesquisar disabled>
        <FaSearch color="#5c6160" size={14} />
      </Pesquisar>
    </Caixa>
  );
}
