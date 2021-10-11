'use strict';

const json = async (url, wpHeaders = false) => {
  let res  = await fetch(url);
  let data = await res.json();

  if(!wpHeaders)
    return data;

  let headers = {
    total : res.headers.get('x-wp-total') || null,
    pages : res.headers.get('x-wp-totalpages') || null
  };

  return {data, headers};
};

module.exports = json;
