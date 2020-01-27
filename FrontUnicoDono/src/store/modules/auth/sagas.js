/* eslint-disable import/extensions */
/* eslint-disable import/no-unresolved */
import { takeLatest, call, put, all } from 'redux-saga/effects';
import { toast } from 'react-toastify';

import history from '~/services/history';
import api from '~/services/api';
import { singInSucess, signFailure } from './actions';

export function* signIn({ payload }) {
  try {
    const { email, password } = payload;
    /*
    const data = JSON.stringify({
      password,
      email,
    });
    api.post('api/auth/login', data, {
      headers: {
        'Content-Type': 'application/json',
      },
    });
    */
    // metodo que retorna uma PROMISE precisa do call por volta

    const response = yield call(api.post, 'api/auth/login/', {
      email,
      password,
    });

    const { access_token, user } = response.data;

    if (!user.provider) {
      toast.error('Usuário não é o vendedor');
      return;
    }

    yield put(singInSucess(access_token, user));

    history.push('/dashboard');
  } catch (err) {
    toast.error('Falha na autenticação, verifique seus dados');
    yield put(signFailure());
  }
}

export default all([
  // Toda vez que ouvir a informação seguinte chama a função de signIN
  takeLatest('@auth/SIGN_IN_REQUEST', signIn),
]);
