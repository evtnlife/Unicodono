/* eslint-disable jsx-a11y/alt-text */
import React from 'react';

import { Link } from 'react-router-dom';
import { FaUserCircle } from 'react-icons/fa';
import { Container, Menu } from './styles';

import logo from '../../assets/images/logo.png';

export default function Header() {
  return (
    <Container>
      <Link to="/">
        <img src={logo} alt="UnicoDono" />
      </Link>
      <Menu>
        <Link to="/comprar">Comprar</Link>
        <Link to="/vender">Vender</Link>
        <Link to="/servicos">Serviços</Link>
        <Link to="/ajuda">Ajuda</Link>
        <Link to="/login" className="login">
          <div>
            <FaUserCircle size={20} color="#3c3d40" />
          </div>
          <span>Login</span>
        </Link>
      </Menu>
    </Container>
  );
}
