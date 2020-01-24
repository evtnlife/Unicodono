//Função para manter usuário logado na aplicação
import storage from 'redux-persist/lib/storage';
import { persistReducer } from 'redux-persist';

export default reducers => {
  const persistedReducer = persistReducer(
    {
      //outra aplicação que não tiver a mesma chave nao compartilha estado
      key: 'unicodono',
      storage,
      //Coloca nome dos reducers que precisa armazenar informações
      whitelist: ['auth', 'user'],
    },
    reducers
  );

  return persistedReducer;
};
