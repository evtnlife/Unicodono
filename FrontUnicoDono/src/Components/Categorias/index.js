/* eslint-disable react/style-prop-object */
/* eslint-disable jsx-a11y/img-redundant-alt */
/* eslint-disable react/no-unescaped-entities */
/* eslint-disable react/prefer-stateless-function */
import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import FigureImage from 'react-bootstrap/FigureImage';
import Figure from 'react-bootstrap/Figure';
import FigureCaption from 'react-bootstrap/FigureCaption';
import carro1 from '../../assets/images/images.jfif';

export default class Categorias extends Component {
  render() {
    return (
      <Figure>
        <Figure.Image width={171} height={180} alt="171x180" src={carro1} />
        <Figure.Caption>SUV</Figure.Caption>
      </Figure>
    );
  }
}
