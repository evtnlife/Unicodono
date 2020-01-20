import styled from 'styled-components';
import 'bootstrap/dist/css/bootstrap.min.css';

export const ListCategorias = styled.ul`
  display: grid;
  grid-auto-flow: column;
  margin: auto;
  margin-top: 5px;
  position: relative;

  li {
    list-style: none;
    position: relative;
    padding: 10px;

    > h2 {
      padding: 20px;
      font-size: 20px;
      color: #fff;
      text-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      position: absolute;
    }
  }
  img {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    margin: auto;
    height: 200px;
    width: 200px;
    border-radius: 20px;
  }
`;
