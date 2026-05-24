export async function postAction(actionRoot, namespace, action, params = {}) {
  const payload = new URLSearchParams();

  payload.set('namespace', namespace);
  payload.set('action', action);

  Object.entries(params).forEach(([key, value]) => {
    if (value === undefined || value === null) {
      return;
    }

    payload.set(key, value);
  });

  const response = await fetch(actionRoot, {
    method : 'POST',
    headers : {
      'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
    },
    credentials : 'same-origin',
    body : payload.toString()
  });

  const text = await response.text();

  try {
    return JSON.parse(text);
  } catch (error) {
    throw new Error(`Réponse invalide du backend: ${text.slice(0, 200)}`);
  }
}

export function extractNotice(response, fallbackSuccess) {
  if (response && response.error) {
    return {tone : 'error', message : response.error.message};
  }

  if (response && response.warning) {
    return {tone : 'warning', message : response.warning.message};
  }

  if (response && response.success) {
    return {tone : 'success', message : response.success.message};
  }

  if (fallbackSuccess) {
    return {tone : 'success', message : fallbackSuccess};
  }

  return null;
}

export function ensureServerData(response) {
  if (response && response.error) {
    throw new Error(response.error.message);
  }

  if (response && response.warning) {
    throw new Error(response.warning.message);
  }

  return response;
}
