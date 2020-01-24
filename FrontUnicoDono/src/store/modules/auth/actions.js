export function signInRequest(email, password) {
  return {
    type: '@auth/SIGN_IN_REQUEST',
    payload: { email, password },
  };
}

export function singInSucess(access_token, user) {
  return {
    type: '@auth/SIGN_IN_SUCESS',
    payload: { access_token, user },
  };
}

export function signFailure() {
  return {
    type: '@auth/SIGN_FAILURE',
  };
}
