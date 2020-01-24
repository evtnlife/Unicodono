import produce from 'immer';

const INITIAL_STATE = {
  access_token: null,
  signed: false,
  loading: false,
};

export default function auth(state = INITIAL_STATE, action) {
  switch (action.type) {
    case '@auth/SIGN_IN_SUCESS':
      return produce(state, draft => {
        draft.access_token = action.payload.access_token;
        draft.signed = true;
      });
    default:
      return state;
  }
}
