import styled from 'styled-components';
import { darken } from 'polished';

export const Wrapper = styled.div`
  height: 100%;
  background-image: linear-gradient(#03598f, #fff);

  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
`;
export const Content = styled.div`
  background: #e6eaed;
  padding: 40px;
  width: 100%;
  max-width: 600px;
  height: auto;
  text-align: center;
  margin-top: 200px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  border-radius: 4px;
  form {
    display: flex;
    flex-direction: column;
    margin-top: 30px;

    input {
      background: rgba(255, 255, 255, 255, 0.1);
      border: 0;
      border-radius: 4px;
      height: 44px;
      padding: 0 15px;
      color: #333;
      margin: 0 0 10px;

      &::placeholder {
        color: rgba(0, 0, 0, 0, 0.7);
      }
    }

    span {
      color: #f64c75;
      align-self: flex-start;
      margin: 0 0 10px;
      font-weight: bold;
    }
    button {
      margin: 5px 0 0;
      height: 44px;
      background: #03598f;
      font-weight: bold;
      color: #fff;
      border: 0;
      border-radius: 4ex;
      font-size: 16px;
      transition: background 0.2s;

      &:hover {
        background: ${darken(0.03, '#03598f')};
      }
    }
    a {
      color: #333;
      margin-top: 15px;
      font-size: 16px;
      opacity: 0.7;

      &:hover {
        opacity: 1;
      }
    }
  }
`;
