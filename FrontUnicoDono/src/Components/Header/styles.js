import styled from 'styled-components';

export const Container = styled.header`
  height: 60px;
  padding: 0;
  background: #f8f6f6;
  background-position: left;
  background-size: auto;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);

  display: flex;
  justify-content: space-between;
  align-items: center;

  img {
    height: 68px;
    margin: 0;
    width: 300px;
  }
`;

export const Menu = styled.menu`
  background: rgba(0, 0, 0, 0);
  display: flex;
  text-align: center;
  padding: 25px;
  transition: 0.2s;
  align-items: center;
  a {
    padding: 30px;
    text-decoration: none;
  }
  a:hover {
    opacity: 0.7;
  }
  a:visited {
    color: #545755;
    opacity: 0.7;
  }
  a:link {
    color: #545755;
  }
`;
