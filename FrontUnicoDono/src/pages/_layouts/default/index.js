import React from 'react';
import PropTypes from 'prop-types';

import { Wrapper } from './styles';

export default function DeafaultLayout({ children }) {
  return <Wrapper>{children}</Wrapper>;
}

DeafaultLayout.propTypes = {
  children: PropTypes.element.isRequired,
};
