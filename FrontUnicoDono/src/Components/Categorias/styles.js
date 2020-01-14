import styled from 'styled-components';
import 'bootstrap/dist/css/bootstrap.min.css';

export const ListCategorias = styled.ul`
  padding-left: 10px;
  display: inline;
  inline-size: auto;
  list-style: none;
  margin: 30px;
  h2 {
    display: flex;
    align-self: auto;
  }
  ul {
    display: inline;
    padding: 0px;
    margin: 0px;
    background-color: #ededed;
    list-style: none;
    li {
      padding: 10px;
      margin: 10px;
      display: inline;
      flex-direction: column;
      background: #fff;

      button {
        position: flex;
        width: 180px;
        height: 230px;
        padding: 20px;
        border-radius: 15px;

        img {
          width: 100%;
          height: 100%;
          position: flex;
          margin-top: -11px;
        }
      }
    }
  }
`;
