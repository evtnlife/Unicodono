// Responsavel por deixar todos os estilos que sao usado por mais de um component

import { createGlobalStyle } from 'styled-components';
import 'react-toastify/dist/ReactToastify.css';

// Tudo colocado aqui dentro sera usado em toda aplicação
export default createGlobalStyle`
  /*estilo de fonte usado para tipografia do site*/
  @import url('https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap');
  /*Importando bootstrap global*/
  @import '~bootstrap/scss/bootstrap.scss';

/*Configuração padrão*/
  *{
    margin:0;
    padding: 0;
    outline: 0;
    box-sizing: border-box;
  }
  html,body, #root{
    min-height: 100%;
  }

  body{
    /*Define cor padrão do background da página*/
    background: #ecf1f8;
    font: 14px 'Roboto', sans-serif;
    color: #333;
    -webkit-font-smoothing: antialiased !important;
    text-decoration:none;
  }
  Link{
    text-decoration:none;
  }

  body,input,button{
    color:#222;
    font-size: 14px;
    font-family: Arial, Helvetica, sans-serif;
  }

  button{
    cursor: pointer;
  }


`;
