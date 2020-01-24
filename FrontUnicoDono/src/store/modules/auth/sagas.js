import { takeLatest, call, put, all } from 'redux-saga/effects';

import history from '~/services/history';
import api from '~/services/api';
import { singInSucess } from './actions';

export function* signIn({ payload }) {
  const { email, password } = payload;
  //metodo que retorna uma PROMISE precisa do call por volta
  const response = yield call(api.post, 'sessions', {
    email,
    password,
  });

  const { access_token, user } = response.data;

  if (!user.provider) {
    console.tron.error('Usuário não é o vendedor');
    return;
  }

  yield put(singInSucess(access_token, user));

  history.push('/dashboard');
}

export default all([
  //Toda vez que ouvir a informação seguinte chama a função de signIN
  takeLatest('@auth/SIGN_IN_REQUEST', signIn),
]);
