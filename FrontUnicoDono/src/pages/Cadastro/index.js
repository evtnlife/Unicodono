import React from 'react';
import { Link } from 'react-router-dom';
import { Form, Input } from '@rocketseat/unform';
import * as Yup from 'yup';

const schema = Yup.object().shape({
  nome: Yup.string().required('o nome é obrigatório'),
  email: Yup.string()
    .email('Insira um e-mail válido')
    .required('O e-mail é obrigatório'),
  senha: Yup.string()
    .min(6, 'Segurança: a senha deve ter no mínimo 6 caracteres')
    .required('A senha é obrigatória'),
});

export default function Cadastro() {
  // Função que recebe os dados do form
  function handleSubmit(data) {
    console.tron.log(data);
  }
  return (
    <>
      <strong>Criar Conta</strong>

      <Form schema={schema} onSubmit={handleSubmit}>
        <Input name="nome" placeholder="Nome completo" />
        <Input name="email" type="email" placeholder="Seu e-mail" />
        <Input name="senha" type="password" placeholder="Sua senha secreta" />
        <Input
          name="confirmaSenha"
          type="password"
          placeholder="Confirme sua senha"
        />

        <button type="submit">Criar Conta</button>

        <Link to="/login">Sign In</Link>
      </Form>
    </>
  );
}
