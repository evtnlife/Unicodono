/* eslint-disable object-curly-newline */
/* eslint-disable import/no-useless-path-segments */
/* eslint-disable jsx-a11y/alt-text */
/* eslint-disable react/prefer-stateless-function */
import React, { Component } from 'react';
// import { BrowserRouter } from 'react-router-dom';
import ListCategorias from './../../Components/Categorias';
import Filtro from './../../Components/Filtro';
import { Container, Categoria, MaisBuscados, Blog } from './styles';

export default class Main extends Component {
  render() {
    return (
      <>
        <Container>
          <Filtro className="dist" />
        </Container>

        <Categoria>
          <h2>Categorias</h2>
          <ListCategorias />
        </Categoria>

        <MaisBuscados>
          <h2>Mais Buscados</h2>
          <ListCategorias />
        </MaisBuscados>

        <Blog>
          <h2>Blog</h2>
        </Blog>
      </>
    );
  }
}
