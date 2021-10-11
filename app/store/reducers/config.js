'use strict';

//const {find} = require('mout/array');

const {
  ACTION_TYPES,
  DEFAULT_STATE,
  //LOCALES_MASK
} = require('../../AppConstants');
/*
class Locales {

  constructor(items) {
    this.items     = items;
    this.translate = this.translate.bind(this);
  }

  translate(i, pure_text) {
    var tmp = '';

    while((tmp = LOCALES_MASK.exec(i)))
      i = i.replace(tmp[1], this.items[tmp[1]] || tmp[1].replace('&', '&amp;'));

    return pure_text ? i : <span dangerouslySetInnerHTML={{__html : i}} />;
  }

}*/

const reducer = (state = DEFAULT_STATE.config, {type, payload}) => {
  switch(type) {
    /*case ACTION_TYPES.SET_LANGUAGE: {
      let language       = payload || state.language;
      let languages_list = state.languages_list;

      language = (language || navigator.language || navigator.userLanguage).toLowerCase();

      if(language.length == 2)
        language = `${language}-${language}`;

      if(!find(languages_list, {code : language}))
        language = state.default_language;

      return {...state, current_language : language};
    } */case ACTION_TYPES.APP_READY: {
      return {...state, ready : true};
    } /*case ACTION_TYPES.SET_LOCALES: {
      return {...state, locales : new Locales(payload.locales)};
    } */case ACTION_TYPES.SET_CONFIG_STATE: {
      return {...state, ...payload};
    } default: {
      return {...state};
    }
  }
};

module.exports = reducer;
