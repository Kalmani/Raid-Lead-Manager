import React from 'react';
import {Alert} from '@mui/material';

function StatusMessage({notice}) {
  if (!notice) {
    return null;
  }

  const severity = {
    success : 'success',
    warning : 'warning',
    error : 'error'
  }[notice.tone] || 'info';

  return (
    <Alert severity={severity} variant="filled">
      {notice.message}
    </Alert>
  );
}

export default StatusMessage;
