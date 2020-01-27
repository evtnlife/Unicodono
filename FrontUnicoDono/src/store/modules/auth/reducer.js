/* eslint-disable import/no-unresolved */
/* eslint-disable no-fallthrough */
import produce from 'immer';

const INITIAL_STATE = {
  access_token: null,
  signed: false,
  loading: false,
};

export default function auth(state = INITIAL_STATE, action) {
  return produce(state, draft => {
    switch (action.type) {
      case '@auth/SIGN_IN_REQUEST': {
        draft.loading = true;
        break;
      }
      case '@auth/SIGN_IN_SUCESS': {
        draft.access_token = action.payload.access_token;
        draft.signed = true;
        draft.loading = false;
        break;
      }

      case '@auth/SIGN_IN_FAILURE': {
        draft.loading = false;
        break;
      }
      default:
    }
  });
}
